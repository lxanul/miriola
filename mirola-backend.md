# Specyfikacja backendu MIRiOLA (stan faktyczny)

> Poprzednia wersja tego pliku opisywała architekturę, która nie powstała:
> Laravel 11, MySQL, JWT (`tymon/jwt-auth` nie jest zależnością projektu), role
> użytkowników, tabele `bookings`, `services`, `audit_logs` oraz kontrolery
> i API. Poniżej jest to, co faktycznie znajduje się w repozytorium.

## Overview

Serwer renderujący trzy strony działów firmy z treścią pobieraną z bazy oraz
panel Filament, w którym właściciel edytuje treści i prowadzi grafik rezerwacji.
Brak warstwy API — wszystkie trasy publiczne to domknięcia w `routes/web.php`.

## Typ projektu

**WEB** — Laravel + Blade (SSR) + panel administracyjny Filament.

## Stos technologiczny

- **Framework:** PHP ^8.3 / Laravel 13.8
- **Panel administracyjny:** Filament 3.3
- **Baza danych:** SQLite (`DB_CONNECTION=sqlite`)
- **Autoryzacja:** sesyjna, wbudowana w Laravel; dostęp do panelu rozstrzyga
  `User::canAccessPanel()` na podstawie kolumny `users.is_admin`
- **Silnik widoków:** Blade
- **Pliki:** dysk `public` (`storage/app/public`, wystawiony przez `storage:link`)
- **Testy:** PHPUnit 12

## Trasy publiczne

| Ścieżka                  | Widok                      | Treść                                      |
|--------------------------|----------------------------|--------------------------------------------|
| `/`                      | `hub.blade.php`            | Rozdroże trzech działów + 3 aktualności     |
| `/osrodek`               | `home.blade.php`           | Pokoje, atrakcje, galeria, FAQ, kalendarz   |
| `/jarmark`               | `jarmark.blade.php`        | Menu kawiarni, atrakcje, aktualności        |
| `/gospodarstwo`          | `gospodarstwo.blade.php`   | Produkty gospodarstwa                       |
| `/aktualnosci`           | `aktualnosci.blade.php`    | Lista aktualności z filtrem `?branch=`      |
| `/polityka-prywatnosci`  | `polityka-prywatnosci`     | Strona statyczna                            |
| `/sitemap.xml`           | —                          | Plik statyczny z `public/`                  |

## Schemat bazy danych

Zgodny z katalogiem `database/migrations/`.

### `users`
`id`, `name`, `email` (unique), `email_verified_at`, `password` (hash bcrypt),
`is_admin` (boolean, default `false`), `remember_token`, timestamps.

`is_admin` celowo **nie** znajduje się w `$fillable` — flaga uprawnień nigdy nie
może zostać ustawiona przez mass assignment. Zapisuje ją `forceFill` w seederze
i w `UserResource::persist()`.

Nie ma kolumny `role` ani ról użytkowników.

### `rooms`
`id`, `name`, `room_type` (string, wartości z `App\Enums\RoomType`), `capacity`,
`price_per_night` (decimal 8,2), `price_unit`, `description`, `image`, `images`
(JSON), `amenities` (JSON), `sort_order`, timestamps.

Model dokłada akcesory `is_currently_occupied`, `is_available_now`
i `booked_ranges`, liczone z **załadowanej** relacji `reservations`. Trasa
`/osrodek` używa `Room::with('reservations')`, więc lista pokoi to 2 zapytania.
Relacja jest w `$hidden`, żeby `@json($rooms)` nie wysłał danych gości na stronę.

### `reservations`
`id`, `room_id` (FK → `rooms`, cascade delete), `guest_name`, `guest_phone`,
`guest_email`, `check_in_date` (date), `check_out_date` (date), `total_price`
(decimal 8,2), `status` (`confirmed` | `pending` | `cancelled`), `notes`,
timestamps.

Reguły w `Reservation::booted()`: data wyjazdu musi być późniejsza niż przyjazdu,
a terminy nie mogą kolidować z inną nieanulowaną rezerwacją tego samego pokoju.
Doba wyjazdu może być dobą przyjazdu kolejnego gościa (porównania ostre).

### `news`
`id`, `title`, `slug` (unique), `branch` (`resort` | `jarmark` | `farm`),
`excerpt`, `content`, `image`, `is_published`, `published_at`, timestamps.

### `faqs`
`id`, `question`, `answer`, `branch`, `sort_order`, `is_published`, timestamps.

### `gallery_images`
`id`, `image`, `video_url`, `media_type` (`image` | `video`), `title`, `branch`,
`sort_order`, `is_published`, timestamps.

`video_url` przechodzi walidację: wyłącznie `https` z YouTube/Vimeo albo
bezpośredni plik `.mp4`/`.webm`. Pole trafia do atrybutu `src` odtwarzacza.

### `cms_contents`
`id`, `key` (unique), `label`, `group`, `type`, `value`, timestamps. Prosty
magazyn klucz-wartość dla tekstów strony.

### Pozostałe
`restaurant_halls` (`slug` unique, `features` JSON), `cafe_menu_items`
(`category` z `App\Enums\CafeCategory`), `attractions` (`branch`),
`farm_products`, oraz systemowe `sessions`, `password_reset_tokens`, `cache`,
`jobs`.

**Nie istnieją** tabele `bookings`, `services`, `gallery_photos` ani `audit_logs`.

## Panel administracyjny

Ścieżka `/admin`, dostawca `App\Providers\Filament\AdminPanelProvider`.

- Logowanie sesyjne; `canAccessPanel()` wpuszcza wyłącznie konta z `is_admin`.
- `/admin/profile` — zmiana nazwy, adresu e-mail i hasła zalogowanego konta.
- „Ustawienia → Konta administratorów" (`UserResource`) — zakładanie i usuwanie
  kont. Nie można odebrać uprawnień ani usunąć własnego konta.
- Zasoby treści: pokoje, rezerwacje, aktualności, sale restauracyjne, menu
  kawiarni, atrakcje ośrodka, atrakcje Jarmarku, produkty gospodarstwa, FAQ,
  galeria, treści CMS.

## Multimedia

`FileUpload` zapisuje na dysk `public` z limitem 2 MB i listą dozwolonych typów.
`MediaOptimizeObserver` po zapisie uruchamia `ImageOptimizer`, który kompresuje
i konwertuje obrazy do WebP.

## Bezpieczeństwo

- Nagłówki `Strict-Transport-Security`, `X-Content-Type-Options`,
  `X-Frame-Options`, `Referrer-Policy`, `Permissions-Policy` oraz wymuszenie
  HTTPS w `public/.htaccess`.
- `@json(...)` z flagami `JSON_HEX_*` we wszystkich widokach.
- Dane z panelu trafiają do DOM przez `createElement`/`textContent`,
  nie przez `innerHTML`.
- `SESSION_SECURE_COOKIE=true` domyślnie w `.env.example`.

## Testy

`php artisan test` — 17 testów: dostępność tras publicznych, przekierowanie
niezalogowanego z `/admin`, oraz logika rezerwacji (kolejność dat, kolizje
terminów, rezerwacje anulowane, `booked_ranges`, `is_available_now`).
