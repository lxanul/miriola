# MIRiOLA — Code Review

**Commit reviewed:** `f8ef666` · **Branch:** `fix/codebase-review` · **Date:** 2026-08-12
**Scope:** `backend/` Laravel app, root static files, `DESIGN.md` / `plan.md` / `mirola-backend.md`. `.agents/` excluded by request.

**Method:** full manual read plus three parallel specialist review passes (Laravel security, Filament/data layer, frontend + docs drift). Every finding below was independently re-verified against the source before being written down.

## Verification limits — read this first

`composer` is not installed on this machine and `backend/vendor/` + `backend/node_modules/` are absent. **PHPStan, Pint, PHPUnit, `composer audit` and `npm audit` could not be run.** What was run:

- `php -l` across `app/ routes/ config/ database/ bootstrap/ tests/` — **clean, zero syntax errors**
- `git ls-files` + regex sweep for committed secrets — **clean**
- manual byte-comparison (`md5sum`) of the duplicated asset trees
- targeted `grep` verification of every structural claim

Before shipping any of this, run `composer install && npm install && vendor/bin/pint --test && php artisan test && composer audit && npm audit`.

## Scorecard

| Severity | Count |
|---|---|
| CRITICAL | 9 |
| HIGH | 31 |
| MEDIUM | 38 |
| LOW | 26 |

### Clean bills of health

Genuinely fine, and worth knowing so nobody re-litigates it:

- **No committed secrets.** `backend/.env` is untracked and absent. `.gitignore` covers `.env*` and `storage/*.key`. Regex sweep for `base64:` APP_KEYs, AWS keys, private keys and bearer tokens across all tracked files returned nothing.
- **No SQL injection.** 100% Eloquent, zero string-concatenated SQL. The one user-controlled query input (`request()->query('branch')`, `routes/web.php:73`) is correctly gated by an `in_array` allowlist at `:76`.
- **No unescaped Blade.** Zero `{!! !!}` in the entire view tree. (The XSS findings below are all JavaScript-sink issues, not Blade-escaping issues.)
- **No open registration.** `AdminPanelProvider.php:29` calls `->login()` only — no `->registration()`.
- **CSRF intact.** `VerifyCsrfToken` present in the panel middleware stack, no `$except` anywhere, all public routes are GET.
- **Mass assignment handled.** Every model declares an explicit `$fillable`; none uses `$guarded = []`.
- **Password handling correct.** `'password' => 'hashed'` cast, `BCRYPT_ROUNDS=12`.
- **No dangerous sinks.** No `unserialize`, `eval`, `exec`, `shell_exec`, `system`, or XML parsing anywhere in `app/` or `routes/`.
- **Two-resources-over-one-model is correct.** `ResortAttractionResource` / `JarmarkAttractionResource` both override `getEloquentQuery()` with a `branch` filter, which Filament also uses for route-model binding — cross-branch access is not possible.

---

# CRITICAL

### CR-1 · Any authenticated user is a full admin — or nobody is
`backend/app/Providers/Filament/AdminPanelProvider.php:54-56` · `backend/app/Models/User.php:15`

`User` does not implement `Filament\Models\Contracts\FilamentUser`, and there are no policies. Filament v3's `Authenticate` middleware falls back to `abort_if(config('app.env') !== 'local', 403)` when the contract is absent. Two outcomes, both wrong:

- `APP_ENV=local` (**what `.env.example:2` ships, and what `composer setup` copies verbatim into `.env`**) → every row in `users` gets unrestricted `/admin`: full CRUD over reservations including guest names, phones and emails (GDPR-relevant personal data), all CMS content, and file upload.
- `APP_ENV=production` → 403 for everyone including the owner. The site becomes unadministerable.

Compounding it: **no admin user is ever seeded** (`grep -rn "User::" database/` → no matches), so the provisioning path is undefined.

```php
// app/Models/User.php
class User extends Authenticatable implements FilamentUser
{
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin === true;   // + migration adding the column
    }
}
```

### CR-2 · Seeding a live database destroys every guest reservation
`backend/database/seeders/DatabaseSeeder.php:170, 247, 385`

```php
Attraction::where('branch', 'resort')->delete();   // :170
\App\Models\GalleryImage::truncate();              // :247
\App\Models\Room::query()->delete();               // :385
```

`reservations.room_id` is `->constrained('rooms')->cascadeOnDelete()` (`2026_08_06_000008:13`). `Room::query()->delete()` therefore cascades and **wipes the entire reservations table**, along with all admin-uploaded rooms, gallery images and resort attractions. A seeder must be idempotent. Replace all three with `updateOrCreate()` on a natural key — the same file already uses that pattern elsewhere.

### CR-3 · `public/storage` symlink does not exist — every uploaded image 404s
`backend/public/` (verified absent)

Every DB-driven image resolves through `asset('storage/'.$path)` — 14 call sites across `hub`, `home`, `jarmark`, `gospodarstwo`, `aktualnosci`, plus 6 more built in JS. On a fresh deploy every room photo, news image, gallery item, menu photo and farm product photo is broken. It goes unnoticed today only because the seeder populates absolute Unsplash URLs instead of local paths.

Fix: `php artisan storage:link`, and add it to the `setup` script in `composer.json`.

### CR-4 · Upload disk is set on only 3 of 8 uploads — the other 5 write to a non-public directory
`FarmProductResource.php:40` · `RoomResource.php:60` · `GalleryImageResource.php:40` · `RestaurantHallResource.php:50` · `CmsContentResource.php:68`

Only `CafeMenuItemResource:49`, `JarmarkAttractionResource:90` and `NewsResource:60` call `->disk('public')`. The other five inherit `config('filesystems.default')`, which `.env.example:41` sets to `local` → `storage/app/private` (`config/filesystems.php:35`). Views then look for those files under `storage/app/public`. Farm products, rooms, gallery, halls and CMS graphics are structurally unable to display. This is independent of CR-3 and survives fixing it.

### CR-5 · The site's entire typographic scale is a no-op
`backend/public/assets/js/tailwind-config.js` (and its root duplicate)

The Tailwind config has **no `fontSize` key** (verified: `grep -c fontSize` → 0). `code.html:87-95` — the discarded prototype — does define `display-lg`, `headline-md`, `headline-sm`, `body-lg`, `body-md`, `label-caps`, exactly matching `DESIGN.md:51-88`.

**19 usages** of `text-display-lg` / `text-headline-*` / `text-body-lg` across the views therefore render at browser-default size (`home.blade.php:54,308,383,442`; `jarmark.blade.php:23,49`; `gospodarstwo.blade.php:27`; `polityka-prywatnosci.blade.php:9,14`, …). Every typographic hierarchy decision in `DESIGN.md` is absent from the live site.

Fix: port the `fontSize` block from `code.html:87-95` into `tailwind-config.js`.

### CR-6 · `theme()` in a statically-served CSS file — nav underline and card hover are dead
`backend/public/assets/css/style.css:19, 42`

```css
border-color: theme('colors.primary');       /* :19  .room-card:hover */
background-color: theme('colors.primary');   /* :42  .nav-underline::after */
```

`theme()` is a **build-time PostCSS function**, but this file is served verbatim via `<link href="{{ asset('assets/css/style.css') }}">` and never passes through a build. Both declarations are invalid CSS and are dropped by the browser: `.room-card:hover` gets no border colour, and the `.nav-underline` effect — used 19× across the navigation — is invisible. Fix: hardcode `#001e40`.

### CR-7 · Tailwind Play CDN in production, with the warning deliberately silenced
`backend/resources/views/layouts/app.blade.php:80-89` · `hub.blade.php:39-40`

Line 89 loads `https://cdn.tailwindcss.com` — a render-blocking `<script>` in `<head>` that ships the full JIT compiler and generates the entire stylesheet in the browser on every page load for every visitor. The single largest LCP/CLS regression on the site.

Lines 80-88 monkey-patch `console.warn` for the sole purpose of hiding Tailwind's own "should not be used in production" warning.

Worse, the repo *already* configures Tailwind v4 via `@tailwindcss/vite` + `@import 'tailwindcss'`, but **no routed view calls `@vite(...)`** — only the unreachable `welcome.blade.php:17`, and `public/build/` does not exist. So the project ships a v3 CDN and a v4 source tree that are mutually incompatible dialects, and uses neither correctly.

### CR-8 · SEO identity hardcoded to `127.0.0.1:8002`
`layouts/app.blade.php:40,41,42` · `backend/public/sitemap.xml` (7 occurrences) · `backend/public/robots.txt:16`

Schema.org JSON-LD `image`, `@id` and `url`; every `<loc>` in the sitemap; and the `Sitemap:` directive in robots.txt all point at a local dev port. Google rejects or mis-attributes the `Resort` entity on every page, and the sitemap is rejected as cross-domain. Fix: `{{ url('/') }}` / `{{ asset(...) }}`, and generate the sitemap from `config('app.url')`.

### CR-9 · Root `robots.txt` blocks the entire site
`/robots.txt:1-2`

```
User-agent: *
Disallow: /
```

Directly contradicts `backend/public/robots.txt`, which allows crawling. The repo root holds `assets/` and `code.html` mirroring the served layout, so if it is ever the docroot the whole site is de-indexed. The root copy is dead — delete it.

---

# HIGH

## Security

### H-1 · Stored XSS: news content flows into `innerHTML`
`hub.blade.php:395` · `aktualnosci.blade.php:151`

```js
document.getElementById('hub-modal-news-content').innerHTML = item.content || item.excerpt || '';
contentEl.innerHTML = content.replace(/\n/g, '<br>');
```

`News.content` is a plain `Textarea` (`NewsResource.php:54`) with no sanitizer. Blade escapes at the HTML layer, but the browser HTML-decodes an attribute *before* JS parses it — so the JS string holds raw markup, which `innerHTML` then executes. Any admin (or anyone exploiting CR-1) plants persistent JS running for every visitor on `/` and `/aktualnosci`.

Fix: `.textContent` + `white-space: pre-wrap`, which also removes the need for the `\n → <br>` hack.

### H-2 · `@json()` without hex flags — `</script>` breakout
`home.blade.php:873, 1205` · `hub.blade.php:387`

`@json` compiles to `json_encode($value, 0, 512)` — **no `JSON_HEX_TAG`**. A gallery `title` or room `name` containing `</script><script>…` terminates the block and executes. Fix: `@json($rooms, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP)` or `Js::from()`.

### H-3 · `video_url` is unvalidated and interpolated into `innerHTML`
`home.blade.php:1411, 1414` · `GalleryImageResource.php:44-47`

`video_url` is a plain `TextInput` — no `->url()`, no scheme allowlist, no length limit — and is template-string-interpolated into an `<iframe src>` / `<source src>`. A value of `x" onerror="…` breaks the attribute; `javascript:` and `data:` schemes pass straight through. Fix: `->url()` + host allowlist regex, and build the DOM with `createElement`/`setAttribute`.

### H-4 · No `maxSize()` or `acceptedFileTypes()` on any of the 8 uploads
All 8 `FileUpload` components

`->image()` maps to the `image` MIME rule and sets **no size ceiling** — the effective limit is `upload_max_filesize`. Each file is then fed to `imagecreatefromjpeg()`, which allocates ~`w × h × 4` bytes: a 20000×20000 decompression bomb is ~1 MB on disk and ~1.6 GB in RAM. `RoomResource.php:63` is `->multiple()` with no `maxFiles()`, multiplying it.

Fix: `->acceptedFileTypes(['image/jpeg','image/png','image/webp'])->maxSize(4096)`, `->maxFiles(20)` on the multiple one, plus a pixel-count guard in `ImageOptimizer` before decoding.

### H-5 · TinyPNG response overwrites the original with no validation
`ImageOptimizer.php:41-43`

```php
$compressedData = Http::withBasicAuth('api', $apiKey)->get($location)->body();
if ($compressedData) { file_put_contents($fullPath, $compressedData); }
```

`$location` comes from a response header and is re-fetched with no host validation; the body is checked only for non-emptiness. An error page, JSON error body or rate-limit HTML gets written over the user's original image, **destroying it irrecoverably**. There is no `->timeout()` either, so a hung tinify.com stalls the admin request thread. Fix: check `successful()` + `Content-Type: image/*` + length, write to a temp file, `getimagesize()`, then atomic `rename()`.

### H-6 · No path containment on the observer's filesystem write
`MediaOptimizeObserver.php:37`

`storage_path('app/public/'.$path)` concatenates a raw DB value into a filesystem path. `../../../../var/www/site/logo.png` resolves outside the storage root and is then overwritten by `file_put_contents`. The extension allowlist limits reach to image files, and it requires panel access — which is exactly what CR-1 hands out. One-line fix with `realpath()` + `str_starts_with`.

### H-7 · Reservations: no date-order check, no overlap check
`ReservationResource.php:66-76` · `2026_08_06_000008:17-18`

Both `DatePicker`s are only `->required()`. Nothing stops `check_out_date < check_in_date`, and nothing stops two `confirmed` reservations on the same room over overlapping ranges — which is the entire point of the module. `Room::getIsCurrentlyOccupiedAttribute()` then reports garbage and `booked_ranges` renders inverted ranges on the public site. Needs `->after('check_in_date')`, an overlap `->rule()`, and a DB-level CHECK constraint.

## Correctness

### H-8 · The WebP feature does nothing except double disk usage
`MediaOptimizeObserver.php:39` · `ImageOptimizer.php:71`

`optimizeAndConvertToWebp()` writes `photo.webp` and **returns the new path**. The observer throws the return value away. The DB still points at `photo.jpg`, which is what browsers download. Net effect: storage roughly doubles per upload, zero bytes saved on the wire. The commit message advertises "automatic WebP compression"; it is not wired up.

### H-9 · Observer re-compresses unchanged images on every save
`MediaOptimizeObserver.php:13-28`

`saved()` fires on every create and update, with no `wasChanged()` guard. Toggling `is_published` on a gallery item re-uploads the file to TinyPNG (billable, 500 free/month) and re-encodes it at quality 82 again. Ten edits = ten generations of compression artifacts on the same image. It also runs synchronously inside the admin request — a 10-image room save blocks on 10 HTTP round-trips.

### H-10 · Observer field list doesn't match the models it observes
`MediaOptimizeObserver.php:15` · `AppServiceProvider.php:31-37`

`$mediaFields = ['image','images','hero_image','cover_image']`. But `RestaurantHall` uses `main_image`/`gallery_images` and `CmsContent` uses `value` — both are registered observers and **both are silent no-ops**. `hero_image` and `cover_image` exist on no model at all. Meanwhile `Attraction` *has* an `image` column and an upload form but is **not observed**.

### H-11 · Seeded enum values don't match the admin Select options
`DatabaseSeeder.php:388-521` vs `RoomResource.php:37-41`

The seeder writes six `room_type` values (`Pokój 6-osobowy`, `Apartament 2-poziomowy`, `Domek z aneksem`, …). The Select offers three entirely different ones (`Pokój 2-osobowy`, `Apartament Rodzinny`, `Domek Letniskowy`). **9 of 10 seeded rooms open in the admin with a blank required field and cannot be saved** without silently changing their type.

Same class of bug twice more: `category => 'ciasta'` seeded vs `kawy|desery|przekaski` offered (and a *third* variant in the migration comment); `branch => 'farm'` seeded for News vs `resort|jarmark` offered. Fix: backed enums as the single source of truth.

### H-12 · Three room banners emit literal `' }}` and render invalid CSS
`home.blade.php:480, 540, 600`

```blade
style="background-image: url('{{ … }}' }}')"
```

The Blade expression closes at the first `}}`; the trailing `' }}` is emitted literally, producing `url('https://…' }}')`. Invalid CSS declaration — the banner is blank whenever `room1_image`/`room2_image`/`room3_image` is unset.

### H-13 · `toggleMoreRooms()` is defined twice
`home.blade.php:931-948` and `home.blade.php:1188-1203`

The second definition silently shadows the first, so the `scrollIntoView` in the first never runs and the collapsed label differs between the two ("(Pozostałe 7 Obiektów)" vs "(7 Obiektów)"). Delete `:931-948`.

### H-14 · `Room::$appends` fires 3 queries per row, serialized into the page
`Room.php:33-37` · `routes/web.php:43` · `home.blade.php:873`

All three accessors call `$this->reservations()` — a fresh query builder, never the loaded relation — and `getIsAvailableNowAttribute()` reads `is_currently_occupied`, which is a non-memoized accessor, so it queries *again*. `web.php:43` loads rooms with no `with('reservations')` and `home.blade.php:873` does `@json($rooms)`, forcing all of it. **~30 extra queries per `/osrodek` request** at the seeded 10 rooms, plus the same cost on the Filament list.

It also publishes the full confirmed-booking date grid to any visitor. No guest PII (dates only), so this is unintended disclosure rather than a breach — but confirm it's intended.

### H-15 · The only feature test is broken; coverage is effectively zero
`tests/Feature/ExampleTest.php:13-18` · `phpunit.xml:26-27`

`phpunit.xml` sets `DB_CONNECTION=sqlite` / `:memory:`, but `ExampleTest` does not use `RefreshDatabase` (commented out at line 5). `/` hits `News::where(...)->get()` against an empty in-memory DB with no tables → `QueryException` → 500 → `assertStatus(200)` fails. The CMS query on the same route only *appears* to work because of the swallowed exception in M-1.

`tests/Unit/ExampleTest.php` asserts `true === true`. These are the untouched Laravel stubs. **At zero coverage:** 11 models (including the `Room` availability accessors that encode the core booking logic), 11 Filament resources, 33 page classes, `ImageOptimizer`, `MediaOptimizeObserver`, all 7 routes, `DatabaseSeeder`.

### H-16 · Routes are closures + a global function — `route:cache` is impossible
`routes/web.php:14-21` and all 7 routes

Two problems. `function getCmsData(): array` at file scope fatals with "Cannot redeclare" if `web.php` is ever loaded twice. And every route is a `Closure`, so `php artisan route:cache` fails outright with *"Your route files contain closures"* — the production optimization path is unavailable.

### H-17 · `/osrodek` renders FAQs from every branch; `/jarmark` gets none
`routes/web.php:45` · `home.blade.php:450`

`Faq::where('is_published', true)` has no `branch` filter, and neither does the view. Jarmark-specific and general FAQs all leak onto the resort page, while `/jarmark` receives no FAQs at all — so jarmark FAQs are only ever visible on the wrong page. The `branch` column exists precisely to separate them.

### H-18 · Six columns are populated but not editable anywhere
`CafeMenuItem::$price` · `FarmProduct::$unit_price` · `Room::$price_per_night, $price_unit, $is_available, $description, $image`

All are `$fillable`, present in migrations, and seeded with real values (rooms 240-460 zł, products 7.50-45.00 zł) — but no Filament form exposes them, and most are never rendered either. Room prices are instead hardcoded into `cms_contents` rows `room1_price`/`room2_price`/`room3_price`, duplicating the same data in two places that will drift. `Room::description` *is* rendered publicly (`home.blade.php:767`) yet cannot be set.

### H-19 · `Room::$is_available` contradicts the computed availability
`2026_08_06_000007:18` · `Room.php:16, 54-57`

A stored `is_available` boolean coexists with a computed `is_available_now` accessor derived from reservations. Nothing writes the stored column except the seeder (always `true`); nothing reads it. Two sources of truth for one concept.

### H-20 · No `maxLength()` on 18 `TextInput`s bound to VARCHAR(255)
17 files, `maxLength` present only at `FaqResource.php:32`

Under MySQL strict mode an over-length value throws `SQLSTATE[22001] Data too long` — an unhandled 500 in the admin rather than a field-level message. Affects `name`, `title`, `slug`, `subtitle`, `guest_name`, `guest_phone`, `guest_email`, `unit_name`, `phone_contact`, `video_url`, `label`, `key`.

### H-21 · Unique DB constraints with no `unique()` form rule
`NewsResource.php:37-42` · `RestaurantHallResource.php:38-40` · `CmsContentResource.php:46-49`

`news.slug`, `restaurant_halls.slug` and `cms_contents.key` are `->unique()` in their migrations. Slug is auto-derived from the title, so **two articles with the same title produce an integrity-constraint 500**. Fix: `->unique(ignoreRecord: true)`.

## Frontend / SEO / a11y

### H-22 · Homepage has no `<h1>`
`hub.blade.php` (whole file)

Card titles start at `<h2>` (`:139,:184,:229`), news is another `<h2>` (`:263`). The site's most important page has no top-level heading. Promote the "Witaj w Sercu Doliny Skawy" block (`:102-111`) to `<h1>`.

### H-23 · `focus:outline-none` with no replacement on 28 interactive elements
`layouts/app.blade.php:308,311,314,338` · `hub.blade.php:51,66,76,86` · `home.blade.php` ×20

Keyboard users lose all focus indication on the scroll-to-top button, every footer social link, every gallery/lightbox arrow, all zoom controls and both availability tabs. WCAG 2.4.7 failure. Fix: append `focus-visible:ring-2 focus-visible:ring-primary`, or drop `focus:outline-none`.

### H-24 · `robots.txt` blocks all query strings
`backend/public/robots.txt:14` — `Disallow: /*?*`

Kills `/aktualnosci?branch=resort`, `?branch=jarmark`, and every `?page=N` from `paginate(12)->withQueryString()`. All paginated news beyond page 1 is uncrawlable. Drop the blanket rule; the canonical tag already handles duplication.

### H-25 · Two of five pages ship an identical, wrong meta description
`jarmark.blade.php:3-4` · `gospodarstwo.blade.php:3-4`

Neither declares `@section('meta_description')`, so both inherit the layout default describing the *resort* — the wrong business unit. Same for `og:description` and `twitter:description`.

### H-26 · `/regulamin` referenced but has no route
`backend/public/robots.txt:8` · `backend/public/sitemap.xml:44-49`

### H-27 · `/aktualnosci` missing from the sitemap
`backend/public/sitemap.xml` — a real, paginated, internally-linked route is absent.

### H-28 · Render-blocking third-party critical path
`layouts/app.blade.php:72,73,74,77,93`

Four render-blocking stylesheets in `<head>`: two Google Fonts requests, AOS CSS from `unpkg.com`, and `style.css`. Line 72 preloads the font CSS `as="style"` and line 73 requests **the same URL again** as a plain stylesheet — the preload buys nothing and doubles the entry.

### H-29 · Production hotlinks `images.unsplash.com`
`hub.blade.php:213` · `gospodarstwo.blade.php:6,14` · `home.blade.php:75,193,1224,1421`

Third-party dependency on the critical render path with no SLA. `gospodarstwo.blade.php:6` *preloads* a `w=1600` Unsplash image — a ~400 KB external blocking fetch for a page whose hero should be local.

### H-30 · Heroes served as full-size JPEG via CSS `background-image`
`backend/public/assets/img/hero.jpg`, `jarmark-hero.jpg`

Used as CSS backgrounds (`home.blade.php:18`, `jarmark.blade.php:10`, `hub.blade.php:123,168`), so no `srcset`, no `sizes`, no lazy loading is possible. Ironically the observer auto-converts *uploaded* media to WebP but never touches these committed static heroes.

### H-31 · Dead weight: ~900 removable lines
- **`/assets/` (524 KB)** — byte-identical unreferenced copy of `backend/public/assets/`. Verified by `md5sum`: `style.css`, `tailwind-config.js` and `hero.jpg` all match. Unreachable from Laravel (`asset()` resolves inside `backend/public`).
- **`code.html` (297 lines)** — dead prototype, diverged completely: advertises attractions that no longer exist, the wrong address, a footer map of **Władysławowo** (`:274` — wrong end of the country), `© 2024`, English labels. Its only remaining value is the `fontSize` block (CR-5).
- **`welcome.blade.php` (228 lines)** — stock Laravel starter, no route renders it. Carries a ~25 KB inline stylesheet and is the only file calling `@vite`.
- **`home.blade.php:471-650`** — three hardcoded room modals (~180 lines) that **can never open**: `openRoomModal()` is defined at `:1055` and called from nowhere. They hardcode prices and placeholder images contradicting the DB-driven `$rooms` data 30 lines above. Also `:902-909` (magic IDs `room1→1, room2→6, room3→9`, referenced only by these) and `:1054-1105`.
- **`home.blade.php:1036-1052`** — slideshow handler for `.room-slideshow`/`.room-image`; neither class appears in any Blade file.
- **`screen.png` (652 KB)** — screenshot committed to the repo.

---

# MEDIUM

## Config & deployment

- **M-1 · Silent failure swallows all DB errors.** `routes/web.php:16-21` — `catch (\Throwable) { return []; }` with no log. A missing table, bad credentials or a connection timeout renders as a silently degraded page with zero trace. This is also the only reason the sole feature test doesn't hard-fail (H-15).
- **M-2 · `.env.example` ships `APP_ENV=local` + `APP_DEBUG=true`**, and `composer setup` copies it verbatim. A deploy following the project's own documented command runs with full stack traces exposing paths, env vars and queries — and silently enables the "any user is admin" branch of CR-1.
- **M-3 · No `SESSION_SECURE_COOKIE`.** Absent from `.env.example`, so `config/session.php:172` resolves to `null`. Combined with M-4 the admin session cookie is interceptable.
- **M-4 · `.htaccess` is stock** — no HTTPS redirect, no HSTS, no `X-Content-Type-Options`, no `X-Frame-Options`, no `Referrer-Policy`, no CSP. The site serves an admin panel and collects guest PII.
- **M-5 · `env()` outside config.** `ImageOptimizer.php:29` — `config('services.tinypng.key', env('TINY_PNG_KEY'))`. Returns `null` once `config:cache` runs. `config/services.php:38` already defines the key, so the fallback is redundant *and* broken.
- **M-6 · No caching layer.** `Cache` is imported at `web.php:11` and never used. Every request to every page re-queries CMS strings, attractions and FAQs that change a few times a year.
- **M-7 · No indexes on any filtered/sorted column.** Every public route filters on `branch` + `is_published` and orders by `sort_order`/`published_at`, all unindexed. `reservations` also lacks a `(room_id, status, check_in_date, check_out_date)` index.

## Image pipeline

- **M-8 · `.webp` filename collision.** `photo.jpg` and `photo.png` in one directory both map to `photo.webp` — the second upload destroys the first. `imagewebp()`'s return value is never checked, so a failed write is reported as success.
- **M-9 · Incomplete GD guards.** `function_exists('imagewebp')` is checked but `imagecreatefromjpeg`/`imagecreatefrompng` are not. Failures degrade to a log line nobody reads; nothing surfaces to the admin UI.
- **M-10 · Old files are never deleted.** No `deleted()`/`updated()` observer handling. Replacing a gallery image or deleting a News row leaves the file in storage forever. Combined with H-8's duplicate `.webp` files, storage grows monotonically.

## Data layer

- **M-11 · Icon option array duplicated verbatim** (~36 lines) between `ResortAttractionResource.php:49-84` and `JarmarkAttractionResource.php:49-83`. Every new icon must be added twice. Also `JarmarkAttractionResource` has a `FileUpload` and `ResortAttractionResource` doesn't, so resort attractions can never get an image despite the column existing.
- **M-12 · Dead feature: `RestaurantHall`.** `$shouldRegisterNavigation = false`, no route queries it, no view references it — yet the model, migration, resource, 3 page classes and 42 lines of seeder data all exist and are maintained. Its `gallery_images` column has no upload field even if re-enabled.
- **M-13 · Three seeded reservations are unreachable.** `DatabaseSeeder.php:529-531` looks up rooms named `%103%`, `%202%`, `%Domek Letniskowy 2%`. **No seeded room has those names** (they're `Pokój Pomarańczowy`, `Domek nr 2`, …). All three `if` blocks are always false — 51 lines of dead code, and the booking-calendar demo data is empty.
- **M-14 · One-off data cleanup parked in the seeder.** `DatabaseSeeder.php:215-216` deletes FAQs matching `%zwierzęta%` — a retroactive fix that will re-run forever. Belongs in a one-time migration.
- **M-15 · `asset()` baked into seeded rows.** `DatabaseSeeder.php:141,152,163` store fully-qualified URLs containing whatever `APP_URL` was at seed time.
- **M-16 · No admin user seeded** (see CR-1). `UserFactory` exists and is never used.
- **M-17 · `DatabaseSeeder::run()` is 565 lines** in a single method, eight concerns interleaved.
- **M-18 · Missing integer casts** on `Attraction` (no `$casts` at all), `CafeMenuItem`, `FarmProduct`, `RestaurantHall`.
- **M-19 · Two model conventions.** `User` uses Laravel 13 `#[Fillable]` attributes + `casts()`; the other ten use legacy `$fillable`/`$casts` properties.
- **M-20 · Inconsistent news ordering.** `latest('published_at')` on `web.php:26,80` vs bare `latest()` (created_at) on `:42,:56`. A backdated article sorts differently depending on the page.
- **M-21 · Untyped observer parameter.** `MediaOptimizeObserver::saved($model)`.
- **M-22 · Unused imports.** `RelationManagers`, `Builder`, `SoftDeletingScope` across 5 resources (no model uses `SoftDeletes`); `Filament\Actions` in 5 Create pages; `RestaurantHall` and `Cache` in `routes/web.php`.
- **M-23 · Deletable boilerplate.** 5 empty `getRelations()` overrides returning `[]` (the parent already does), 5 empty `->filters([//])` no-ops.
- **M-24 · PSR-12 inline FQCNs.** `\App\Models\Room::` etc. in `routes/web.php:43,45,46` and ~18 sites in `DatabaseSeeder.php`, while sibling models are properly imported.

## Frontend

- **M-25 · Calendar hardcoded to August 2026.** `home.blade.php:875-876` — `let calYear = 2026; let calMonth = 7;`. The availability calendar opens on the same month forever.
- **M-26 · Hardcoded room counts in 6 places.** "Sprawdź Dostępność **10** Pokoi", "pozostałe (**7** Obiektów)", "**10** komfortowych pokojach", … while the data is `$rooms` from the DB. Adding an 11th room makes the site lie six times.
- **M-27 · Three orphaned closing tags.** `home.blade.php:651-653` — `</div></div></section>` with no matching openers. Browsers silently reparent, but it corrupts the `section[id]` scrollspy query.
- **M-28 · `hub.blade.php` duplicates the layout** instead of extending it: ~55 lines re-implementing head, header, footer and AOS init. Consequences: no JSON-LD on the homepage, a *different* Material Symbols font URL than every other page, and the manifest link existing only there.
- **M-29 · ~115 duplicated lines** between the "top 3 rooms" and "remaining rooms" grids (`home.blade.php:71-183` / `:189-287`), differing only in `data-aos` and the badge.
- **M-30 · `<link rel="manifest">` missing from the layout** — only `hub.blade.php:13` has it, so four of five pages aren't installable.
- **M-31 · `apple-touch-icon.png` exists but is unused** — the layout points `apple-touch-icon` at `favicon.png`.
- **M-32 · Canonical drops the query string.** `url()->current()` makes `?page=2` self-canonicalise to page 1, hiding all paginated content.
- **M-33 · `scrollbar-none` is never defined** — not in `style.css`, not in the config, no plugin. Scrollbars remain visible in all 4 horizontal strips.
- **M-34 · v4 shadow names under the v3 CDN.** 19 occurrences of `shadow-xs`/`shadow-2xs` don't exist in v3 → no shadow renders.
- **M-35 · Interactive `onclick` on `<div>`/`<h3>`/`<article>`** with no `role`, `tabindex` or keyboard handler. The room lightbox and hub news modal are mouse-only.
- **M-36 · Modals have no focus trap, no focus restore**, and two lack `role="dialog"`/`aria-modal`.
- **M-37 · `onclick="this.blur()"`** on the footer social links actively strips focus after activation.
- **M-38 · No `loading="lazy"` / `width` / `height`** on ~12 image sites. `aktualnosci.blade.php:61` is a 224px cover repeated up to 12× per page, all eager. CLS on every image.

---

# LOW

- **L-1** · `home.blade.php:1382,1440` — unescaped URL interpolated into an `img src` attribute via `innerHTML`.
- **L-2** · `bootstrap/app.php:17-20` — `shouldRenderJsonWhen(fn ($r) => $r->is('api/*'))` configured but no `api:` routes file and no matching route. Dead config.
- **L-3** · `bootstrap/app.php:14-16` — empty `withMiddleware()` closure.
- **L-4** · No route names anywhere. Every Blade link hardcodes a path string.
- **L-5** · `/sitemap.xml` route is dead — `.htaccess` serves the physical file first. Also no `file_exists` guard, so a missing file is a 500 rather than a 404.
- **L-6** · `web.php:42` — `News::where('branch','resort')->get()` is unbounded.
- **L-7** · `ReservationResource.php:33,137` — `Room::orderBy(...)->pluck()` runs an extra query per render; `->relationship('room','name')` would also fix the `room.name` column's N+1.
- **L-8** · `GalleryImageResource.php:31-47` — `media_type` is `->live()` but nothing is conditionally shown or required. A row can be saved with neither an image nor a `video_url`.
- **L-9** · `CmsContentResource.php:51-60` — `type` Select has no `->required()` despite the column being NOT NULL.
- **L-10** · `$cms` is never passed to `/polityka-prywatnosci` (`web.php:85`) though the layout reads four keys from it. Survives only via `??`; the footer silently falls back on that page.
- **L-11** · `addslashes()` used to build a JS argument list (`aktualnosci.blade.php:97`). Beyond the escaping smell, **`addslashes` does not escape newlines** — `content` comes from a `Textarea`, so any multi-paragraph article produces an unterminated JS string literal and the "read more" button silently dies. Broken for essentially every real article.
- **L-12** · Convoluted CMS merge at `web.php:33-40` — defaults reference `$dbCms[...]` and are then `array_merge`d with `$dbCms`; lines 37-38 are dead weight.
- **L-13** · `role="navigation"` on a `<div>` inside `<nav>` — duplicate landmark.
- **L-14** · `<img src="">` in the initial DOM (`hub.blade.php:348`, `aktualnosci.blade.php:130`) triggers a spurious request to the page URL; alt text is a fixed generic string rather than the article title.
- **L-15** · Contrast risks at `text-xs`: `text-surface-dim/60` on `bg-tertiary` ≈ 4.2:1, `text-primary/60` on `#fbf9f8` ≈ 4.0:1 (needs 4.5:1).
- **L-16** · Two un-throttled `scroll` listeners; `updateScrollspy` reads `section.offsetTop` for every section on every frame → forced synchronous layout.
- **L-17** · `scale-108` (`home.blade.php:338`) is not a valid v3 scale value.
- **L-18** · Empty-state `col-span-3`/`col-span-2`/`col-span-4` on grids that are `grid-cols-1` at mobile → overflow. Use `col-span-full`.
- **L-19** · No SRI on any third-party CDN script (Tailwind, AOS).
- **L-20** · `og:image` is `hero.jpg` on every page including `/jarmark` and `/gospodarstwo`, which have their own hero art.
- **L-21** · `<meta name="keywords">` — ignored since 2009, identical on every page.
- **L-22** · Copy typos: "wróc tu niebawem" → "wróć" (`aktualnosci.blade.php:108`); "Twój przeglądarka" → "Twoja" (`home.blade.php:1414`).
- **L-23** · Inconsistent excerpt fallback: `Str::limit($article->content, 140)` (raw, tags included) vs `Str::limit(strip_tags(...), 120)`.
- **L-24** · `phpunit.xml` has no `<coverage>` element, so `--coverage-text` produces nothing.
- **L-25** · No model is `final`; no `@var list<string>` docblocks on `$fillable`.
- **L-26** · Farm news is unreachable: `web.php:76` whitelists `'farm'` and `News.branch` supports it, but `aktualnosci.blade.php:36-50` offers no `branch=farm` tab.

---

# Documentation drift

`plan.md` and `mirola-backend.md` describe **a different application than the one that was built**. Nearly every technical claim is false. Acting on them would cause real damage.

| Doc claim | Reality |
|---|---|
| "Laravel 11", "PHP 8.2+" | `laravel/framework: ^13.8`, `php: ^8.3` |
| "MySQL 8.0+" | `DB_CONNECTION=sqlite`; all MySQL vars commented out |
| **"JWT auth via `tymon/jwt-auth`", "role-based authorization"** | **`tymon/jwt-auth` is not a dependency. There is no JWT and there are no roles** — `users` has no `role` and no `phone` column. Auth is Filament's stock session login |
| table `bookings` (`check_in`, `user_id`, `total_price`) | table is `reservations`, different shape, `check_in_date`/`check_out_date` |
| table `gallery_photos` (`file_path`, `is_active`) | table is `gallery_images` (`image`, `is_published`, `media_type`, `video_url`, `branch`) |
| table `audit_logs` + "admin operation logging" | **never built** |
| table `services` ("dodatkowe usługi") | **never built** |
| `rooms` has `slug`, `image_path`, `is_active` | none of those exist; has `room_type`, `price_unit`, `is_available`, `image` |
| `cms_contents` = `id, key, value` | also has `label`, `type`, `group` |
| **"API pod integracje", "CmsController", "kontrolery CRUD"** | **No API, no controllers.** `app/Http/Controllers/` holds only the abstract stub. No `routes/api.php`. All routes are inline closures |
| "File Storage: `storage/app/public/cms`" | uploads go to per-model directories; `robots.txt:12` still disallows the phantom `/storage/cms/private/` |
| `DESIGN.md:51-88` typography scale | **not implemented at all** (CR-5) |
| `DESIGN.md` "Secondary (Sandy Beige) for backgrounds, dividers, card borders" | `secondary` is defined in the config and **used in zero Blade views** |
| `DESIGN.md` "Accent reserved **strictly** for primary CTAs" | also used for pulse dots, bullets, icon tints, hover states |
| `DESIGN.md` "4px base radius, `rounded-lg` for cards" | cards use `rounded-2xl` (16px), modals `rounded-3xl` — 2-4× softer |
| `DESIGN.md` "avoiding heavy shadows, 4-6% opacity" | `shadow-xl`/`shadow-2xl` used 40+ times vs 7 uses of the compliant `.ambient-shadow` |
| `DESIGN.md` "premium **coastal** resort", "Deep **Sea** Blue" | inland river-valley resort near Wadowice. The brief was written for a seaside property — which also explains `code.html:274`'s map of Władysławowo |
| every "Success Criteria" checkbox | still `[ ]` unchecked despite the work shipping in `f8ef666` |

### Implemented but documented nowhere

The three-business-unit hub architecture (the entire product shape — the docs describe a single-resort site); the `news`/Aktualności subsystem with branch filtering and pagination; `faqs` + the FAQ accordion; `attractions` with branch discrimination and two Filament resources; `cafe_menu_items` + the café menu; `farm_products` + the produce catalogue; `restaurant_halls` (built, imported, never rendered); gallery video support with YouTube embedding; the WebP compression pipeline; `Room.images`/`amenities` JSON arrays driving the carousels and lightbox; the customer-facing availability calendar; the cookie consent banner; `/polityka-prywatnosci`; and the entire SEO/PWA layer.

---

# Recommended order of attack

1. **CR-1** — gate `/admin`. Nothing else matters until authentication actually authorizes. Add `FilamentUser` + `is_admin` + an admin seeder.
2. **CR-2** — stop the seeder destroying reservations.
3. **CR-3 + CR-4** — `storage:link` and the missing `->disk('public')`. Every uploaded image is currently broken.
4. **CR-5 + CR-6** — port the `fontSize` block, hardcode the two `theme()` colours. Two small edits that repair the site's entire typographic and navigational styling.
5. **CR-8 + CR-9** — kill the `127.0.0.1` hardcodes, delete the root `robots.txt`.
6. **H-1 + H-2** — replace the `innerHTML` news sinks with `textContent`.
7. **H-8/H-9/H-10 + M-5/M-8/M-9/M-10** — one refactor of the image pipeline. Right now it costs disk and API quota for zero benefit.
8. **H-7** — reservation overlap validation + DB constraint.
9. **H-31** — delete ~900 lines of dead code. Zero behaviour change.
10. **CR-7** — migrate off the Play CDN to the already-configured Vite pipeline.
11. **H-15** — fix the test suite, then cover the booking logic.
12. Rewrite `plan.md` and `mirola-backend.md` from the live schema.
