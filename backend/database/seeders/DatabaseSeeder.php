<?php

namespace Database\Seeders;

use App\Models\Attraction;
use App\Models\CafeMenuItem;
use App\Models\CmsContent;
use App\Models\Faq;
use App\Models\FarmProduct;
use App\Models\GalleryImage;
use App\Models\News;
use App\Models\Reservation;
use App\Models\RestaurantHall;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /** Kolumny z multimediami, których seeder nie może nadpisać. */
    private const MEDIA_COLUMNS = ['image', 'images', 'main_image'];

    /**
     * Jak updateOrCreate, ale dla ISTNIEJĄCEGO rekordu pomija kolumny ze
     * zdjęciami. Bez tego każde `db:seed` podmieniało zdjęcia wgrane przez
     * właściciela z powrotem na linki z Unsplash.
     *
     * @param  class-string<Model>  $model
     */
    private function upsert(string $model, array $key, array $attributes): Model
    {
        $existing = $model::where($key)->first();

        if ($existing) {
            return tap($existing)->update(Arr::except($attributes, self::MEDIA_COLUMNS));
        }

        return $model::create($key + $attributes);
    }

    public function run(): void
    {
        // 0. Konto administratora — wyłącznie bootstrap pierwszego konta.
        //    Poświadczenia są źródłem prawdy w bazie: hasło zmienia się w panelu
        //    (/admin/profile), a konta zakłada się w „Ustawienia → Konta
        //    administratorów". Dlatego seeder nigdy nie nadpisuje istniejącego
        //    konta — ponowne `db:seed` nie cofnie zmienionego hasła.
        if (! User::where('is_admin', true)->exists()) {
            throw_if(
                blank(config('app.admin_password')),
                \RuntimeException::class,
                'Brak konta administratora, a ADMIN_PASSWORD nie jest ustawione — ustaw je w .env, żeby utworzyć pierwsze konto.'
            );

            $admin = User::updateOrCreate(
                ['email' => config('app.admin_email')],
                [
                    'name' => 'Administrator',
                    'password' => config('app.admin_password'), // cast 'hashed' zajmuje się skrótem
                ]
            );
            // Ustawiane poza $fillable, żeby flaga uprawnień nigdy nie dała się
            // ustawić przez mass assignment.
            $admin->forceFill(['is_admin' => true])->save();
        }

        // 1. Restaurant Halls
        $this->upsert(RestaurantHall::class,
            ['slug' => 'sala-glowna-biesiadna'],
            [
                'name' => 'Sala Główna Biesiadna',
                'subtitle' => 'Tradycyjny klimat, kominek i miejsce na duże przyjęcia',
                'capacity' => 120,
                'description' => 'Przestronna, elegancko wykończona w drewnie i kamieniu sala biesiadna. Idealna na wesela, bankiety firmowe, chrzciny oraz spotkania rodzinne. Wyposażona w nowoczesne nagłośnienie, klimatyzację oraz bezpośrednie wyjście do ogrodu.',
                'main_image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80',
                'features' => ['Klimatyzacja', 'Nagłośnienie', 'Kominek', 'Wyjście do ogrodu', 'Parkiet taneczny'],
                'sort_order' => 1,
            ]
        );

        $this->upsert(RestaurantHall::class,
            ['slug' => 'sala-kameralna-tarasowa'],
            [
                'name' => 'Sala Kameralna Tarasowa',
                'subtitle' => 'Kameralna atmosfera z panoramicznym widokiem na Dolinę Skawy',
                'capacity' => 45,
                'description' => 'Jasna i przytulna sala usytuowana na piętrze, z wyjściem na rozległy zadaszony taras. Doskonała na kameralne przyjęcia rodzinne, spotkania biznesowe czy jubileusze z pięknym widokiem na naturę.',
                'main_image' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1200&q=80',
                'features' => ['Zadaszony taras', 'Widok na dolinę', 'WiFi', 'Kameralny wystrój', 'Klimatyzacja'],
                'sort_order' => 2,
            ]
        );

        // 2. News / Aktualności
        $this->upsert(News::class,
            ['slug' => 'otwarcie-sezonu-letniego-2026'],
            [
                'title' => 'Otwarcie Sezonu Letniego w Ośrodku MIRiOLA',
                'branch' => 'resort',
                'excerpt' => 'Zapraszamy do rezerwacji domków i pokoi na sezon letni. Przygotowaliśmy nowe atrakcje w ogrodzie!',
                'content' => 'Z radością ogłaszamy otwarcie nowego sezonu letniego. W tym roku nasi goście mogą korzystać ze zmodernizowanej balii ogrodowej z hydromasażem, strefy relaksu nad wodą oraz rozbudowanego placu zabaw.',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80',
                'is_published' => true,
                'published_at' => now(),
            ]
        );

        $this->upsert(News::class,
            ['slug' => 'nowosci-w-kawiarni-jarmark'],
            [
                'title' => 'Nowe Menu i Wyjątkowa Kawa w Kawiarni Jarmark',
                'branch' => 'jarmark',
                'excerpt' => 'W każdy weekend zapraszamy do naszej Kawiarni Plenerowej na domowe serniki i wyśmienitą kawę.',
                'content' => 'Jarmark MIRiOLA wzbogaca ofertę kawiarnianą o świeżo paloną kawę oraz lokalne wypieki. Zachęcamy do spędzenia wolnego czasu w naszej klimatycznej kawiarni plenerowej!',
                'image' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=800&q=80',
                'is_published' => true,
                'published_at' => now(),
            ]
        );

        $this->upsert(News::class,
            ['slug' => 'zbiory-ogorkow-gruntowych-gospodarstwo'],
            [
                'title' => 'Ruszyły Zbiory Świeżych Ogórków Gruntowych!',
                'branch' => 'farm',
                'excerpt' => 'Przyjmujemy zamówienia telefoniczne na świeże ogórki do kwaszenia oraz domowe przetwory.',
                'content' => 'Nasze tradycyjne naturalne ogórki gruntowe są już dojrzałe i gotowe do odbioru. Wszystkie warzywa uprawiane są bez sztucznych nawozów w czystym mikroklimacie Doliny Skawy.',
                'image' => 'https://images.unsplash.com/photo-1449300079323-02e209d9d3a6?auto=format&fit=crop&w=800&q=80',
                'is_published' => true,
                'published_at' => now(),
            ]
        );

        // 3. Cafe Menu Items
        CafeMenuItem::truncate();

        $menuData = [
            // Kawy & Napoje
            ['name' => 'Espresso', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Kawa Czarna', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Kawa Latte', 'category' => 'kawy_napoje', 'is_featured' => true],
            ['name' => 'Cappuccino', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Flat White', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Macchiato', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Podwójne Espresso', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Kawa Mrożona', 'category' => 'kawy_napoje', 'is_featured' => true],
            ['name' => 'Kawa z Lodami', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Grzaniec Jabłkowy (duży / mały)', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Lemoniada w Butelce', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Napój w Puszce (duża / mała)', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Sok Owocowy 100%', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Sok Mandarynkowy (w kubku 0.25l)', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Woda Mineralna (0.50l)', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Herbata', 'category' => 'kawy_napoje', 'is_featured' => false],
            ['name' => 'Piwo Łomża 0,0% (0.5l)', 'category' => 'kawy_napoje', 'is_featured' => false],

            // Lody
            ['name' => 'Świderki Bezglutenowe - Śmietankowe', 'category' => 'lody', 'is_featured' => true],
            ['name' => 'Świderki Bezglutenowe - Czekoladowe', 'category' => 'lody', 'is_featured' => false],
            ['name' => 'Świderki Bezglutenowe - Czekoladowo-Śmietankowe', 'category' => 'lody', 'is_featured' => false],
            ['name' => 'Świderki Bezglutenowe - Truskawkowe', 'category' => 'lody', 'is_featured' => false],
            ['name' => 'Dodatki do Lodów (Posypka, Wafelek, Polewa)', 'category' => 'lody', 'is_featured' => false],

            // Gofry
            ['name' => 'Gofry Solo', 'category' => 'gofry', 'is_featured' => true],
            ['name' => 'Dodatki do Gofrów (Cukier Puder, Dżem, Nutella, Śmietana, Polewa, Owoce, Miód)', 'category' => 'gofry', 'is_featured' => false],

            // Desery
            ['name' => 'Lody + Bita Śmietana bez laktozy + Owoce + Polewa', 'category' => 'desery', 'is_featured' => true],
            ['name' => 'Bita Śmietana + Owoce + Polewa do wyboru', 'category' => 'desery', 'is_featured' => false],
            ['name' => 'Jabłecznik z Lodami i Śmietaną', 'category' => 'desery', 'is_featured' => true],
            ['name' => 'Jabłecznik Domowy', 'category' => 'desery', 'is_featured' => false],
            ['name' => 'Rurka z Bitą Śmietaną', 'category' => 'desery', 'is_featured' => false],

            // Zapiekanki
            ['name' => 'Zapiekanka Giga (Pieczarki, Ser)', 'category' => 'zapiekanki', 'is_featured' => true],
            ['name' => 'Zapiekanka Mała (Pieczarki, Ser)', 'category' => 'zapiekanki', 'is_featured' => false],
            ['name' => 'Dodatek: Cebulka Prażona', 'category' => 'zapiekanki', 'is_featured' => false],
        ];

        foreach ($menuData as $item) {
            CafeMenuItem::create([
                'name' => $item['name'],
                'category' => $item['category'],
                'is_available' => true,
                'is_featured' => $item['is_featured'],
            ]);
        }

        // 4. Attractions for Jarmark & Resort
        $this->upsert(Attraction::class,
            ['title' => 'Dmuchany Plac Zabaw dla Dzieci'],
            [
                'branch' => 'jarmark',
                'description' => 'Bezpieczny kolorowy dmuchaniec ze zjeżdżalnią w strefie Jarmarku dla najmłodszych gości.',
                'icon' => 'child_care',
                'image' => asset('assets/img/jarmark-hero.webp'),
                'sort_order' => 1,
            ]
        );

        $this->upsert(Attraction::class,
            ['title' => 'Sferyczny Namiot Plenerowy MIRiOLA'],
            [
                'branch' => 'jarmark',
                'description' => 'Zadaszony namiot ze strefą gastronomiczną, stolikami oraz miejscem na wydarzenia plenerowe.',
                'icon' => 'cottage',
                'image' => asset('assets/img/jarmark-hero.webp'),
                'sort_order' => 2,
            ]
        );

        $this->upsert(Attraction::class,
            ['title' => 'Strefa Kawiarniana & Leżaki na Trawie'],
            [
                'branch' => 'jarmark',
                'description' => 'Relaks przy aromatycznej kawie, lody, ciasta i mrożone napoje w strefie gastronomicznej.',
                'icon' => 'local_cafe',
                'image' => asset('assets/img/jarmark-hero.webp'),
                'sort_order' => 3,
            ]
        );

        // Resort Attractions
        // Only clear the rows this seeder owns — a blanket delete also wiped
        // attractions created by admins in the panel. See REVIEW.md CR-2.
        Attraction::where('branch', 'resort')
            ->whereIn('title', ['Jacuzzi w Ogrodzie', 'Duża Wiata Biesiadna', 'Bezpłatny Parking', 'Plac Zabaw dla Dzieci'])
            ->delete();

        Attraction::create([
            'title' => 'Jacuzzi w Ogrodzie',
            'branch' => 'resort',
            'description' => 'Relaksujące jacuzzi ogrodowe na świeżym powietrzu dla gości.',
            'icon' => 'hot_tub',
            'sort_order' => 1,
        ]);

        Attraction::create([
            'title' => 'Duża Wiata Biesiadna',
            'branch' => 'resort',
            'description' => 'Przestronna, zadaszona wiata ogrodowa ze strefą do grillowania.',
            'icon' => 'deck',
            'sort_order' => 2,
        ]);

        Attraction::create([
            'title' => 'Bezpłatny Parking',
            'branch' => 'resort',
            'description' => 'Wygodny, bezpłatny i ogrodzony parking na terenie ośrodka.',
            'icon' => 'local_parking',
            'sort_order' => 3,
        ]);

        Attraction::create([
            'title' => 'Plac Zabaw dla Dzieci',
            'branch' => 'resort',
            'description' => 'Bezpieczny plac zabaw ze strefą rozrywki dla najmłodszych.',
            'icon' => 'child_care',
            'sort_order' => 4,
        ]);

        // 4b. Seed FAQs
        $this->upsert(Faq::class,
            ['question' => 'Jak daleko jest do jeziora?'],
            [
                'answer' => 'Nasz ośrodek znajduje się zaledwie 1 km od zapory wodnej w Świnnej Porębie (Jezioro Mucharskie), w malowniczej dolinie Skawy.',
                'branch' => 'resort',
                'sort_order' => 1,
                'is_published' => true,
            ]
        );

        // Delete old pets question if exists
        Faq::where('question', 'LIKE', '%zwierzęta%')->delete();

        $this->upsert(Faq::class,
            ['question' => 'Czy w ośrodku oferowane są śniadania?'],
            [
                'answer' => 'Tak! Ośrodek prowadzi wyśmienite śniadania w naszej klimatycznej Sali Rycerskiej. Serwujemy obfity bufet oraz świeże lokalne produkty.',
                'branch' => 'resort',
                'sort_order' => 2,
                'is_published' => true,
            ]
        );

        $this->upsert(Faq::class,
            ['question' => 'Jakie są godziny zameldowania?'],
            [
                'answer' => 'Doba hotelowa rozpoczyna się o godzinie 14:00 w dniu przyjazdu, a kończy o godzinie 11:00 w dniu wyjazdu.',
                'branch' => 'resort',
                'sort_order' => 3,
                'is_published' => true,
            ]
        );

        $this->upsert(Faq::class,
            ['question' => 'Czy na terenie obiektu jest parking?'],
            [
                'answer' => 'Tak, zapewniamy bezpłatny, ogrodzony i monitorowany parking dla wszystkich naszych gości.',
                'branch' => 'resort',
                'sort_order' => 4,
                'is_published' => true,
            ]
        );

        $this->upsert(Faq::class,
            ['question' => 'W jakich godzinach otwarta jest Kawiarnia Jarmark?'],
            [
                'answer' => 'Kawiarnia Jarmark jest otwarta od poniedziałku do piątku w godzinach 15:00 - 20:00, a w weekendy (sobota-niedziela) w godzinach 10:00 - 20:00.',
                'branch' => 'jarmark',
                'sort_order' => 1,
                'is_published' => true,
            ]
        );

        $this->upsert(Faq::class,
            ['question' => 'Czy strefa relaksu i dmuchaniec dla dzieci są płatne?'],
            [
                'answer' => 'Korzystanie ze strefy ogrodowej, leżaków oraz dmuchanego placu zabaw jest bezpłatne dla klientów naszej kawiarni.',
                'branch' => 'jarmark',
                'sort_order' => 2,
                'is_published' => true,
            ]
        );
        // truncate() also destroyed admin-uploaded gallery items. See REVIEW.md CR-2.
        GalleryImage::whereIn('title', [
            'Ośrodek MIRiOLA i otaczający ogród',
            'Strefa Relaksu i Jacuzzi',
            'Stylowe pokoje i domki',
            'Duża Wiata Biesiadna',
            'Krajobraz Doliny Skawy',
        ])->delete();

        GalleryImage::create([
            'title' => 'Ośrodek MIRiOLA i otaczający ogród',
            'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
            'branch' => 'resort',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        GalleryImage::create([
            'title' => 'Strefa Relaksu i Jacuzzi',
            'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80',
            'branch' => 'resort',
            'sort_order' => 2,
            'is_published' => true,
        ]);

        GalleryImage::create([
            'title' => 'Stylowe pokoje i domki',
            'image' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=1200&q=80',
            'branch' => 'resort',
            'sort_order' => 3,
            'is_published' => true,
        ]);

        GalleryImage::create([
            'title' => 'Duża Wiata Biesiadna',
            'image' => 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?auto=format&fit=crop&w=1200&q=80',
            'branch' => 'resort',
            'sort_order' => 4,
            'is_published' => true,
        ]);

        GalleryImage::create([
            'title' => 'Krajobraz Doliny Skawy',
            'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80',
            'branch' => 'resort',
            'sort_order' => 5,
            'is_published' => true,
        ]);

        // 5. Farm Products
        FarmProduct::truncate();

        $this->upsert(FarmProduct::class,
            ['name' => 'Czosnek Naturalny (3 Rodzaje)'],
            [
                'description' => '',
                'unit_price' => 25.00,
                'unit_name' => 'kg / pęczek',
                'image' => 'assets/img/czosnek.webp',
                'is_available' => true,
                'phone_contact' => '+48608103119',
                'sort_order' => 1,
            ]
        );

        $this->upsert(FarmProduct::class,
            ['name' => 'Borówka Amerykańska'],
            [
                'description' => '',
                'unit_price' => 25.00,
                'unit_name' => 'kg',
                'image' => 'assets/img/borowka.webp',
                'is_available' => true,
                'phone_contact' => '+48608103119',
                'sort_order' => 2,
            ]
        );

        $this->upsert(FarmProduct::class,
            ['name' => 'Miód Naturalny z Pasieki MIRiOLA'],
            [
                'description' => '',
                'unit_price' => 45.00,
                'unit_name' => 'słoik 1kg',
                'image' => 'assets/img/miod.webp',
                'is_available' => true,
                'phone_contact' => '+48608103119',
                'sort_order' => 3,
            ]
        );

        // 6. Seed CMS Contents
        $cmsFields = [
            // Ogólne
            ['key' => 'phone_number', 'label' => 'Telefon główny do rezerwacji', 'value' => '+48 608 103 119', 'type' => 'text', 'group' => 'general'],
            ['key' => 'phone_number_2', 'label' => 'Telefon dodatkowy do kontaktu', 'value' => '+48 696 312 574', 'type' => 'text', 'group' => 'general'],
            ['key' => 'email_address', 'label' => 'E-mail kontaktowy', 'value' => 'miroslawzadora@wp.pl', 'type' => 'text', 'group' => 'general'],
            ['key' => 'facebook_url', 'label' => 'Link do profilu Facebook (Ośrodek)', 'value' => 'https://www.facebook.com/p/Miriola-noclegi-100057455918786/?locale=pl_PL', 'type' => 'url', 'group' => 'general'],
            ['key' => 'jarmark_facebook_url', 'label' => 'Link do profilu Facebook (Jarmark)', 'value' => 'https://www.facebook.com/jarmark.miriola/', 'type' => 'url', 'group' => 'general'],
            ['key' => 'olx_url', 'label' => 'Link do ogłoszeń OLX', 'value' => 'https://www.olx.pl/d/oferta/noclegi-zator-wadowice-rodziny-wycieczki-grupy-do-45-osob-posilki-hb-CID1816-IDKBWIY.html?isPreviewActive=0&sliderIndex=0&srsltid=AfmBOoqYM6MhpIRkEbA7QBXh6SWkobLNq8khCjq-ojhLXTUk3PByYanh', 'type' => 'url', 'group' => 'general'],
            ['key' => 'instagram_url', 'label' => 'Link do profilu Instagram', 'value' => 'https://www.instagram.com/miroslawzadora/', 'type' => 'url', 'group' => 'general'],
            ['key' => 'tiktok_url', 'label' => 'Link do profilu TikTok', 'value' => 'https://www.tiktok.com/@miriola', 'type' => 'url', 'group' => 'general'],

            // Ośrodek
            ['key' => 'hero_badge', 'label' => 'Ośrodek - Odznaka / Badge Hero', 'value' => 'Komfortowe noclegi w dolinie Skawy', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'osrodek_hero_title', 'label' => 'Ośrodek - Tytuł Nagłówka Hero', 'value' => 'Odkryj spokój w sercu doliny Skawy', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'hero_title', 'label' => 'Ośrodek - Tytuł Główny Hero (Alias)', 'value' => 'Odkryj spokój w sercu doliny Skawy', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'osrodek_hero_description', 'label' => 'Ośrodek - Opis Nagłówka Hero', 'value' => 'Komfortowe noclegi blisko Wadowic i Jeziora Mucharskiego', 'type' => 'textarea', 'group' => 'resort'],
            ['key' => 'hero_description', 'label' => 'Ośrodek - Opis Główny Hero (Alias)', 'value' => 'Komfortowe noclegi blisko Wadowic i Jeziora Mucharskiego', 'type' => 'textarea', 'group' => 'resort'],
            ['key' => 'rooms_section_title', 'label' => 'Ośrodek - Tytuł Sekcji Pokoje i Domki', 'value' => 'Pokoje i Domki', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'room1_title', 'label' => 'Pokój 1 - Tytuł', 'value' => 'Pokój 2-osobowy', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'room1_description', 'label' => 'Pokój 1 - Opis', 'value' => 'Kameralny i elegancki pokój z dużym łóżkiem dwuosobowym, idealny dla par szukających relaksu z pięknym widokiem na okolicę.', 'type' => 'textarea', 'group' => 'resort'],

            ['key' => 'room2_title', 'label' => 'Pokój 2 - Tytuł', 'value' => 'Apartament Rodzinny', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'room2_description', 'label' => 'Pokój 2 - Opis', 'value' => 'Przestronny apartament dla całej rodziny, wyposażony w aneks kuchenny, komfortową część wypoczynkową oraz duży taras z widokiem.', 'type' => 'textarea', 'group' => 'resort'],

            ['key' => 'room3_title', 'label' => 'Pokój 3 - Tytuł', 'value' => 'Domek Letniskowy', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'room3_description', 'label' => 'Pokój 3 - Opis', 'value' => 'Samodzielny domek w otoczeniu zielonego ogrodu. Zapewnia całkowitą prywatność, posiada przytulny salon z kominkiem oraz aneks.', 'type' => 'textarea', 'group' => 'resort'],

            ['key' => 'osrodek_award_badge', 'label' => 'Ośrodek - Znaczek / Certyfikat Hero (np. Orły Turystyki)', 'value' => 'assets/img/orl.webp', 'type' => 'image', 'group' => 'resort'],

            // Jarmark
            ['key' => 'jarmark_hero_title', 'label' => 'Jarmark - Tytuł Nagłówka', 'value' => 'Jarmark & Kawiarnia Plenerowa', 'type' => 'text', 'group' => 'jarmark'],
            ['key' => 'jarmark_hero_description', 'label' => 'Jarmark - Opis Nagłówka', 'value' => 'Wyjątkowe miejsce w Dolinie Skawy łączące plenerową kawiarnię, lokalne wypieki oraz klimatyczną strefę spotkań.', 'type' => 'textarea', 'group' => 'jarmark'],
            ['key' => 'cafe_cat_image_kawy_napoje', 'label' => 'Kawiarnia - Zdjęcie kategorii Kawy & Napoje', 'value' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&w=800&q=80', 'type' => 'image', 'group' => 'jarmark'],
            ['key' => 'cafe_cat_image_lody', 'label' => 'Kawiarnia - Zdjęcie kategorii Lody', 'value' => 'cms-graphics/lody.webp', 'type' => 'image', 'group' => 'jarmark'],
            ['key' => 'cafe_cat_image_gofry', 'label' => 'Kawiarnia - Zdjęcie kategorii Gofry', 'value' => 'https://images.unsplash.com/photo-1562376552-0d160a2f238d?auto=format&fit=crop&w=800&q=80', 'type' => 'image', 'group' => 'jarmark'],
            ['key' => 'cafe_cat_image_desery', 'label' => 'Kawiarnia - Zdjęcie kategorii Desery', 'value' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?auto=format&fit=crop&w=800&q=80', 'type' => 'image', 'group' => 'jarmark'],
            ['key' => 'cafe_cat_image_zapiekanki', 'label' => 'Kawiarnia - Zdjęcie kategorii Zapiekanki', 'value' => 'https://images.unsplash.com/photo-1509722747041-616f39b57569?auto=format&fit=crop&w=800&q=80', 'type' => 'image', 'group' => 'jarmark'],
            ['key' => 'cafe_open_today', 'label' => 'Kawiarnia - Dzisiaj otwieramy (Wyróżnienie)', 'value' => '0', 'type' => 'text', 'group' => 'jarmark'],
            ['key' => 'cafe_today_hours', 'label' => 'Kawiarnia - Dzisiejsze godziny otwarcia', 'value' => '', 'type' => 'text', 'group' => 'jarmark'],
            ['key' => 'cafe_today_notice', 'label' => 'Kawiarnia - Dzisiejsza wiadomość specjalna', 'value' => '', 'type' => 'text', 'group' => 'jarmark'],
            ['key' => 'cafe_hours_mon', 'label' => 'Kawiarnia - Godziny: Poniedziałek', 'value' => '15:00 – 20:00', 'type' => 'text', 'group' => 'jarmark'],
            ['key' => 'cafe_hours_tue', 'label' => 'Kawiarnia - Godziny: Wtorek', 'value' => '15:00 – 20:00', 'type' => 'text', 'group' => 'jarmark'],
            ['key' => 'cafe_hours_wed', 'label' => 'Kawiarnia - Godziny: Środa', 'value' => '15:00 – 20:00', 'type' => 'text', 'group' => 'jarmark'],
            ['key' => 'cafe_hours_thu', 'label' => 'Kawiarnia - Godziny: Czwartek', 'value' => '15:00 – 20:00', 'type' => 'text', 'group' => 'jarmark'],
            ['key' => 'cafe_hours_fri', 'label' => 'Kawiarnia - Godziny: Piątek', 'value' => '15:00 – 20:00', 'type' => 'text', 'group' => 'jarmark'],
            ['key' => 'cafe_hours_sat', 'label' => 'Kawiarnia - Godziny: Sobota', 'value' => '10:00 – 20:00', 'type' => 'text', 'group' => 'jarmark'],
            ['key' => 'cafe_hours_sun', 'label' => 'Kawiarnia - Godziny: Niedziela', 'value' => '10:00 – 20:00', 'type' => 'text', 'group' => 'jarmark'],

            // Gospodarstwo
            ['key' => 'gospodarstwo_hero_title', 'label' => 'Gospodarstwo - Tytuł Nagłówka', 'value' => 'Gospodarstwo Ogrodniczo-Pszczelarskie MIRiOLA', 'type' => 'text', 'group' => 'farm'],
            ['key' => 'gospodarstwo_hero_description', 'label' => 'Gospodarstwo - Opis Nagłówka', 'value' => 'Tradycyjna uprawa i naturalne plony w czystym mikroklimacie Doliny Skawy. Prosto z naszych pól i pasieki oferujemy 3 rodzaje naturalnego czosnku, świeże borówki, naturalne miody oraz domowe przetwory i nie tylko.', 'type' => 'textarea', 'group' => 'farm'],
            ['key' => 'gospodarstwo_phone', 'label' => 'Gospodarstwo - Telefon do zamówień', 'value' => '+48 608 103 119', 'type' => 'text', 'group' => 'farm'],
            ['key' => 'gospodarstwo_cert_info', 'label' => 'Gospodarstwo - Informacja o rejestracji w Sanepidzie i RHD', 'value' => 'Gospodarstwo prowadzi Rolniczy Handel Detaliczny (RHD) i jest zarejestrowane w Sanepidzie. Skontaktuj się z nami telefonicznie, aby potwierdzić aktualną dostępność i ustalić termin odbioru!', 'type' => 'textarea', 'group' => 'farm'],
            ['key' => 'gospodarstwo_allegro_text', 'label' => 'Gospodarstwo - Tekst o Allegro Lokalnie', 'value' => 'Istnieje możliwość zakupu na Allegro Lokalnie', 'type' => 'text', 'group' => 'farm'],
            ['key' => 'gospodarstwo_allegro_url', 'label' => 'Gospodarstwo - Link do Allegro Lokalnie', 'value' => 'https://allegrolokalnie.pl', 'type' => 'url', 'group' => 'farm'],
        ];

        foreach ($cmsFields as $field) {
            $this->upsert(CmsContent::class,
                ['key' => $field['key']],
                $field
            );
        }

        // 7. Seed 10 Rooms and Cottages
        // NB: reservations.room_id is cascadeOnDelete, so deleting rooms here
        // wiped every guest reservation. Upsert by name instead. REVIEW.md CR-2.

        $roomsData = [
            [
                'name' => 'Pokój Pomarańczowy',
                'room_type' => 'Pokój 6-osobowy',
                'capacity' => 6,
                'price_per_night' => 250.00,
                'sort_order' => 1,
                'amenities' => ['Pokój normalny', 'Max 6 osób', '6 łóżek pojedynczych', 'Wystrój pomarańczowy'],
                'images' => [
                    'rooms/01M0BAF924TG6W47J7299CDQJ1-558c6dc9.webp',
                    'rooms/01M0BAF9250B5GKF3ADMGCBXXD-a1d60a05.webp',
                    'rooms/01M0BAF9250B5GKF3ADMGCBXXE-e1f4a4f4.webp',
                    'rooms/01M0BAF926VW5GWQYQ34K4BN86-3b6e0f68.webp',
                ],
            ],
            [
                'name' => 'Pokój Borówkowy',
                'room_type' => 'Pokój 5-osobowy',
                'capacity' => 5,
                'price_per_night' => 240.00,
                'sort_order' => 2,
                'amenities' => ['Pokój normalny', 'Max 5 osób', '5 łóżek pojedynczych', 'Wystrój borówkowy'],
                'images' => [
                    'rooms/01M0BB1BCQG9QCQ99ESAZ4M44X-a0f09824.webp',
                    'rooms/01M0BB1BCRS8RJB00X79MTD6VM-d4ca5f83.webp',
                ],
            ],
            [
                'name' => 'Apartament Oliwkowy',
                'room_type' => 'Apartament 2-pokojowy',
                'capacity' => 6,
                'price_per_night' => 450.00,
                'sort_order' => 3,
                'amenities' => ['Apartament 2-pokojowy', 'Max 6 osób', 'Stylowy akcent oliwkowy'],
                'images' => [
                    'rooms/01M0BB9N5RMVBFMRYCG6S3K5E1-8b4f343b.webp',
                    'rooms/01M0BB9N5S5V83R4VZCBDFPKMQ-b13dd59f.webp',
                    'rooms/01M0BB9N5TAQKT47SMXX6NZ9PV-54acbbde.webp',
                    'rooms/01M0BB9N5TAQKT47SMXX6NZ9PW-799b5123.webp',
                ],
            ],
            [
                'name' => 'Apartament Tiramisu',
                'room_type' => 'Apartament 2-poziomowy',
                'capacity' => 5,
                'price_per_night' => 460.00,
                'sort_order' => 4,
                'amenities' => ['Apartament 2-pokojowy', 'Dwupoziomowy', 'Max 5 osób', 'Wystrój Tiramisu'],
                'images' => [
                    'rooms/01M0BAR5N8ENT18D2Q6ATSWP79-e72f43df.webp',
                    'rooms/01M0BAT7YFHYB31EP02EANVQR7-3f63f3a0.webp',
                    'rooms/01M0BAT7YGVK22THXE208BSJRT-a7198efe.webp',
                ],
            ],
            [
                'name' => 'Pokój Cytrynowy',
                'room_type' => 'Pokój 5-osobowy',
                'capacity' => 5,
                'price_per_night' => 250.00,
                'sort_order' => 5,
                'amenities' => ['Max 5 osób', '1 łóżko podwójne', '3 łóżka pojedyncze', 'Wystrój cytrynowy'],
                'images' => [
                    'rooms/01M0Q9P43MNQS57J6BCBJE5GAV-a1d60a05.webp',
                ],
            ],
            [
                'name' => 'Domek nr 6',
                'room_type' => 'Domek Letniskowy',
                'capacity' => 4,
                'price_per_night' => 350.00,
                'sort_order' => 6,
                'amenities' => ['Domek 4 os.', '1 łóżko podwójne', '2 łóżka pojedyncze'],
                'images' => [
                    'rooms/01M0JYST3VF5W143QYJZZ9HW01-197144cd.webp',
                    'rooms/01M0JYST3WKQT0NJQ6QZV4BFRD-1d4692f4.webp',
                    'rooms/01M0JYST3SYRJSEKKTYGWTE69D-34afe4a1.webp',
                    'rooms/01M0JYST3TS69MX39WR7J2ADWM-aae24fe4.webp',
                    'rooms/01M0JYST3VF5W143QYJZZ9HVZY-cc62b1a5.webp',
                    'rooms/01M0JYST3VF5W143QYJZZ9HVZZ-fcc7499f.webp',
                    'rooms/01M0JYST3VF5W143QYJZZ9HW00-0ff1b6c5.webp',
                ],
            ],
            [
                'name' => 'Domek nr 7',
                'room_type' => 'Domek Letniskowy',
                'capacity' => 4,
                'price_per_night' => 350.00,
                'sort_order' => 7,
                'amenities' => ['Domek 4 os.', '1 łóżko podwójne', '2 łóżka pojedyncze'],
                'images' => [
                    'rooms/01M0JYTRFKX4PMAF5NFVC2ZE6X-197144cd.webp',
                    'rooms/01M0JYTRFKX4PMAF5NFVC2ZE6V-1d4692f4.webp',
                    'rooms/01M0JYTRFHBHV6EGEK7JHWY2HK-fcc7499f.webp',
                    'rooms/01M0JYTRFJ4Z371PEFYGVV9BNM-0ff1b6c5.webp',
                    'rooms/01M0JYTRFKX4PMAF5NFVC2ZE6T-cc62b1a5.webp',
                    'rooms/01M0JYTRFKX4PMAF5NFVC2ZE6W-aae24fe4.webp',
                    'rooms/01M0JYTRFMSBYY8BQ7MJP07PFW-34afe4a1.webp',
                ],
            ],
            [
                'name' => 'Domek nr 8',
                'room_type' => 'Domek Letniskowy',
                'capacity' => 4,
                'price_per_night' => 350.00,
                'sort_order' => 8,
                'amenities' => ['Domek 4 os.', '1 łóżko podwójne', '2 łóżka pojedyncze'],
                'images' => [
                    'rooms/01M0JYVM43Y1JBKNVX0P9WAZTP-197144cd.webp',
                    'rooms/01M0JYVM42Y3FA7RMNV5H23X37-1d4692f4.webp',
                    'rooms/01M0JYVM41XFC2Y3JM0A68ZK8G-fcc7499f.webp',
                    'rooms/01M0JYVM42Y3FA7RMNV5H23X35-0ff1b6c5.webp',
                    'rooms/01M0JYVM42Y3FA7RMNV5H23X36-cc62b1a5.webp',
                    'rooms/01M0JYVM42Y3FA7RMNV5H23X38-aae24fe4.webp',
                    'rooms/01M0JYVM43Y1JBKNVX0P9WAZTQ-34afe4a1.webp',
                ],
            ],
            [
                'name' => 'Domek nr 9',
                'room_type' => 'Domek z aneksem',
                'capacity' => 4,
                'price_per_night' => 380.00,
                'sort_order' => 9,
                'amenities' => ['Domek 4 os.', '1 łóżko podwójne', '2 łóżka pojedyncze', 'Aneks kuchenny'],
                'images' => [
                    'rooms/01M0QG4DNT2TNESYTSG83PD7JG-16205de3.webp',
                    'rooms/01M0QG4DNWFX6M2WWZ326YHM2M-65d21bcf.webp',
                    'rooms/01M0QG4DNXCXMTNYVCP14KBMVZ-20ee2847.webp',
                    'rooms/01M0QG4DNXCXMTNYVCP14KBMW0-c6a32515.webp',
                    'rooms/01M0QG4DNY51WY2P4X6BG6MHA2-c37a7c83.webp',
                ],
            ],
            [
                'name' => 'Domek VIP',
                'room_type' => 'Domek 2-pokojowy',
                'capacity' => 5,
                'price_per_night' => 420.00,
                'sort_order' => 10,
                'amenities' => ['Domek VIP Via 2-pokojowy', 'Max 5 osób'],
                'images' => [
                    'rooms/01M0BBRZ56Q2PWHRA491K4KC9M-fc53d220.webp',
                    'rooms/01M0BBRZ575J4THM9S2PXH6BJF-c9d3dbcb.webp',
                    'rooms/01M0BBRZ575J4THM9S2PXH6BJG-34cc552a.webp',
                    'rooms/01M0BBRZ575J4THM9S2PXH6BJH-3bf51bda.webp',
                    'rooms/01M0BBRZ575J4THM9S2PXH6BJJ-d8cb0b05.webp',
                    'rooms/01M0BBRZ56Q2PWHRA491K4KC9N-2cb2883d.webp',
                ],
            ],
        ];

        foreach ($roomsData as $room) {
            $this->upsert(Room::class, ['name' => $room['name']], $room);
        }

        // 8. Seed Sample Reservations
        // These matched no seeded room ('103'/'202'/'Domek Letniskowy 2' do not
        // exist), so no reservation was ever seeded. See REVIEW.md M-13.
        $room103 = Room::where('name', 'Pokój Pomarańczowy')->first();
        $room202 = Room::where('name', 'Apartament Oliwkowy')->first();
        $domek2 = Room::where('name', 'Domek nr 2')->first();

        if ($room103) {
            $this->upsert(Reservation::class,
                // Match key must equal the stored value or updateOrCreate never
                // matches its own row and duplicates on every reseed.
                ['guest_phone' => '601 222 333', 'room_id' => $room103->id],
                [
                    'guest_name' => 'Jan Kowalski',
                    'guest_phone' => '601 222 333',
                    'guest_email' => 'jan.kowalski@example.com',
                    'check_in_date' => '2026-08-04',
                    'check_out_date' => '2026-08-12',
                    'total_price' => 2160.00,
                    'status' => 'confirmed',
                    'notes' => 'Wpłacono zaliczkę 200 zł przelewem. Przyjazd planowany ok. godz 15:00.',
                ]
            );
        }

        if ($room202) {
            $this->upsert(Reservation::class,
                ['guest_phone' => '699 444 555', 'room_id' => $room202->id],
                [
                    'guest_name' => 'Anna i Marek Nowak',
                    'guest_phone' => '699 444 555',
                    'guest_email' => 'nowakowie@example.com',
                    'check_in_date' => '2026-08-03',
                    'check_out_date' => '2026-08-10',
                    'total_price' => 3150.00,
                    'status' => 'confirmed',
                    'notes' => 'Przyjazd z małym psem (dopłata 50 zł za psa zaksięgowana).',
                ]
            );
        }

        if ($domek2) {
            $this->upsert(Reservation::class,
                ['guest_phone' => '505 111 888', 'room_id' => $domek2->id],
                [
                    'guest_name' => 'Piotr Wiśniewski',
                    'guest_phone' => '505 111 888',
                    'guest_email' => 'p.wisniewski@example.com',
                    'check_in_date' => '2026-08-01',
                    'check_out_date' => '2026-08-08',
                    'total_price' => 2450.00,
                    'status' => 'confirmed',
                    'notes' => 'Potrzebne łóżeczko turystyczne dla niemowlęcia w domku.',
                ]
            );
        }
    }
}
