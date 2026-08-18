# Plan / stan implementacji backendu MIRiOLA

> Ten dokument opisuje **stan faktyczny**. Poprzednia wersja opisywała aplikację,
> która nigdy nie powstała (Laravel 11, MySQL, JWT, role użytkowników, tabele
> `bookings`, `services`, `audit_logs`, kontrolery i API). Szczegóły rozjazdu:
> `REVIEW.md`.

## Czym to jest

Serwis wizytówkowy trzech działów firmy (Ośrodek Wypoczynkowy, Jarmark CEH
z kawiarnią, Gospodarstwo Ogrodniczo-Pszczelarskie) w dolinie Skawy, z panelem
administracyjnym do samodzielnej edycji treści przez właściciela oraz
wewnętrznym grafikiem rezerwacji pokoi.

To **nie jest** system rezerwacji online dla gości — goście nie zakładają kont
i nie rezerwują sami. Rezerwacje wprowadza obsługa w panelu, a strona pokazuje
jedynie kalendarz dostępności.

## Stos technologiczny (zweryfikowany w `composer.json` / `composer.lock`)

| Warstwa        | Rzeczywistość                                              |
|----------------|------------------------------------------------------------|
| Framework      | Laravel 13.8, PHP ^8.3                                      |
| Panel admina   | Filament 3.3                                                |
| Baza danych    | SQLite (`database/database.sqlite`)                         |
| Autoryzacja    | Sesyjna (Laravel), dostęp do `/admin` przez `users.is_admin` |
| Widoki         | Blade, renderowanie po stronie serwera                      |
| Pliki          | Dysk `public` + `php artisan storage:link`                  |
| Testy          | PHPUnit 12                                                  |

Nie ma: JWT, API REST, kontrolerów, ról użytkowników, MySQL-a, kolejek w użyciu.
Wszystkie trasy publiczne to domknięcia w `routes/web.php`.

## Co jest zrobione

- [x] Sześć tras publicznych: `/`, `/osrodek`, `/jarmark`, `/gospodarstwo`,
      `/aktualnosci`, `/polityka-prywatnosci` (+ `/sitemap.xml`).
- [x] Panel Filament pod `/admin` z 12 zasobami (pokoje, rezerwacje, aktualności,
      sale, menu kawiarni, atrakcje, produkty gospodarstwa, FAQ, galeria, treści
      CMS, konta administratorów).
- [x] Dostęp do panelu „fail closed": `User::canAccessPanel()` wymaga
      `is_admin = true`. Nowe konta domyślnie nie mają dostępu.
- [x] Poświadczenia administratora w bazie. `ADMIN_EMAIL`/`ADMIN_PASSWORD`
      z `.env` służą wyłącznie do utworzenia **pierwszego** konta; potem hasło
      zmienia się w `/admin/profile`, a seeder nigdy go nie nadpisuje.
- [x] Reguły terminów rezerwacji pilnowane w modelu (`Reservation::booted`):
      wyjazd po przyjeździe, brak kolizji terminów w tym samym pokoju.
      Obowiązują tak samo dla panelu, seedera i tinkera.
- [x] Enumy `App\Enums\{RoomType, CafeCategory, Branch}` jako jedyne źródło list
      wyboru — wcześniej panel i seeder używały rozjeżdżających się wartości.
- [x] Automatyczna kompresja i konwersja obrazów (`ImageOptimizer`
      + `MediaOptimizeObserver`).
- [x] Seeder idempotentny; nie nadpisuje zdjęć wgranych przez właściciela.
- [x] Testy: 17 testów (trasy publiczne, blokada `/admin`, logika rezerwacji).

## Co pozostało

Aktualna lista zadań: [`TODO.md`](TODO.md). Największe otwarte pozycje to
migracja z Tailwind Play CDN na Vite oraz dynamiczne generowanie `sitemap.xml`.

## Uruchomienie

```bash
cd backend
composer setup          # instalacja, .env, klucz, migracje, storage:link, build
php artisan db:seed     # dane przykładowe + pierwsze konto administratora
php artisan serve
```

Przed `db:seed` ustaw `ADMIN_PASSWORD` w `.env` — bez tego seeder celowo rzuca
wyjątkiem, żeby nigdy nie powstało konto ze znanym hasłem.
