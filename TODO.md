# TODO — co pozostało do zrobienia

Lista zadań wynikających z przeglądu kodu opisanego w [`REVIEW.md`](REVIEW.md).
Naprawione zostały wszystkie błędy krytyczne poza wskazanymi niżej. Oznaczenia
(CR-1, H-4 itd.) odsyłają do konkretnych pozycji w `REVIEW.md`.

Stan na: 2026-08-12, gałąź `fix/codebase-review`.

---

## 1. Zrobić natychmiast po wdrożeniu

- [ ] **Ustawić `ADMIN_PASSWORD` w `.env` na produkcji.** Seeder celowo rzuca
      wyjątkiem, gdy zmienna jest pusta — nie ma już domyślnego hasła. (CR-1)
- [ ] **Uruchomić `php artisan storage:link`** na serwerze docelowym. Bez tego
      wszystkie zdjęcia wgrane przez panel zwracają 404. Warto dopisać to do
      skryptu `setup` w `composer.json`. (CR-3)
- [ ] **Ustawić `APP_DEBUG=false` i `APP_ENV=production`.** Obecnie `.env.example`
      zawiera wartości deweloperskie, a `composer setup` kopiuje je bez zmian. (M-2)
- [ ] **Ustawić `SESSION_SECURE_COOKIE=true`** (wymaga HTTPS). Klucz został dodany
      do `.env.example`, ale domyślnie jest wyłączony. (M-3)
- [ ] **Nadać `is_admin = true`** właściwym kontom. Nowe konta domyślnie nie mają
      dostępu do `/admin` — zabezpieczenie działa „fail closed".

## 2. Krytyczne — pozostawione świadomie

- [ ] **`public/sitemap.xml` — 7 adresów zakodowanych jako `http://127.0.0.1:8002`.**
      Google odrzuci całą mapę jako cross-domain. Docelowo: generować mapę
      dynamicznie z `url()` zamiast trzymać statyczny plik. Do czasu naprawy
      dyrektywa `Sitemap:` została usunięta z `robots.txt`, żeby nie zgłaszać
      wyszukiwarkom pliku, który i tak zostanie odrzucony. (CR-8)
- [ ] **Migracja z Tailwind Play CDN na Vite.** Obecnie każda strona pobiera
      kompilator JIT i generuje CSS w przeglądarce — to największy pojedynczy
      problem wydajnościowy serwisu. Projekt ma już skonfigurowany Vite
      + Tailwind v4 (`vite.config.js`, `resources/css/app.css`), ale **żaden
      widok nie wywołuje `@vite(...)`**. Wymaga przeniesienia konfiguracji
      z dialektu v3 (CDN) na v4 — dlatego nie zostało zrobione „przy okazji". (CR-7)

## 3. Usunięcie martwego kodu (~900 linii, zero zmian w działaniu)

Wszystkie pozycje zweryfikowane — nic się do nich nie odwołuje:

- [ ] `assets/` w katalogu głównym — kopia bajt w bajt `backend/public/assets/`
      (potwierdzone `md5sum`), nieosiągalna z poziomu Laravela.
- [ ] `robots.txt` w katalogu głównym — zawiera `Disallow: /`, czyli blokuje
      cały serwis. Sprzeczny z `backend/public/robots.txt`. (CR-9)
- [ ] `code.html` — martwy prototyp. Zawiera nieaktualne atrakcje, zły adres,
      mapę **Władysławowa** w stopce i `© 2024`.
- [ ] `screen.png` (652 KB) — zrzut ekranu w repozytorium.
- [ ] `backend/resources/views/welcome.blade.php` — domyślny widok Laravela,
      żadna trasa go nie renderuje.
- [ ] `home.blade.php:471-650` — trzy modale pokoi, których **nie da się otworzyć**
      (`openRoomModal()` nie jest nigdzie wywoływana). Zawierają zakodowane na
      sztywno ceny sprzeczne z danymi z bazy. Razem z `:902-909` i `:1054-1105`.

Komenda: `git rm -r assets robots.txt code.html screen.png backend/resources/views/welcome.blade.php`

## 4. Bezpieczeństwo

- [ ] **Walidacja `video_url`.** Pole to zwykły `TextInput` bez `->url()` i bez
      listy dozwolonych domen, a trafia do `innerHTML` w atrybucie `src`.
      Schematy `javascript:` i `data:` przechodzą bez przeszkód. (H-3)
- [ ] **Pozostałe cztery wywołania `innerHTML`** w `home.blade.php:1369, 1398,
      1401, 1427` budują HTML z niewalidowanych danych. Zamienić na
      `createElement` + `setAttribute`. (H-4)
- [ ] **`@json()` bez flag `JSON_HEX_TAG`** w `home.blade.php:873, 1205`
      i `hub.blade.php:387` — tytuł zawierający `</script>` przerywa blok. (H-2)
- [ ] **Nagłówki bezpieczeństwa i przekierowanie na HTTPS** w `public/.htaccess`:
      HSTS, `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`. (M-4)
- [ ] **Walidacja terminów rezerwacji.** Nic nie pilnuje, żeby data wyjazdu była
      późniejsza niż data przyjazdu, ani nie blokuje podwójnej rezerwacji tego
      samego pokoju na zachodzące na siebie terminy — czyli sedno tego modułu.
      Potrzebne `->after('check_in_date')`, reguła sprawdzająca kolizje oraz
      ograniczenie `CHECK` na poziomie bazy. (H-7)

## 5. Poprawność danych

- [ ] **Wartości `room_type` w seederze nie pasują do listy w panelu.** Seeder
      zapisuje sześć wartości (`Pokój 6-osobowy`, `Apartament 2-poziomowy`, …),
      a `RoomResource` oferuje trzy zupełnie inne. **9 z 10 pokoi** otwiera się
      w panelu z pustym wymaganym polem i nie da się ich zapisać bez zmiany
      kategorii. To samo dotyczy `CafeMenuItem::category` i `News::branch`.
      Docelowo: enumy PHP jako jedyne źródło prawdy. (H-11)
- [ ] **FAQ ignoruje kolumnę `branch`.** `/osrodek` pokazuje wszystkie pytania
      niezależnie od działu, a `/jarmark` nie dostaje żadnych — więc pytania
      dotyczące Jarmarku widać wyłącznie na niewłaściwej stronie. (H-17)
- [ ] **Sześć kolumn jest wypełnianych, ale nieedytowalnych z panelu:**
      `CafeMenuItem::price`, `FarmProduct::unit_price`, `Room::price_per_night`,
      `price_unit`, `is_available`, `description`. Ceny pokoi są dodatkowo
      zdublowane w `cms_contents` (`room1_price`…), co się rozjedzie. (H-18)
- [ ] **`Room::is_available` kontra `is_available_now`** — dwa źródła prawdy dla
      tego samego pojęcia. Kolumnę można usunąć. (H-19)
- [ ] **Brak `maxLength(255)`** na 18 polach `TextInput` powiązanych z kolumnami
      `VARCHAR(255)`. W trybie strict MySQL to błąd 500 zamiast komunikatu. (H-20)
- [ ] **Brak `->unique(ignoreRecord: true)`** na `news.slug`,
      `restaurant_halls.slug` i `cms_contents.key`. Slug powstaje z tytułu, więc
      dwa artykuły o tej samej nazwie kończą się błędem 500. (H-21)
- [ ] **`Room::$appends` generuje ~30 zapytań na każde wejście na `/osrodek`.**
      Usunąć `$appends`, dodać `with('reservations')` i liczyć w pamięci. (H-14)
- [ ] **Seeder nadpisuje `images` przy każdym uruchomieniu** — zdjęcia wgrane
      przez właściciela zostaną zastąpione linkami z Unsplash. Rozważyć
      `firstOrCreate()` dla treści przykładowych.

## 6. Testy

- [ ] **Naprawić `tests/Feature/ExampleTest.php`** — brakuje `RefreshDatabase`,
      więc test uderza w pustą bazę i zwraca 500. Jedyny test funkcjonalny
      w projekcie jest niesprawny. (H-15)
- [ ] **Pokryć testami logikę rezerwacji** — dostępność pokoju, daty graniczne,
      `booked_ranges`, kolizje terminów. To serce systemu i ma zerowe pokrycie.
- [ ] Dodać sekcję `<coverage>` do `phpunit.xml`. (L-24)
- [ ] Uruchomić `composer audit` i `npm audit` — nie były wykonane podczas
      przeglądu, bo `vendor/` nie było zainstalowane.

## 7. SEO i dostępność

- [ ] **Strona główna nie ma `<h1>`.** Nagłówki zaczynają się od `<h2>`. (H-22)
- [ ] **`focus:outline-none` bez zamiennika na 28 elementach** — osoby
      korzystające z klawiatury tracą wskaźnik fokusu. Naruszenie WCAG 2.4.7. (H-23)
- [ ] **`/jarmark` i `/gospodarstwo` mają identyczny opis meta**, odziedziczony
      z layoutu i opisujący ośrodek, czyli niewłaściwy dział firmy. (H-25)
- [ ] **Zdjęcia hotlinkowane z `images.unsplash.com`** na ścieżce krytycznego
      renderowania. Pobrać i hostować lokalnie. (H-29)
- [ ] Brak `loading="lazy"` oraz `width`/`height` na ~12 obrazach → CLS. (M-38)
- [ ] `hub.blade.php` powiela layout zamiast go rozszerzać: brak JSON-LD na
      stronie głównej, inny wariant fontu Material Symbols niż reszta. (M-28)
- [ ] Zakodowane na sztywno liczby pokoi w 6 miejscach („10 Pokoi", „7 Obiektów")
      przy danych pobieranych z bazy. (M-26)

## 8. Dokumentacja

- [ ] **Napisać `plan.md` i `mirola-backend.md` od nowa.** Opisują aplikację,
      która nie powstała: Laravel 11 zamiast 13, MySQL zamiast SQLite,
      autoryzację JWT (`tymon/jwt-auth` nie jest zależnością projektu), role
      użytkowników (kolumna nie istnieje), tabele `bookings`, `services`
      i `audit_logs` (nie istnieją) oraz kontrolery i API (nie istnieją —
      wszystkie trasy to domknięcia). Pełne zestawienie w `REVIEW.md`.
- [ ] **Zaktualizować `DESIGN.md`** albo kod. Skala typografii została
      przywrócona, ale reguły dotyczące koloru `secondary` (nieużywany), zasady
      „accent wyłącznie dla CTA", promieni zaokrągleń (`rounded-2xl` zamiast
      `rounded-lg`) i cieni nie odpowiadają rzeczywistości. Dokument opisuje
      też ośrodek **nadmorski**, a obiekt leży w dolinie Skawy.

---

## Uwaga o weryfikacji

Przegląd i poprawki powstały bez możliwości uruchomienia `vendor/bin/pint`,
PHPStan czy `php artisan test` — środowisko nie miało Composera. Po instalacji
zależności aplikacja została uruchomiona i sprawdzona ręcznie: wszystkie
10 tras zwraca 200, blokada `/admin` działa (`ALLOW` dla administratora,
`DENY` dla zwykłego konta), a `db:seed` uruchomiony dwukrotnie nie duplikuje
ani nie kasuje danych. Nadal jednak **nie uruchomiono automatycznych testów
ani analizy statycznej** — to pierwsza rzecz do zrobienia.
