SET FOREIGN_KEY_CHECKS=0;

-- Table: users
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`, `role`) VALUES
(1, 'Administrator', 'admin@miriola.pl', NULL, '$2y$12$cNhwW/QNhB14667L39JICueGF0P37wRAOZxmK8BNJ7hJ.jeDhvmpG', NULL, '2026-08-06 13:03:42', '2026-08-23 22:29:06', 1, 'admin');

-- Table: cms_contents
DELETE FROM `cms_contents`;
INSERT INTO `cms_contents` (`id`, `key`, `label`, `value`, `type`, `group`, `created_at`, `updated_at`) VALUES
(1, 'phone_number', 'Telefon główny do rezerwacji', '+48 608 103 119', 'text', 'general', '2026-08-06 13:03:42', '2026-08-06 13:03:42'),
(2, 'email_address', 'E-mail kontaktowy', 'miroslawzadora@wp.pl', 'text', 'general', '2026-08-06 13:03:42', '2026-08-06 13:03:42'),
(3, 'facebook_url', 'Link do profilu Facebook (Ośrodek)', 'https://www.facebook.com/p/Miriola-noclegi-100057455918786/?locale=pl_PL', 'url', 'general', '2026-08-06 13:03:42', '2026-08-09 20:48:47'),
(4, 'olx_url', 'Link do ogłoszeń OLX', 'https://www.olx.pl/d/oferta/noclegi-zator-wadowice-rodziny-wycieczki-grupy-do-45-osob-posilki-hb-CID1816-IDKBWIY.html?isPreviewActive=0&sliderIndex=0&srsltid=AfmBOoqYM6MhpIRkEbA7QBXh6SWkobLNq8khCjq-ojhLXTUk3PByYanh', 'url', 'general', '2026-08-06 13:03:42', '2026-08-18 20:37:56'),
(5, 'instagram_url', 'Link do profilu Instagram', 'https://www.instagram.com/miroslawzadora/', 'url', 'general', '2026-08-06 13:03:42', '2026-08-20 18:22:33'),
(6, 'osrodek_hero_title', 'Ośrodek - Tytuł Nagłówka Hero', 'Odkryj spokój w sercu doliny Skawy', 'text', 'resort', '2026-08-06 13:03:42', '2026-08-06 13:03:42'),
(7, 'osrodek_hero_description', 'Ośrodek - Opis Nagłówka Hero', 'Komfortowe noclegi blisko Wadowic i Jeziora Mucharskiego', 'textarea', 'resort', '2026-08-06 13:03:42', '2026-08-06 13:03:42'),
(17, 'jarmark_hero_title', 'Jarmark - Tytuł Nagłówka', 'Jarmark & Kawiarnia Rzemieślnicza', 'text', 'jarmark', '2026-08-06 13:03:42', '2026-08-06 13:03:42'),
(18, 'jarmark_hero_description', 'Jarmark - Opis Nagłówka', 'Wyjątkowe miejsce w Dolinie Skawy łączące rzemieślniczą kawę, lokalne wypieki oraz klimatyczną strefę spotkań.', 'textarea', 'jarmark', '2026-08-06 13:03:42', '2026-08-18 20:46:44'),
(19, 'gospodarstwo_hero_title', 'Gospodarstwo - Tytuł Nagłówka', 'Gospodarstwo Ogrodniczo-Pszczelarskie MIRiOLA', 'text', 'farm', '2026-08-06 13:03:42', '2026-08-23 12:43:18'),
(20, 'gospodarstwo_hero_description', 'Gospodarstwo - Opis Nagłówka', 'Tradycyjna uprawa i ekologiczne plony w czystym mikroklimacie Doliny Skawy. Prosto z naszych pól i pasieki oferujemy 3 rodzaje ekologicznego czosnku, świeże borówki, naturalne miody oraz domowe przetwory i nie tylko.', 'textarea', 'farm', '2026-08-06 13:03:42', '2026-08-23 13:10:25'),
(21, 'gospodarstwo_phone', 'Gospodarstwo - Telefon do zamówień', '+48 608 103 119', 'text', 'farm', '2026-08-06 13:03:42', '2026-08-06 13:03:42'),
(22, 'jarmark_facebook_url', 'Link do profilu Facebook (Jarmark)', 'https://www.facebook.com/jarmark.miriola/', 'url', 'general', '2026-08-09 20:48:47', '2026-08-09 20:48:47'),
(23, 'room1_title', 'Pokój 1 - Tytuł', 'Pokój 2-osobowy', 'text', 'resort', '2026-08-09 20:48:47', '2026-08-09 20:48:47'),
(25, 'room1_description', 'Pokój 1 - Opis', 'Kameralny i elegancki pokój z dużym łóżkiem dwuosobowym, idealny dla par szukających relaksu z pięknym widokiem na okolicę.', 'textarea', 'resort', '2026-08-09 20:48:47', '2026-08-09 20:48:47'),
(26, 'room2_title', 'Pokój 2 - Tytuł', 'Apartament Rodzinny', 'text', 'resort', '2026-08-09 20:48:47', '2026-08-09 20:48:47'),
(28, 'room2_description', 'Pokój 2 - Opis', 'Przestronny apartament dla całej rodziny, wyposażony w aneks kuchenny, komfortową część wypoczynkową oraz duży taras z widokiem.', 'textarea', 'resort', '2026-08-09 20:48:47', '2026-08-09 20:48:47'),
(29, 'room3_title', 'Pokój 3 - Tytuł', 'Domek Letniskowy', 'text', 'resort', '2026-08-09 20:48:47', '2026-08-09 20:48:47'),
(31, 'room3_description', 'Pokój 3 - Opis', 'Samodzielny domek w otoczeniu zielonego ogrodu. Zapewnia całkowitą prywatność, posiada przytulny salon z kominkiem oraz aneks.', 'textarea', 'resort', '2026-08-09 20:48:47', '2026-08-09 20:48:47'),
(32, 'cafe_cat_image_kawy_napoje', 'Kawiarnia - Zdjęcie kategorii Kawy & Napoje', 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&w=800&q=80', 'image', 'jarmark', '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(33, 'cafe_cat_image_lody', 'Kawiarnia - Zdjęcie kategorii Lody', 'cms-graphics/lody.webp', 'image', 'jarmark', '2026-08-18 21:45:14', '2026-08-24 09:29:13'),
(34, 'cafe_cat_image_gofry', 'Kawiarnia - Zdjęcie kategorii Gofry', 'cms-graphics/01M0BJ6TBADY4Z5NQHG4RPWFPP.webp', 'image', 'jarmark', '2026-08-18 21:45:14', '2026-08-18 23:09:51'),
(35, 'cafe_cat_image_desery', 'Kawiarnia - Zdjęcie kategorii Desery', 'cms-graphics/01M0BJ86P1107R2HTDV6ZTCBE8.webp', 'image', 'jarmark', '2026-08-18 21:45:14', '2026-08-18 23:10:37'),
(36, 'cafe_cat_image_zapiekanki', 'Kawiarnia - Zdjęcie kategorii Zapiekanki', 'cms-graphics/01M0BJ5EAWM9P4A2DXPQ795VSV.webp', 'image', 'jarmark', '2026-08-18 21:45:14', '2026-08-18 23:09:06'),
(37, 'tiktok_url', 'Link do profilu TikTok', 'https://www.tiktok.com/@miriola_cafe_bar_', 'url', 'general', '2026-08-22 08:42:15', '2026-08-23 13:12:14'),
(38, 'gospodarstwo_cert_info', 'Gospodarstwo - Informacja o rejestracji w Sanepidzie i RHD', 'Gospodarstwo prowadzi Rolniczy Handel Detaliczny (RHD) i jest zarejestrowane w Sanepidzie. Skontaktuj się z nami telefonicznie, aby potwierdzić aktualną dostępność i ustalić termin odbioru!', 'textarea', 'farm', '2026-08-23 12:43:18', '2026-08-23 13:10:25'),
(39, 'gospodarstwo_allegro_text', 'Gospodarstwo - Tekst o Allegro Lokalnie', 'Istnieje możliwość zakupu na Allegro Lokalnie', 'text', 'farm', '2026-08-23 12:43:18', '2026-08-23 12:43:18'),
(40, 'gospodarstwo_allegro_url', 'Gospodarstwo - Link do Allegro Lokalnie', 'https://allegrolokalnie.pl', 'url', 'farm', '2026-08-23 12:43:18', '2026-08-23 12:43:18'),
(41, 'osrodek_award_badge', 'Ośrodek - Znaczek / Certyfikat Hero (np. Orły Turystyki)', 'assets/img/orl.webp', 'image', 'resort', '2026-08-23 12:43:18', '2026-08-23 22:22:59'),
(42, 'phone_number_2', 'Telefon dodatkowy do kontaktu', '+48 696 312 574', 'text', 'general', '2026-08-23 13:19:29', '2026-08-23 13:19:29'),
(43, 'hero_badge', 'Ośrodek - Odznaka / Badge Hero', 'Komfortowe noclegi w dolinie Skawy', 'text', 'resort', '2026-08-23 22:22:59', '2026-08-23 22:22:59'),
(44, 'hero_title', 'Ośrodek - Tytuł Główny Hero (Alias)', 'Odkryj spokój w sercu doliny Skawy', 'text', 'resort', '2026-08-23 22:22:59', '2026-08-23 22:22:59'),
(45, 'hero_description', 'Ośrodek - Opis Główny Hero (Alias)', 'Komfortowe noclegi blisko Wadowic i Jeziora Mucharskiego', 'textarea', 'resort', '2026-08-23 22:22:59', '2026-08-23 22:22:59'),
(46, 'rooms_section_title', 'Ośrodek - Tytuł Sekcji Pokoje i Domki', 'Pokoje i Domki', 'text', 'resort', '2026-08-23 22:22:59', '2026-08-23 22:22:59');

-- Table: rooms
DELETE FROM `rooms`;
INSERT INTO `rooms` (`id`, `name`, `room_type`, `capacity`, `price_per_night`, `price_unit`, `description`, `image`, `sort_order`, `created_at`, `updated_at`, `images`, `amenities`) VALUES
(41, 'Pokój Pomarańczowy', 'Pokój 6-osobowy', 6, 250, 'zł / noc', NULL, NULL, 1, '2026-08-10 13:44:28', '2026-08-18 20:54:40', '["rooms\\/01M0BAF924TG6W47J7299CDQJ1-558c6dc9.webp","rooms\\/01M0BAF9250B5GKF3ADMGCBXXD-a1d60a05.webp","rooms\\/01M0BAF9250B5GKF3ADMGCBXXE-e1f4a4f4.webp","rooms\\/01M0BAF926VW5GWQYQ34K4BN86-3b6e0f68.webp"]', '["Pok\\u00f3j normalny","Max 6 os\\u00f3b","6 \\u0142\\u00f3\\u017cek pojedynczych","Wystr\\u00f3j pomara\\u0144czowy"]'),
(42, 'Pokój Borówkowy', 'Pokój 5-osobowy', 5, 240, 'zł / noc', NULL, NULL, 2, '2026-08-10 13:44:28', '2026-08-18 21:04:32', '["rooms\\/01M0BB1BCQG9QCQ99ESAZ4M44X-a0f09824.webp","rooms\\/01M0BB1BCRS8RJB00X79MTD6VM-d4ca5f83.webp"]', '["Pok\\u00f3j normalny","Max 5 os\\u00f3b","5 \\u0142\\u00f3\\u017cek pojedynczych","Wystr\\u00f3j bor\\u00f3wkowy"]'),
(43, 'Apartament Oliwkowy', 'Apartament 2-pokojowy', 6, 450, 'zł / noc', NULL, NULL, 3, '2026-08-10 13:44:28', '2026-08-18 21:09:04', '["rooms\\/01M0BB9N5RMVBFMRYCG6S3K5E1-8b4f343b.webp","rooms\\/01M0BB9N5S5V83R4VZCBDFPKMQ-b13dd59f.webp","rooms\\/01M0BB9N5TAQKT47SMXX6NZ9PV-54acbbde.webp","rooms\\/01M0BB9N5TAQKT47SMXX6NZ9PW-799b5123.webp"]', '["Apartament 2-pokojowy","Max 6 os\\u00f3b","Stylowy akcent oliwkowy"]'),
(44, 'Apartament Tiramisu', 'Apartament 2-poziomowy', 5, 460, 'zł / noc', NULL, NULL, 4, '2026-08-10 13:44:28', '2026-08-18 21:00:39', '["rooms\\/01M0BAR5N8ENT18D2Q6ATSWP79-e72f43df.webp","rooms\\/01M0BAT7YFHYB31EP02EANVQR7-3f63f3a0.webp","rooms\\/01M0BAT7YGVK22THXE208BSJRT-a7198efe.webp"]', '["Apartament 2-pokojowy","Dwupoziomowy","Max 5 os\\u00f3b","Wystr\\u00f3j Tiramisu"]'),
(45, 'Pokój Cytrynowy', 'Pokój 5-osobowy', 5, 250, 'zł / noc', NULL, NULL, 5, '2026-08-10 13:44:28', '2026-08-23 12:31:49', '["rooms\\/01M0Q9P43MNQS57J6BCBJE5GAV-a1d60a05.webp"]', '["Max 5 os\\u00f3b","1 \\u0142\\u00f3\\u017cko podw\\u00f3jne","3 \\u0142\\u00f3\\u017cka pojedyncze","Wystr\\u00f3j cytrynowy"]'),
(46, 'Domek nr 6', 'Domek Letniskowy', 4, 350, 'zł / noc', NULL, NULL, 6, '2026-08-10 13:44:28', '2026-08-21 20:07:24', '["rooms\\/01M0JYST3VF5W143QYJZZ9HW01-197144cd.webp","rooms\\/01M0JYST3WKQT0NJQ6QZV4BFRD-1d4692f4.webp","rooms\\/01M0JYST3SYRJSEKKTYGWTE69D-34afe4a1.webp","rooms\\/01M0JYST3TS69MX39WR7J2ADWM-aae24fe4.webp","rooms\\/01M0JYST3VF5W143QYJZZ9HVZY-cc62b1a5.webp","rooms\\/01M0JYST3VF5W143QYJZZ9HVZZ-fcc7499f.webp","rooms\\/01M0JYST3VF5W143QYJZZ9HW00-0ff1b6c5.webp"]', '["Domek 4 os.","1 \\u0142\\u00f3\\u017cko podw\\u00f3jne","2 \\u0142\\u00f3\\u017cka pojedyncze"]'),
(47, 'Domek nr 7', 'Domek Letniskowy', 4, 350, 'zł / noc', NULL, NULL, 7, '2026-08-10 13:44:28', '2026-08-21 20:07:04', '["rooms\\/01M0JYTRFKX4PMAF5NFVC2ZE6X-197144cd.webp","rooms\\/01M0JYTRFKX4PMAF5NFVC2ZE6V-1d4692f4.webp","rooms\\/01M0JYTRFHBHV6EGEK7JHWY2HK-fcc7499f.webp","rooms\\/01M0JYTRFJ4Z371PEFYGVV9BNM-0ff1b6c5.webp","rooms\\/01M0JYTRFKX4PMAF5NFVC2ZE6T-cc62b1a5.webp","rooms\\/01M0JYTRFKX4PMAF5NFVC2ZE6W-aae24fe4.webp","rooms\\/01M0JYTRFMSBYY8BQ7MJP07PFW-34afe4a1.webp"]', '["Domek 4 os.","1 \\u0142\\u00f3\\u017cko podw\\u00f3jne","2 \\u0142\\u00f3\\u017cka pojedyncze"]'),
(48, 'Domek nr 8', 'Domek Letniskowy', 4, 350, 'zł / noc', NULL, NULL, 8, '2026-08-10 13:44:28', '2026-08-21 20:07:48', '["rooms\\/01M0JYVM43Y1JBKNVX0P9WAZTP-197144cd.webp","rooms\\/01M0JYVM42Y3FA7RMNV5H23X37-1d4692f4.webp","rooms\\/01M0JYVM41XFC2Y3JM0A68ZK8G-fcc7499f.webp","rooms\\/01M0JYVM42Y3FA7RMNV5H23X35-0ff1b6c5.webp","rooms\\/01M0JYVM42Y3FA7RMNV5H23X36-cc62b1a5.webp","rooms\\/01M0JYVM42Y3FA7RMNV5H23X38-aae24fe4.webp","rooms\\/01M0JYVM43Y1JBKNVX0P9WAZTQ-34afe4a1.webp"]', '["Domek 4 os.","1 \\u0142\\u00f3\\u017cko podw\\u00f3jne","2 \\u0142\\u00f3\\u017cka pojedyncze"]'),
(49, 'Domek nr 9', 'Domek z aneksem', 4, 380, 'zł / noc', NULL, NULL, 9, '2026-08-10 13:44:28', '2026-08-23 14:24:29', '["rooms\\/01M0QG4DNT2TNESYTSG83PD7JG-16205de3.webp","rooms\\/01M0QG4DNWFX6M2WWZ326YHM2M-65d21bcf.webp","rooms\\/01M0QG4DNXCXMTNYVCP14KBMVZ-20ee2847.webp","rooms\\/01M0QG4DNXCXMTNYVCP14KBMW0-c6a32515.webp","rooms\\/01M0QG4DNY51WY2P4X6BG6MHA2-c37a7c83.webp"]', '["Domek 4 os.","1 \\u0142\\u00f3\\u017cko podw\\u00f3jne","2 \\u0142\\u00f3\\u017cka pojedyncze","Aneks kuchenny"]'),
(50, 'Domek VIP', 'Domek 2-pokojowy', 5, 420, 'zł / noc', NULL, NULL, 10, '2026-08-10 13:44:28', '2026-08-22 08:30:16', '["rooms\\/01M0BBRZ56Q2PWHRA491K4KC9M-fc53d220.webp","rooms\\/01M0BBRZ575J4THM9S2PXH6BJF-c9d3dbcb.webp","rooms\\/01M0BBRZ575J4THM9S2PXH6BJG-34cc552a.webp","rooms\\/01M0BBRZ575J4THM9S2PXH6BJH-3bf51bda.webp","rooms\\/01M0BBRZ575J4THM9S2PXH6BJJ-d8cb0b05.webp","rooms\\/01M0BBRZ56Q2PWHRA491K4KC9N-2cb2883d.webp"]', '["Domek VIP Via 2-pokojowy","Max 5 os\\u00f3b"]');

-- Table: reservations
DELETE FROM `reservations`;
INSERT INTO `reservations` (`id`, `room_id`, `guest_name`, `guest_phone`, `guest_email`, `check_in_date`, `check_out_date`, `total_price`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(14, 41, 'Jan Kowalski', '601 222 333', 'jan.kowalski@example.com', '2026-08-04 00:00:00', '2026-08-12 00:00:00', 2160, 'confirmed', 'Wpłacono zaliczkę 200 zł przelewem. Przyjazd planowany ok. godz 15:00.', '2026-08-18 19:55:44', '2026-08-18 19:55:44'),
(15, 43, 'Anna i Marek Nowak', '699 444 555', 'nowakowie@example.com', '2026-08-03 00:00:00', '2026-08-10 00:00:00', 3150, 'confirmed', 'Przyjazd z małym psem (dopłata 50 zł za psa zaksięgowana).', '2026-08-18 19:55:44', '2026-08-18 19:55:44'),
(16, 47, 'Piotr Wiśniewski', '505 111 888', 'p.wisniewski@example.com', '2026-08-01 00:00:00', '2026-08-08 00:00:00', 2450, 'confirmed', 'Potrzebne łóżeczko turystyczne dla niemowlęcia w domku.', '2026-08-18 19:55:44', '2026-08-18 19:55:44');

-- Table: restaurant_halls
DELETE FROM `restaurant_halls`;
INSERT INTO `restaurant_halls` (`id`, `name`, `slug`, `subtitle`, `capacity`, `description`, `main_image`, `gallery_images`, `features`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Sala Główna Biesiadna', 'sala-glowna-biesiadna', 'Tradycyjny klimat, kominek i miejsce na duże przyjęcia', 120, 'Przestronna, elegancko wykończona w drewnie i kamieniu sala biesiadna. Idealna na wesela, bankiety firmowe, chrzciny oraz spotkania rodzinne. Wyposażona w nowoczesne nagłośnienie, klimatyzację oraz bezpośrednie wyjście do ogrodu.', 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80', NULL, '["Klimatyzacja","Nag\\u0142o\\u015bnienie","Kominek","Wyj\\u015bcie do ogrodu","Parkiet taneczny"]', 1, '2026-08-06 13:03:42', '2026-08-06 13:03:42'),
(2, 'Sala Kameralna Tarasowa', 'sala-kameralna-tarasowa', 'Kameralna atmosfera z panoramicznym widokiem na Dolinę Skawy', 45, 'Jasna i przytulna sala usytuowana na piętrze, z wyjściem na rozległy zadaszony taras. Doskonała na kameralne przyjęcia rodzinne, spotkania biznesowe czy jubileusze z pięknym widokiem na naturę.', 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1200&q=80', NULL, '["Zadaszony taras","Widok na dolin\\u0119","WiFi","Kameralny wystr\\u00f3j","Klimatyzacja"]', 2, '2026-08-06 13:03:42', '2026-08-18 20:46:44');

-- Table: attractions
DELETE FROM `attractions`;
INSERT INTO `attractions` (`id`, `title`, `branch`, `description`, `icon`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(47, 'Jacuzzi w Ogrodzie', 'resort', 'Relaksujące jacuzzi ogrodowe na świeżym powietrzu dla gości.', 'hot_tub', NULL, 1, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(48, 'Duża Wiata Biesiadna', 'resort', 'Przestronna, zadaszona wiata ogrodowa ze strefą do grillowania.', 'deck', NULL, 2, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(49, 'Bezpłatny Parking', 'resort', 'Wygodny, bezpłatny i ogrodzony parking na terenie ośrodka.', 'local_parking', NULL, 3, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(50, 'Plac Zabaw dla Dzieci', 'resort', 'Bezpieczny plac zabaw ze strefą rozrywki dla najmłodszych.', 'child_care', NULL, 4, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(51, 'Tyrolka & Zjeżdżalnia na Pontonie', 'jarmark', 'Poczuj dreszczyk emocji na tyrolce lub zjedź na kolorowym pontonie po naszej długiej zjeżdżalni plenerowej. Atrakcja dla dzieci i dorosłych — gwarantowana dawka adrenaliny i śmiechu!', 'water', 'attractions/tyrolka-pontony-75bbe870.webp', 1, '2026-08-18 22:52:08', '2026-08-18 22:52:08'),
(52, 'Dmuchany Plac Zabaw', 'jarmark', 'Ogromny dmuchany zamek z zjeżdżalnią, tunelami i wejściami — raj dla każdego dziecka! Bezpieczna strefa zabawy na świeżym powietrzu, tuż obok kawiarni plenerowej.', 'toys', 'attractions/dmuchaniec.webp', 2, '2026-08-18 22:52:08', '2026-08-18 22:52:08'),
(53, 'Sferyczna Kopuła Plenerowa', 'jarmark', 'Wyjątkowe miejsce do relaksu i spotkań — nowoczesna kopuła geodezyjne otwarta na ogród i naturę. Idealna jako strefa wypoczynku w pięknej scenerii MIRiOLA.', 'explore', 'attractions/kopula.webp', 3, '2026-08-18 22:52:08', '2026-08-18 22:52:08');

-- Table: cafe_menu_items
DELETE FROM `cafe_menu_items`;
INSERT INTO `cafe_menu_items` (`id`, `name`, `category`, `description`, `price`, `image`, `is_available`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Espresso', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(2, 'Kawa Czarna', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:50:01'),
(3, 'Kawa Latte', 'kawy_napoje', NULL, NULL, NULL, 1, 1, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(4, 'Cappuccino', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(5, 'Flat White', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(6, 'Macchiato', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(7, 'Podwójne Espresso', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(8, 'Kawa Mrożona', 'kawy_napoje', NULL, NULL, NULL, 1, 1, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(9, 'Kawa z Lodami', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(10, 'Grzaniec Jabłkowy (duży / mały)', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(11, 'Lemoniada w Butelce', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(12, 'Napój w Puszce (duża / mała)', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(13, 'Sok Owocowy 100%', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(14, 'Sok Mandarynkowy (w kubku 0.25l)', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(15, 'Woda Mineralna (0.50l)', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(16, 'Herbata', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(17, 'Piwo Łomża 0,0% (0.5l)', 'kawy_napoje', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(18, 'Świderki Bezglutenowe - Śmietankowe', 'lody', NULL, NULL, NULL, 1, 1, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(19, 'Świderki Bezglutenowe - Czekoladowe', 'lody', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(20, 'Świderki Bezglutenowe - Czekoladowo-Śmietankowe', 'lody', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(21, 'Świderki Bezglutenowe - Truskawkowe', 'lody', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(22, 'Dodatki do Lodów (Posypka, Wafelek, Polewa)', 'lody', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(23, 'Gofry Solo', 'gofry', NULL, NULL, NULL, 1, 1, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(24, 'Dodatki do Gofrów (Cukier Puder, Dżem, Nutella, Śmietana, Polewa, Owoce, Miód)', 'gofry', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(25, 'Lody + Bita Śmietana bez laktozy + Owoce + Polewa', 'desery', NULL, NULL, NULL, 1, 1, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(26, 'Bita Śmietana + Owoce + Polewa do wyboru', 'desery', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(27, 'Jabłecznik z Lodami i Śmietaną', 'desery', NULL, NULL, NULL, 1, 1, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(28, 'Jabłecznik Domowy', 'desery', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(29, 'Rurka z Bitą Śmietaną', 'desery', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14'),
(30, 'Zapiekanka Giga Pieczarki Ser', 'zapiekanki', NULL, NULL, NULL, 1, 1, 0, '2026-08-18 21:45:14', '2026-08-18 21:55:03'),
(31, 'Zapiekanka Mała', 'zapiekanki', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:55:14'),
(32, 'Dodatek: Cebulka Prażona', 'zapiekanki', NULL, NULL, NULL, 1, 0, 0, '2026-08-18 21:45:14', '2026-08-18 21:45:14');

-- Table: farm_products
DELETE FROM `farm_products`;
INSERT INTO `farm_products` (`id`, `name`, `description`, `unit_price`, `unit_name`, `image`, `is_available`, `phone_contact`, `sort_order`, `created_at`, `updated_at`) VALUES
(6, 'Dżem borówkowy 100% słoik 65dag', NULL, NULL, 'kg', NULL, 1, '+48608103119', 0, '2026-08-22 09:00:02', '2026-08-23 22:42:04'),
(7, 'Czosnek czarny 1 kg MANUFAKTURA fermentacja bieżąca z własnej uprawy.', NULL, NULL, 'kg', 'farm-products/01M0RC1X5CPB2JCGJK8KQ9BK6P.webp', 1, '+48608103119', 0, '2026-08-23 22:32:27', '2026-08-23 22:32:27'),
(8, 'Czosnek obierany z polskiego czosnku extra jakość 5kg', NULL, NULL, 'kg', 'farm-products/01M0RCCQ7HZE11T40MC3FSKG0W.webp', 1, '+48608103119', 0, '2026-08-23 22:38:21', '2026-08-23 22:38:21'),
(10, 'Czosnek Ekologiczny (3 Rodzaje)', NULL, NULL, 'kg', NULL, 1, '+48608103119', 0, '2026-08-23 22:49:12', '2026-08-23 22:49:12'),
(11, 'Borówka Amerykańska', NULL, NULL, 'kg', NULL, 1, '+48608103119', 0, '2026-08-23 22:50:33', '2026-08-23 22:50:33'),
(12, 'Miód Naturalny z Pasieki MIRiOLA', NULL, NULL, 'kg', NULL, 1, '+48608103119', 0, '2026-08-23 22:50:41', '2026-08-23 22:50:41');

-- Table: gallery_images
DELETE FROM `gallery_images`;
INSERT INTO `gallery_images` (`id`, `branch`, `title`, `image`, `sort_order`, `is_published`, `created_at`, `updated_at`, `video_url`, `media_type`) VALUES
(31, 'resort', NULL, 'gallery/01M0BC5NTXQXRQDGZ465NE2JPX-94eb9851.webp', 0, 1, '2026-08-18 21:24:23', '2026-08-18 21:24:23', NULL, 'image'),
(32, 'resort', NULL, 'gallery/01M0BC6B5451D3Y037FGWX7ZPS-7798a69d.webp', 1, 1, '2026-08-18 21:24:44', '2026-08-18 21:24:44', NULL, 'image'),
(33, 'resort', NULL, 'gallery/01M0BC6RFQVWYRZYMR0F12P1KT-66bd9389.webp', 2, 1, '2026-08-18 21:24:58', '2026-08-18 21:24:58', NULL, 'image'),
(34, 'resort', NULL, 'gallery/01M0BC77GZVS089FR1E2E6BE2P-9cdc8c1a.webp', 3, 1, '2026-08-18 21:25:13', '2026-08-18 21:25:29', NULL, 'image'),
(35, 'resort', NULL, 'gallery/01M0BC888QVRTGZXDXX2JM8J25-34bbe0a6.webp', 4, 1, '2026-08-18 21:25:47', '2026-08-18 21:25:47', NULL, 'image');

-- Table: faqs
DELETE FROM `faqs`;
INSERT INTO `faqs` (`id`, `question`, `answer`, `branch`, `sort_order`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'Jak daleko jest do jeziora?', 'Nasz ośrodek znajduje się zaledwie 1 km od zapory wodnej w Świnnej Porębie (Jezioro Mucharskie), w malowniczej dolinie Skawy.', 'resort', 1, 1, '2026-08-07 17:20:01', '2026-08-07 17:20:01'),
(3, 'Jakie są godziny zameldowania?', 'Doba hotelowa rozpoczyna się o godzinie 14:00 w dniu przyjazdu, a kończy o godzinie 11:00 w dniu wyjazdu.', 'resort', 3, 1, '2026-08-07 17:20:01', '2026-08-10 13:30:43'),
(4, 'Czy istnieje możliwość wynajęcia sal na imprezy okolicznościowe?', 'Tak! Oferujemy możliwość wynajęcia 2 przestronnych sal restauracyjno-bankietowych na organizację przyjęć, komunii, jubileuszy, szkoleń oraz spotkań firmowych. Prosimy o kontakt telefoniczny w celu ustalenia terminu i szczegółów.', 'resort', 4, 1, '2026-08-07 17:20:01', '2026-08-11 22:41:12'),
(5, 'Czy w ośrodku oferowane są śniadania?', 'Tak! Ośrodek prowadzi wyśmienite śniadania w naszej klimatycznej Sali Rycerskiej. Serwujemy obfity bufet oraz świeże lokalne produkty.', 'resort', 2, 1, '2026-08-10 13:30:43', '2026-08-10 13:30:43'),
(6, 'Czy na terenie obiektu jest parking?', 'Tak, zapewniamy bezpłatny, ogrodzony i monitorowany parking dla wszystkich naszych gości.', 'resort', 4, 1, '2026-08-18 19:55:33', '2026-08-18 19:55:33'),
(7, 'W jakich godzinach otwarta jest Kawiarnia Jarmark?', 'Kawiarnia Jarmark jest otwarta od poniedziałku do piątku w godzinach 15:00 - 20:00, a w weekendy (sobota-niedziela) w godzinach 10:00 - 20:00.', 'jarmark', 1, 1, '2026-08-18 19:55:33', '2026-08-18 19:55:33'),
(8, 'Czy strefa relaksu i dmuchaniec dla dzieci są płatne?', 'Korzystanie ze strefy ogrodowej, leżaków oraz dmuchanego placu zabaw jest bezpłatne dla klientów naszej kawiarni.', 'jarmark', 2, 1, '2026-08-18 19:55:33', '2026-08-18 19:55:33');

-- Table: news
DELETE FROM `news`;
INSERT INTO `news` (`id`, `title`, `slug`, `branch`, `excerpt`, `content`, `image`, `is_published`, `published_at`, `created_at`, `updated_at`, `media_type`, `video_url`) VALUES
(13, 'Serdecznie zapraszamy!☕️🍰', 'serdecznie-zapraszamy', 'jarmark', 'piwo koty psy', 'piwo koty psy', NULL, 1, '2026-08-19 10:51:45', '2026-08-19 10:52:32', '2026-08-21 10:59:46', 'video', 'https://www.tiktok.com/@miriola_cafe_bar_/video/7674310029117361440?_r=1&_t=ZN-98xSP9d2WL0'),
(16, 'Zapraszamy jutro na nasze pyszności!', 'zapraszamy-jutro-na-nasze-pysznosci', 'jarmark', NULL, NULL, NULL, 1, '2026-08-23 14:00:39', '2026-08-23 14:01:18', '2026-08-23 14:01:36', 'video', 'https://www.tiktok.com/@miriola_cafe_bar_/video/7676935358277373217?is_from_webapp=1&sender_device=pc&web_id=7675692474790233622'),
(17, 'W naszej kawiarni kupicie również czarny czosnek fermentowany!!', 'w-naszej-kawiarni-kupicie-rowniez-czarny-czosnek-fermentowany', 'farm', 'Bardzo dobry na cholesterol! Czekamy na Was codziennie', 'Bardzo dobry na cholesterol! Czekamy na Was codziennie', NULL, 1, '2026-08-23 14:02:16', '2026-08-23 14:02:54', '2026-08-23 14:05:44', 'video', 'https://www.tiktok.com/@miriola_cafe_bar_/video/7676900216733224224?is_from_webapp=1&sender_device=pc&web_id=7675692474790233622'),
(18, 'Nasze atrakcje!', 'nasze-atrakcje', 'jarmark', NULL, NULL, NULL, 1, '2026-08-23 14:04:16', '2026-08-23 14:04:35', '2026-08-23 14:04:35', 'video', 'https://www.tiktok.com/@miriola_cafe_bar_/video/7676563928670883104?is_from_webapp=1&sender_device=pc&web_id=7675692474790233622'),
(19, 'Kawa, lody i relaks!', 'kawa-lody-i-relaks', 'jarmark', 'Aromatyczna czarna kawa, deser lodowy i chwila pełna zabawy? To połączenie które nigdy nam się nie znudzi. Serdecznie zapraszamy do odwiedzenia naszej kawiarni....', 'Aromatyczna czarna kawa, deser lodowy i chwila pełna zabawy? To połączenie które nigdy nam się nie znudzi. Serdecznie zapraszamy do odwiedzenia naszej kawiarni. Dzisiaj działamy już od 11 do zmroku. Czekamy na Was!!!☕️🫐🍦', NULL, 1, '2026-08-23 14:05:47', '2026-08-23 14:06:55', '2026-08-23 14:06:55', 'video', 'https://www.tiktok.com/@miriola_cafe_bar_/video/7676082515865521441?is_from_webapp=1&sender_device=pc&web_id=7675692474790233622');

SET FOREIGN_KEY_CHECKS=1;
