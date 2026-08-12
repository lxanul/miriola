<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\RestaurantHall;
use App\Models\CafeMenuItem;
use App\Models\Attraction;
use App\Models\FarmProduct;
use App\Models\CmsContent;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 0. Admin account — /admin was previously unreachable because no user
        //    was ever seeded and is_admin gates the panel. See REVIEW.md M-16.
        throw_if(
            blank(config('app.admin_password')),
            \RuntimeException::class,
            'ADMIN_PASSWORD is not set — refusing to seed an admin account.'
        );

        $admin = \App\Models\User::updateOrCreate(
            ['email' => config('app.admin_email')],
            [
                'name' => 'Administrator',
                'password' => config('app.admin_password'), // 'hashed' cast handles it
            ]
        );
        // Set outside the fillable payload so the privilege flag is never
        // mass-assignable if a registration route is added later.
        $admin->forceFill(['is_admin' => true])->save();

        // 1. Restaurant Halls
        RestaurantHall::updateOrCreate(
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

        RestaurantHall::updateOrCreate(
            ['slug' => 'sala-kameralna-tarasowa'],
            [
                'name' => 'Sala Kameralna Tarasowa',
                'subtitle' => 'Kameralna atmosfera z panoramicznym widokiem na Dolinę Skawy',
                'capacity' => 45,
                'description' => 'Jasna i przytulna sala usytuowana na piętrze, z wyjściem na rozległy zadaszony taras. Doskonała na kameralne przyjęcia rodzinne, warsztaty, kolacje biznesowe czy jubileusze z pięknym widokiem na naturę.',
                'main_image' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1200&q=80',
                'features' => ['Zadaszony taras', 'Widok na dolinę', 'WiFi', 'Kameralny wystrój', 'Klimatyzacja'],
                'sort_order' => 2,
            ]
        );

        // 2. News / Aktualności
        News::updateOrCreate(
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

        News::updateOrCreate(
            ['slug' => 'warsztaty-rekodziela-i-kawiarnia-jarmark'],
            [
                'title' => 'Nowe Menu Kawiarni & Rzemieślnicze Warsztaty w Jarmarku',
                'branch' => 'jarmark',
                'excerpt' => 'W każdy weekend zapraszamy do naszej Kawiarni na domowe serniki oraz warsztaty dla dzieci.',
                'content' => 'Centrum Edukacyjno-Handlowe Jarmark wzbogaca ofertę kawiarnianą o świeżo paloną kawę rzemieślniczą oraz lokalne wypieki. Zachęcamy do udziału w weekendowych pokazach dawnych rzemiosł!',
                'image' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=800&q=80',
                'is_published' => true,
                'published_at' => now(),
            ]
        );

        News::updateOrCreate(
            ['slug' => 'zbiory-ogorkow-gruntowych-gospodarstwo'],
            [
                'title' => 'Ruszyły Zbiory Świeżych Ogórków Gruntowych!',
                'branch' => 'farm',
                'excerpt' => 'Przyjmujemy zamówienia telefoniczne na świeże ogórki do kwaszenia oraz domowe przetwory.',
                'content' => 'Nasze tradycyjne ekologiczne ogórki gruntowe są już dojrzałe i gotowe do odbioru. Wszystkie warzywa uprawiane są bez sztucznych nawozów w czystym mikroklimacie Doliny Skawy.',
                'image' => 'https://images.unsplash.com/photo-1449300079323-02e209d9d3a6?auto=format&fit=crop&w=800&q=80',
                'is_published' => true,
                'published_at' => now(),
            ]
        );

        // 3. Cafe Menu Items
        CafeMenuItem::updateOrCreate(
            ['name' => 'Espresso Rzemieślnicze'],
            [
                'category' => 'kawy',
                'description' => 'Intensywne espresso z wyselekcjonowanych ziaren Arabica 100%',
                'price' => 10.00,
                'image' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&w=600&q=80',
                'is_available' => true,
                'sort_order' => 1,
            ]
        );

        CafeMenuItem::updateOrCreate(
            ['name' => 'Cappuccino z Pianką'],
            [
                'category' => 'kawy',
                'description' => 'Klasyczne cappuccino na bazie świeżego wiejskiego mleka',
                'price' => 14.00,
                'image' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?auto=format&fit=crop&w=600&q=80',
                'is_available' => true,
                'sort_order' => 2,
            ]
        );

        CafeMenuItem::updateOrCreate(
            ['name' => 'Domowy Sernik z Malinami'],
            [
                'category' => 'ciasta',
                'description' => 'Pieczołowicie przygotowany domowy sernik na bazie lokalnego twarogu z malinową konfiturą',
                'price' => 18.00,
                'image' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?auto=format&fit=crop&w=600&q=80',
                'is_available' => true,
                'is_featured' => true,
                'sort_order' => 3,
            ]
        );

        CafeMenuItem::updateOrCreate(
            ['name' => 'Szarlotka na Ciepło z Lodami'],
            [
                'category' => 'ciasta',
                'description' => 'Chrupiąca szarlotka z jabłkami z wiejskiego sadu, serwowana z gałką lodów waniliowych',
                'price' => 19.00,
                'image' => 'https://images.unsplash.com/photo-1568571780765-9276ac8b75a2?auto=format&fit=crop&w=600&q=80',
                'is_available' => true,
                'sort_order' => 4,
            ]
        );

        // 4. Attractions for Jarmark & Resort
        Attraction::updateOrCreate(
            ['title' => 'Dmuchany Plac Zabaw dla Dzieci'],
            [
                'branch' => 'jarmark',
                'description' => 'Bezpieczny kolorowy dmuchaniec ze zjeżdżalnią w strefie Jarmarku dla najmłodszych gości.',
                'icon' => 'child_care',
                'image' => asset('assets/img/jarmark-hero.jpg'),
                'sort_order' => 1,
            ]
        );

        Attraction::updateOrCreate(
            ['title' => 'Sferyczny Namiot Plenerowy MIRiOLA'],
            [
                'branch' => 'jarmark',
                'description' => 'Zadaszony namiot ze strefą gastronomiczną, stolikami oraz miejscem na wydarzenia plenerowe.',
                'icon' => 'cottage',
                'image' => asset('assets/img/jarmark-hero.jpg'),
                'sort_order' => 2,
            ]
        );

        Attraction::updateOrCreate(
            ['title' => 'Strefa Kawiarniana & Leżaki na Trawie'],
            [
                'branch' => 'jarmark',
                'description' => 'Relaks przy aromatycznej kawie rzemieślniczej, lody, ciasta i mrożone napoje w strefie gastronomicznej.',
                'icon' => 'local_cafe',
                'image' => asset('assets/img/jarmark-hero.jpg'),
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
        \App\Models\Faq::updateOrCreate(
            ['question' => 'Jak daleko jest do jeziora?'],
            [
                'answer' => 'Nasz ośrodek znajduje się zaledwie 1 km od zapory wodnej w Świnnej Porębie (Jezioro Mucharskie), w malowniczej dolinie Skawy.',
                'branch' => 'resort',
                'sort_order' => 1,
                'is_published' => true,
            ]
        );

        // Delete old pets question if exists
        \App\Models\Faq::where('question', 'LIKE', '%zwierzęta%')->delete();

        \App\Models\Faq::updateOrCreate(
            ['question' => 'Czy w ośrodku oferowane są śniadania?'],
            [
                'answer' => 'Tak! Ośrodek prowadzi wyśmienite śniadania w naszej klimatycznej Sali Rycerskiej. Serwujemy obfity bufet oraz świeże lokalne produkty.',
                'branch' => 'resort',
                'sort_order' => 2,
                'is_published' => true,
            ]
        );

        \App\Models\Faq::updateOrCreate(
            ['question' => 'Jakie są godziny zameldowania?'],
            [
                'answer' => 'Doba hotelowa rozpoczyna się o godzinie 14:00 w dniu przyjazdu, a kończy o godzinie 11:00 w dniu wyjazdu.',
                'branch' => 'resort',
                'sort_order' => 3,
                'is_published' => true,
            ]
        );

        \App\Models\Faq::updateOrCreate(
            ['question' => 'Czy na terenie obiektu jest parking?'],
            [
                'answer' => 'Tak, zapewniamy bezpłatny, ogrodzony i monitorowany parking dla wszystkich naszych gości.',
                'branch' => 'resort',
                'sort_order' => 4,
                'is_published' => true,
            ]
        );
        // truncate() also destroyed admin-uploaded gallery items. See REVIEW.md CR-2.
        \App\Models\GalleryImage::whereIn('title', [
            'Ośrodek MIRiOLA i otaczający ogród',
            'Strefa Relaksu i Jacuzzi',
            'Stylowe pokoje i domki',
            'Duża Wiata Biesiadna',
            'Krajobraz Doliny Skawy',
        ])->delete();
        
        \App\Models\GalleryImage::create([
            'title' => 'Ośrodek MIRiOLA i otaczający ogród',
            'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
            'branch' => 'resort',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        \App\Models\GalleryImage::create([
            'title' => 'Strefa Relaksu i Jacuzzi',
            'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80',
            'branch' => 'resort',
            'sort_order' => 2,
            'is_published' => true,
        ]);

        \App\Models\GalleryImage::create([
            'title' => 'Stylowe pokoje i domki',
            'image' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=1200&q=80',
            'branch' => 'resort',
            'sort_order' => 3,
            'is_published' => true,
        ]);

        \App\Models\GalleryImage::create([
            'title' => 'Duża Wiata Biesiadna',
            'image' => 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?auto=format&fit=crop&w=1200&q=80',
            'branch' => 'resort',
            'sort_order' => 4,
            'is_published' => true,
        ]);

        \App\Models\GalleryImage::create([
            'title' => 'Krajobraz Doliny Skawy',
            'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80',
            'branch' => 'resort',
            'sort_order' => 5,
            'is_published' => true,
        ]);

        // 5. Farm Products
        FarmProduct::updateOrCreate(
            ['name' => 'Ogórki Gruntowe Ekologiczne'],
            [
                'description' => 'Świeżo rwane ogórki idealne do małosolnych lub kwaszenia w słoikach.',
                'unit_price' => 7.50,
                'unit_name' => 'kg',
                'image' => 'https://images.unsplash.com/photo-1449300079323-02e209d9d3a6?auto=format&fit=crop&w=600&q=80',
                'is_available' => true,
                'phone_contact' => '+48608103119',
                'sort_order' => 1,
            ]
        );

        FarmProduct::updateOrCreate(
            ['name' => 'Domowe Ogórki Kiszone (Słoik 900ml)'],
            [
                'description' => 'Tradycyjne polskie ogórki kiszone z dodatkiem czosnku, chrzanu i kopru według naszej receptury.',
                'unit_price' => 15.00,
                'unit_name' => 'słoik',
                'image' => 'https://images.unsplash.com/photo-1590779033100-9f60a05a013d?auto=format&fit=crop&w=600&q=80',
                'is_available' => true,
                'phone_contact' => '+48608103119',
                'sort_order' => 2,
            ]
        );

        FarmProduct::updateOrCreate(
            ['name' => 'Miód Spadziowy z Pasieki MIRiOLA'],
            [
                'description' => 'Naturalny, głęboki w smaku miód z czystych lasów doliny Skawy.',
                'unit_price' => 45.00,
                'unit_name' => 'słoik 1kg',
                'image' => 'https://images.unsplash.com/photo-1587049352847-4a222e784d38?auto=format&fit=crop&w=600&q=80',
                'is_available' => true,
                'phone_contact' => '+48608103119',
                'sort_order' => 3,
            ]
        );

        FarmProduct::updateOrCreate(
            ['name' => 'Jajka Wiejskie z Wolnego Wybiegu'],
            [
                'description' => 'Świeże jajka od kur żywionych naturalnym ziarnem w naszym gospodarstwie.',
                'unit_price' => 16.00,
                'unit_name' => '10 szt.',
                'image' => 'https://images.unsplash.com/photo-1516467508483-a7212febe31a?auto=format&fit=crop&w=600&q=80',
                'is_available' => true,
                'phone_contact' => '+48608103119',
                'sort_order' => 4,
            ]
        );

        // 6. Seed CMS Contents
        $cmsFields = [
            // Ogólne
            ['key' => 'phone_number', 'label' => 'Telefon główny do rezerwacji', 'value' => '+48 608 103 119', 'type' => 'text', 'group' => 'general'],
            ['key' => 'email_address', 'label' => 'E-mail kontaktowy', 'value' => 'miroslawzadora@wp.pl', 'type' => 'text', 'group' => 'general'],
            ['key' => 'facebook_url', 'label' => 'Link do profilu Facebook (Ośrodek)', 'value' => 'https://www.facebook.com/p/Miriola-noclegi-100057455918786/?locale=pl_PL', 'type' => 'url', 'group' => 'general'],
            ['key' => 'jarmark_facebook_url', 'label' => 'Link do profilu Facebook (Jarmark)', 'value' => 'https://www.facebook.com/jarmark.miriola/', 'type' => 'url', 'group' => 'general'],
            ['key' => 'olx_url', 'label' => 'Link do ogłoszeń OLX', 'value' => 'https://www.olx.pl/d/oferta/noclegi-zator-wadowice-rodziny-wycieczki-grupy-do-45-osob-posilki-hb-CID1816-IDKBWIY.html?isPreviewActive=0&sliderIndex=0&srsltid=AfmBOoqYM6MhpIRkEbA7QBXh6SWkobLNq8khCjq-ojhLXTUk3PByYanh', 'type' => 'url', 'group' => 'general'],
            ['key' => 'instagram_url', 'label' => 'Link do profilu Instagram', 'value' => '#', 'type' => 'url', 'group' => 'general'],

            // Ośrodek
            ['key' => 'osrodek_hero_title', 'label' => 'Ośrodek - Tytuł Nagłówka Hero', 'value' => 'Odkryj spokój w sercu doliny Skawy', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'osrodek_hero_description', 'label' => 'Ośrodek - Opis Nagłówka Hero', 'value' => 'Komfortowe noclegi blisko Wadowic i Jeziora Mucharskiego', 'type' => 'textarea', 'group' => 'resort'],
            ['key' => 'room1_title', 'label' => 'Pokój 1 - Tytuł', 'value' => 'Pokój 2-osobowy', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'room1_price', 'label' => 'Pokój 1 - Cena', 'value' => 'od 250 zł / noc', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'room1_description', 'label' => 'Pokój 1 - Opis', 'value' => 'Kameralny i elegancki pokój z dużym łóżkiem dwuosobowym, idealny dla par szukających relaksu z pięknym widokiem na okolicę.', 'type' => 'textarea', 'group' => 'resort'],

            ['key' => 'room2_title', 'label' => 'Pokój 2 - Tytuł', 'value' => 'Apartament Rodzinny', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'room2_price', 'label' => 'Pokój 2 - Cena', 'value' => 'od 450 zł / noc', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'room2_description', 'label' => 'Pokój 2 - Opis', 'value' => 'Przestronny apartament dla całej rodziny, wyposażony w aneks kuchenny, komfortową część wypoczynkową oraz duży taras z widokiem.', 'type' => 'textarea', 'group' => 'resort'],

            ['key' => 'room3_title', 'label' => 'Pokój 3 - Tytuł', 'value' => 'Domek Letniskowy', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'room3_price', 'label' => 'Pokój 3 - Cena', 'value' => 'od 350 zł / noc', 'type' => 'text', 'group' => 'resort'],
            ['key' => 'room3_description', 'label' => 'Pokój 3 - Opis', 'value' => 'Samodzielny domek w otoczeniu zielonego ogrodu. Zapewnia całkowitą prywatność, posiada przytulny salon z kominkiem oraz aneks.', 'type' => 'textarea', 'group' => 'resort'],

            // Jarmark
            ['key' => 'jarmark_hero_title', 'label' => 'Jarmark - Tytuł Nagłówka', 'value' => 'Jarmark & Kawiarnia Rzemieślnicza', 'type' => 'text', 'group' => 'jarmark'],
            ['key' => 'jarmark_hero_description', 'label' => 'Jarmark - Opis Nagłówka', 'value' => 'Wyjątkowe miejsce w Dolinie Skawy łączące rzemieślniczą kawę, lokalne wypieki oraz warsztaty kulinarno-artystyczne.', 'type' => 'textarea', 'group' => 'jarmark'],

            // Gospodarstwo
            ['key' => 'gospodarstwo_hero_title', 'label' => 'Gospodarstwo - Tytuł Nagłówka', 'value' => 'Gospodarstwo Rolne MIRiOLA', 'type' => 'text', 'group' => 'farm'],
            ['key' => 'gospodarstwo_hero_description', 'label' => 'Gospodarstwo - Opis Nagłówka', 'value' => 'Tradycyjne uprawy, ekologiczne przetwory i wiejskie produkty prosto od rolnika w Dolinie Skawy.', 'type' => 'textarea', 'group' => 'farm'],
            ['key' => 'gospodarstwo_phone', 'label' => 'Gospodarstwo - Telefon do zamówień', 'value' => '+48 608 103 119', 'type' => 'text', 'group' => 'farm'],
        ];

        foreach ($cmsFields as $field) {
            CmsContent::updateOrCreate(
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
                'is_available' => true,
                'sort_order' => 1,
                'amenities' => ['Pokój normalny', 'Max 6 osób', '6 łóżek pojedynczych', 'Wystrój pomarańczowy'],
                'images' => [
                    'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'name' => 'Pokój Borówkowy',
                'room_type' => 'Pokój 5-osobowy',
                'capacity' => 5,
                'price_per_night' => 240.00,
                'is_available' => true,
                'sort_order' => 2,
                'amenities' => ['Pokój normalny', 'Max 5 osób', '5 łóżek pojedynczych', 'Wystrój borówkowy'],
                'images' => [
                    'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'name' => 'Apartament Oliwkowy',
                'room_type' => 'Apartament 2-pokojowy',
                'capacity' => 6,
                'price_per_night' => 450.00,
                'is_available' => true,
                'sort_order' => 3,
                'amenities' => ['Apartament 2-pokojowy', 'Max 6 osób', 'Stylowy akcent oliwkowy'],
                'images' => [
                    'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'name' => 'Apartament Tiramisu',
                'room_type' => 'Apartament 2-poziomowy',
                'capacity' => 5,
                'price_per_night' => 460.00,
                'is_available' => true,
                'sort_order' => 4,
                'amenities' => ['Apartament 2-pokojowy', 'Dwupoziomowy', 'Max 5 osób', 'Wystrój Tiramisu'],
                'images' => [
                    'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1540518614846-7eded433c457?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'name' => 'Pokój Cytrynowy',
                'room_type' => 'Pokój 5-osobowy',
                'capacity' => 5,
                'price_per_night' => 250.00,
                'is_available' => true,
                'sort_order' => 5,
                'amenities' => ['Max 5 osób', '1 łóżko podwójne', '3 łóżka pojedyncze', 'Wystrój cytrynowy'],
                'images' => [
                    'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'name' => 'Domek nr 1',
                'room_type' => 'Domek Letniskowy',
                'capacity' => 4,
                'price_per_night' => 350.00,
                'is_available' => true,
                'sort_order' => 6,
                'amenities' => ['Domek 4 os.', '1 łóżko podwójne', '2 łóżka pojedyncze'],
                'images' => [
                    'https://images.unsplash.com/photo-1587061949409-02df41d5e562?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'name' => 'Domek nr 2',
                'room_type' => 'Domek Letniskowy',
                'capacity' => 4,
                'price_per_night' => 350.00,
                'is_available' => true,
                'sort_order' => 7,
                'amenities' => ['Domek 4 os.', '1 łóżko podwójne', '2 łóżka pojedyncze'],
                'images' => [
                    'https://images.unsplash.com/photo-1510798831971-661eb04b3739?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1449844908441-88298745961d?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'name' => 'Domek nr 3',
                'room_type' => 'Domek Letniskowy',
                'capacity' => 4,
                'price_per_night' => 350.00,
                'is_available' => true,
                'sort_order' => 8,
                'amenities' => ['Domek 4 os.', '1 łóżko podwójne', '2 łóżka pojedyncze'],
                'images' => [
                    'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'name' => 'Domek nr 4',
                'room_type' => 'Domek z aneksem',
                'capacity' => 4,
                'price_per_night' => 380.00,
                'is_available' => true,
                'sort_order' => 9,
                'amenities' => ['Domek 4 os.', '1 łóżko podwójne', '2 łóżka pojedyncze', 'Aneks kuchenny'],
                'images' => [
                    'https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=800&q=80',
                ],
            ],
            [
                'name' => 'Domek VIP (Via)',
                'room_type' => 'Domek 2-pokojowy',
                'capacity' => 5,
                'price_per_night' => 420.00,
                'is_available' => true,
                'sort_order' => 10,
                'amenities' => ['Domek VIP Via 2-pokojowy', 'Max 5 osób'],
                'images' => [
                    'https://images.unsplash.com/photo-1613977257363-707ba9348227?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
                ],
            ],
        ];

        foreach ($roomsData as $room) {
            \App\Models\Room::updateOrCreate(['name' => $room['name']], $room);
        }

        // 8. Seed Sample Reservations
        // These matched no seeded room ('103'/'202'/'Domek Letniskowy 2' do not
        // exist), so no reservation was ever seeded. See REVIEW.md M-13.
        $room103 = \App\Models\Room::where('name', 'Pokój Pomarańczowy')->first();
        $room202 = \App\Models\Room::where('name', 'Apartament Oliwkowy')->first();
        $domek2 = \App\Models\Room::where('name', 'Domek nr 2')->first();

        if ($room103) {
            \App\Models\Reservation::updateOrCreate(
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
            \App\Models\Reservation::updateOrCreate(
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
            \App\Models\Reservation::updateOrCreate(
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
