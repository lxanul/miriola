# TODO — co pozostało do zrobienia

Lista zadań wynikających z przeglądu kodu opisanego w [`REVIEW.md`](REVIEW.md).
Oznaczenia (CR-1, H-4 itd.) odsyłają do konkretnych pozycji w `REVIEW.md`.

Stan na: 2026-08-12, gałąź `fix/codebase-review`.
Zamknięte w tej turze: sekcje 1, 3, 4, 5, 6, 8 + poświadczenia administratora
w bazie. Weryfikacja: `php artisan test` → 17/17, wszystkie trasy publiczne 200,
`/admin` przekierowuje niezalogowanych, `composer audit` i `npm audit` czyste.

---

## 0. Poświadczenia administratora — ZROBIONE

- [x] **Konta i hasła żyją w bazie, nie w `.env`.** `ADMIN_EMAIL`/`ADMIN_PASSWORD`
      tworzą wyłącznie **pierwsze** konto; seeder pomija ten krok, jeśli jakikolwiek
      administrator już istnieje, więc `db:seed` nie cofnie zmienionego hasła.
- [x] **Zmiana hasła w panelu:** `/admin/profile` (wbudowana strona Filamenta).
- [x] **Zarządzanie kontami:** „Ustawienia → Konta administratorów". Nie da się
      odebrać uprawnień ani usunąć własnego konta. `is_admin` pozostaje poza
      `$fillable` — ustawiane wyłącznie przez `forceFill`.

## 1. Do zrobienia przy wdrożeniu — PRZYGOTOWANE

- [x] `.env.example` ma teraz **domyślne wartości produkcyjne**: `APP_ENV=production`,
      `APP_DEBUG=false`, `LOG_LEVEL=error`, `SESSION_SECURE_COOKIE=true`. (M-2, M-3)
- [x] `php artisan storage:link` dopisane do skryptu `composer setup`. (CR-3)
- [ ] **Ustawić `APP_URL` na rzeczywistą domenę.** W `.env.example` jest celowo
      krzyczący placeholder `https://ZMIEN-NA-DOMENE-PRODUKCYJNA.pl` — z tego
      budują się adresy kanoniczne, JSON-LD i sitemap.
- [ ] **Ustawić `ADMIN_PASSWORD` przed pierwszym `db:seed`.** Seeder celowo rzuca
      wyjątkiem, gdy zmienna jest pusta, a konta administratora jeszcze nie ma. (CR-1)

## 2. Krytyczne — nadal otwarte

- [ ] **`public/sitemap.xml` — 7 adresów zakodowanych jako `http://127.0.0.1:8002`.**
      Google odrzuci całą mapę jako cross-domain. Docelowo: generować dynamicznie
      z `url()`. Dyrektywa `Sitemap:` pozostaje usunięta z `robots.txt`. (CR-8)
- [ ] **Migracja z Tailwind Play CDN na Vite.** Każda strona pobiera kompilator JIT
      i generuje CSS w przeglądarce — największy pojedynczy problem wydajnościowy.
      Vite + Tailwind v4 są skonfigurowane, ale **żaden widok nie wywołuje `@vite(...)`**.
      Wymaga przeniesienia konfiguracji z dialektu v3 (CDN) na v4. (CR-7)

## 3. Martwy kod — ZROBIONE (poza jedną komendą do uruchomienia)

- [x] `home.blade.php` — usunięte trzy modale pokoi (180 linii), których nie dało
      się otworzyć (`openRoomModal()` nie było nigdzie wywoływane) wraz z ich
      obsługą w JS. Zawierały ceny sprzeczne z `rooms.price_per_night`.
      Obsługa Escape dla działającego kalendarza dostępności została zachowana.
- [ ] **Do uruchomienia ręcznie** (blokada narzędziowa po stronie środowiska):

      ```
      git rm -r assets robots.txt code.html screen.png backend/resources/views/welcome.blade.php
      ```

      Uwaga: katalog `assets/` w korzeniu **nie jest** już kopią bajt w bajt
      `backend/public/assets/` — wcześniejsze poprawki (CR-5, CR-6) zmieniły
      `style.css` i `tailwind-config.js` tylko po stronie `backend/`. Korzeniowa
      kopia jest starsza i nieosiągalna z poziomu Laravela.

## 4. Bezpieczeństwo — ZROBIONE

- [x] **Walidacja `video_url`:** `->url()` + reguła dopuszczająca wyłącznie `https`
      z YouTube/Vimeo albo bezpośredni plik `.mp4`/`.webm`. Schematy `javascript:`
      i `data:` nie przechodzą. (H-3)
- [x] **Cztery wywołania `innerHTML`** zamienione na `createElement`/`setAttribute`.
      Adres iframe'a YouTube budowany jest z wyodrębnionego 11-znakowego ID, nie
      z surowego pola — `https://zly.pl/#youtube.com` już nie trafi do `src`. (H-4)
- [x] **`@json()` z flagami** `JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT`
      w `home.blade.php` (2×) i `hub.blade.php`. (H-2)
- [x] **Nagłówki bezpieczeństwa i wymuszenie HTTPS** w `public/.htaccess`: HSTS,
      `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`,
      `Permissions-Policy`. Przekierowanie obsługuje też serwery za proxy. (M-4)
- [x] **Walidacja terminów rezerwacji** w `Reservation::booted()` — a więc dla
      panelu, seedera i tinkera naraz: data wyjazdu musi być późniejsza niż
      przyjazdu, a terminy nie mogą kolidować z inną nieanulowaną rezerwacją tego
      samego pokoju. Doba wyjazdu może być dobą przyjazdu kolejnego gościa. (H-7)
- [x] **Wyciek danych gości zamknięty:** `Room::$hidden = ['reservations']`. Bez
      tego dołączenie relacji wysłałoby nazwiska, telefony i e-maile gości do
      `@json($rooms)` na publicznej stronie.

### Świadomie pominięte

- Ograniczenie `CHECK` na poziomie bazy dla dat rezerwacji. SQLite nie pozwala
  dodać go przez `ALTER TABLE` — wymagałoby przebudowy tabeli. Reguła w modelu
  pokrywa wszystkie ścieżki zapisu w tej aplikacji.

## 5. Poprawność danych — ZROBIONE

- [x] **Enumy jako jedyne źródło prawdy:** `App\Enums\{RoomType, CafeCategory, Branch}`.
      Wcześniej seeder zapisywał siedem kategorii pokoi, a panel oferował trzy inne —
      **9 z 10 pokoi** nie dawało się zapisać. To samo dotyczyło `CafeMenuItem::category`
      (`ciasta` vs `desery`) i `News::branch` (brak `farm`). Kolumny zostają typu
      string, bo widoki wypisują `{{ $room->room_type }}` wprost. (H-11)
- [x] **FAQ respektuje `branch`** — `/osrodek` pokazuje tylko `resort` i `general`. (H-17)
- [x] **Brakujące pola edytowalne:** `Room::price_per_night`, `price_unit`,
      `description`, `CafeMenuItem::price`, `FarmProduct::unit_price`. (H-18)
- [x] **`Room::is_available` usunięte** migracją — zostaje jedno źródło prawdy,
      akcesor `is_available_now`. (H-19)
- [x] **`maxLength(255)`** dodane na polach powiązanych z kolumnami `VARCHAR(255)`. (H-20)
- [x] **`->unique(ignoreRecord: true)`** na `news.slug`, `restaurant_halls.slug`
      i `cms_contents.key`, z czytelnymi komunikatami zamiast błędu 500. (H-21)
- [x] **N+1 zabity:** akcesory `Room` liczą z załadowanej relacji, trasa używa
      `Room::with('reservations')`. Lista pokoi to 2 zapytania zamiast ~30. (H-14)
- [x] **Seeder nie nadpisuje zdjęć.** Pomocnik `upsert()` pomija kolumny `image`,
      `images` i `main_image` dla istniejących rekordów. Zweryfikowane: zdjęcie
      podmienione ręcznie przeżywa `db:seed`, a teksty nadal się aktualizują.

### Pozostało z tej sekcji

- [ ] Ceny pokoi są nadal zdublowane w `cms_contents` (`room1_price`…). Klucze nie
      są już używane przez usunięte modale, ale same rekordy zostały w bazie.
- [ ] `/jarmark` nadal nie ma sekcji FAQ, więc pytania z `branch = jarmark` nie
      wyświetlają się nigdzie. Wcześniej pokazywały się na niewłaściwej stronie —
      to jest lepszy stan, ale docelowo trzeba dodać sekcję do widoku.

## 6. Testy — ZROBIONE

- [x] **`ExampleTest` naprawiony** — dodane `RefreshDatabase` oraz pokrycie
      wszystkich sześciu tras publicznych i przekierowania z `/admin`. (H-15)
- [x] **Naprawiony błąd, który blokował cały pakiet testowy:** `routes/web.php`
      deklarował globalną funkcję `getCmsData()`, a plik tras jest ładowany przy
      każdym starcie aplikacji — drugi test kończył się fatalnym
      „Cannot redeclare getCmsData()". Dodany strażnik `function_exists`.
- [x] **`ReservationTest`** — 9 testów logiki rezerwacji: kolejność dat, pobyt
      zerodniowy, kolizje terminów, styk wyjazd/przyjazd, inny pokój, rezerwacja
      anulowana, edycja własnej rezerwacji, `booked_ranges`, `is_available_now`.
- [x] Sekcja `<coverage>` w `phpunit.xml`. (L-24)
- [x] `composer audit` i `npm audit` — **0 podatności**.

## 7. SEO i dostępność — nadal otwarte

- [ ] **Strona główna nie ma `<h1>`.** Nagłówki zaczynają się od `<h2>`. (H-22)
- [ ] **`focus:outline-none` bez zamiennika na 28 elementach** — naruszenie WCAG 2.4.7. (H-23)
- [ ] **`/jarmark` i `/gospodarstwo` mają identyczny opis meta**, odziedziczony
      z layoutu i opisujący ośrodek. (H-25)
- [ ] **Zdjęcia hotlinkowane z `images.unsplash.com`** na ścieżce krytycznego
      renderowania. Pobrać i hostować lokalnie. (H-29)
- [ ] Brak `loading="lazy"` oraz `width`/`height` na ~12 obrazach → CLS. (M-38)
- [ ] `hub.blade.php` powiela layout zamiast go rozszerzać. (M-28)
- [ ] Zakodowane na sztywno liczby pokoi w 6 miejscach przy danych z bazy. (M-26)

## 8. Dokumentacja — ZROBIONE

- [x] **`plan.md` i `mirola-backend.md` napisane od nowa.** Opisywały aplikację,
      która nie powstała (Laravel 11, MySQL, JWT, role, tabele `bookings`,
      `services`, `audit_logs`, kontrolery, API). Teraz opisują stan faktyczny:
      Laravel 13.8, SQLite, autoryzacja sesyjna z flagą `is_admin`, trasy jako
      domknięcia, rzeczywisty schemat bazy.
- [x] **`DESIGN.md` opatrzony notatką o rozjazdach** z kodem: nieużywany kolor
      `secondary`, niestosowana zasada „accent wyłącznie dla CTA", `rounded-2xl`
      zamiast `rounded-lg`, inny profil cieni oraz nazewnictwo palety zakładające
      ośrodek nadmorski zamiast doliny Skawy. Decyzja „kod do dokumentu czy
      dokument do kodu" wymaga rozstrzygnięcia przed kolejną iteracją UI.

---

## Uwaga o weryfikacji

W tej turze zależności były już zainstalowane, więc w odróżnieniu od poprzedniego
przeglądu **uruchomiono automatyczne testy**: `php artisan test` → 17/17, migracje
przechodzą, `db:seed` uruchomiony dwukrotnie nie duplikuje danych i nie kasuje
wgranych zdjęć, wszystkie trasy publiczne zwracają 200, `/admin` przekierowuje
niezalogowanych, a `composer audit` i `npm audit` nie zgłaszają podatności.

Nadal **nie uruchomiono** `vendor/bin/pint` ani analizy statycznej (PHPStan nie
jest zależnością projektu).
