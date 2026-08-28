<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Ośrodek Wypoczynkowy MIRiOLA - Dolina Skawy, Noclegi blisko Wadowic')</title>
    <meta name="description" content="@yield('meta_description', 'Zapraszamy do Ośrodka Wypoczynkowego MIRiOLA w dolinie Skawy. Oferujemy komfortowe pokoje, apartamenty i domki letniskowe blisko Wadowic i Jeziora Mucharskiego.')">
    <meta name="keywords" content="noclegi Wadowice, domki letniskowe Jezioro Mucharskie, pokoje gościnne dolina Skawy, ośrodek wypoczynkowy Miriola, apartamenty Wadowice, kawiarnia Wadowice, ogórki kiszone Wadowice">
    <meta name="author" content="Ośrodek Wypoczynkowy MIRiOLA">
    <meta name="robots" content="@yield('robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1')">
    <meta name="theme-color" content="#001e40">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/webp" href="{{ asset('favicon.webp') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.webp') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.webp') }}">

    <!-- Open Graph / Social Media SEO -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Ośrodek Wypoczynkowy MIRiOLA - Dolina Skawy, Noclegi blisko Wadowic')">
    <meta property="og:description" content="@yield('meta_description', 'Zapraszamy do Ośrodka Wypoczynkowego MIRiOLA w dolinie Skawy. Oferujemy komfortowe pokoje, apartamenty i domki letniskowe blisko Wadowic i Jeziora Mucharskiego.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/img/hero.webp'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="@yield('title', 'MIRiOLA - Ośrodek Wypoczynkowy, Jarmark, Gospodarstwo')">
    <meta property="og:locale" content="pl_PL">
    <meta property="og:site_name" content="MIRiOLA">

    <!-- Twitter Card SEO -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Ośrodek Wypoczynkowy MIRiOLA - Dolina Skawy')">
    <meta name="twitter:description" content="@yield('meta_description', 'Komfortowe noclegi, Jarmark i Kawiarnia oraz Gospodarstwo Rolne w Dolinie Skawy.')">
    <meta name="twitter:image" content="@yield('og_image', asset('assets/img/hero.webp'))">
    <meta name="twitter:image:alt" content="@yield('title', 'MIRiOLA - Ośrodek Wypoczynkowy, Jarmark, Gospodarstwo')">

    <!-- Schema.org JSON-LD — GlobalOrganization (obecna na każdej stronie) -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@graph": [
        {
          "@@type": "Resort",
          "@@id": "{{ url('/') }}#resort",
          "name": "Ośrodek Wypoczynkowy MIRiOLA",
          "alternateName": "MIRiOLA Dolina Skawy",
          "description": "Kompleks rekreacyjno-wypoczynkowy w dolinie Skawy: Ośrodek Wypoczynkowy, Jarmark Centrum Edukacyjno-Handlowe z Kawiarnią, Gospodarstwo Ogrodniczo-Pszczelarskie.",
          "image": [
            "{{ asset('assets/img/hero.webp') }}",
            "{{ asset('assets/img/jarmark-hero.webp') }}",
            "{{ asset('assets/img/gospodarstwo-hero.webp') }}"
          ],
          "url": "{{ url('/') }}",
          "telephone": "+48608103119",
          "email": "miroslawzadora@wp.pl",
          "priceRange": "250 zł - 450 zł",
          "currenciesAccepted": "PLN",
          "paymentAccepted": "Cash, Bank Transfer",
          "hasMap": "https://maps.google.com/?q=Zakopianska+192+Wadowice",
          "logo": {
            "@@type": "ImageObject",
            "url": "{{ asset('images/logo.webp') }}",
            "width": 180,
            "height": 48
          },
          "address": {
            "@@type": "PostalAddress",
            "streetAddress": "ul. Zakopiańska 192",
            "addressLocality": "Wadowice",
            "addressRegion": "Małopolska",
            "postalCode": "34-100",
            "addressCountry": "PL"
          },
          "geo": {
            "@@type": "GeoCoordinates",
            "latitude": 49.8833,
            "longitude": 19.4833
          },
          "openingHoursSpecification": [
            {
              "@@type": "OpeningHoursSpecification",
              "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
              "opens": "00:00",
              "closes": "23:59"
            }
          ],
          "amenityFeature": [
            {"@@type": "LocationFeatureSpecification", "name": "Parking",          "value": true},
            {"@@type": "LocationFeatureSpecification", "name": "WiFi",             "value": true},
            {"@@type": "LocationFeatureSpecification", "name": "Ogród",            "value": true},
            {"@@type": "LocationFeatureSpecification", "name": "Kawiarnia",        "value": true},
            {"@@type": "LocationFeatureSpecification", "name": "Plac zabaw",       "value": true},
            {"@@type": "LocationFeatureSpecification", "name": "Dostęp dla niepełnosprawnych", "value": true}
          ],
          "sameAs": [
            "https://www.facebook.com/p/Miriola-noclegi-100057455918786/"
          ],
          "containsPlace": [
            {
              "@@type": "CafeOrCoffeeShop",
              "name": "Kawiarnia Plenerowa Jarmark MIRiOLA",
              "servesCuisine": ["Kawa specialty", "Ciasta domowe", "Desery"],
              "url": "{{ url('/jarmark') }}",
              "telephone": "+48608103119"
            },
            {
              "@@type": ["LocalBusiness", "Farm"],
              "@@id": "{{ url('/gospodarstwo') }}#farm",
              "name": "Gospodarstwo Ogrodniczo-Pszczelarskie MIRiOLA",
              "description": "Naturalny czosnek, borówki i miody z własnej pasieki w dolinie Skawy.",
              "url": "{{ url('/gospodarstwo') }}"
            }
          ]
        },
        {
          "@@type": "WebSite",
          "@@id": "{{ url('/') }}#website",
          "url": "{{ url('/') }}",
          "name": "MIRiOLA Dolina Skawy",
          "inLanguage": "pl-PL",
          "publisher": {"@@id": "{{ url('/') }}#resort"}
        }
      ]
    }
    </script>
    {{-- Per-strona Schema (artykuły, breadcrumbs itp.) --}}
    @yield('schema')
    
    <!-- Fonts & Icons — scalony request (1 RTT zamiast 2) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Scalony URL: Noto Serif + Work Sans + Material Symbols w jednym request --}}
    <link rel="preload" as="style"
          href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&family=Work+Sans:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&family=Work+Sans:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    </noscript>

    <!-- AOS Animations CSS -->
    <link rel="preload" as="style" href="https://unpkg.com/aos@2.3.1/dist/aos.css" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    </noscript>

    <!-- Production Compiled Tailwind Assets -->
    <link rel="preload" as="style" href="{{ asset('build/assets/app-BYOZS_yM.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-BYOZS_yM.css') }}">
    <script type="module" src="{{ asset('build/assets/app-BvRk9kiK.js') }}"></script>
    
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    @yield('styles')
    @yield('head')
</head>
<body class="bg-background text-on-background font-body antialiased pt-20 flex flex-col min-h-screen">

    <!-- Top Navigation Bar -->
    <nav class="fixed top-0 left-0 w-full z-50 bg-background/95 border-b border-primary/10 shadow-sm transition-all duration-300">
        <div class="max-w-container-max mx-auto flex justify-between items-center h-20 px-gutter">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 sm:gap-3 group focus:outline-none focus:ring-2 focus:ring-primary rounded shrink-0" aria-label="Strona główna">
                <img src="{{ asset('images/logo.webp') }}" alt="MIRiOLA Logo" width="180" height="48" class="h-10 sm:h-12 w-auto object-contain group-hover:scale-105 transition-transform">
                <div class="flex flex-col">
                    <span class="font-display text-lg sm:text-xl font-bold text-primary tracking-wide leading-none">MIRiOLA</span>
                    <span class="text-[9px] sm:text-[10px] uppercase tracking-widest text-primary/70 font-bold mt-1">Dolina Skawy</span>
                </div>
            </a>
            
            @php
                $isOsrodek = Request::is('osrodek');
                $isJarmark = Request::is('jarmark');
                $isGospodarstwo = Request::is('gospodarstwo');
                $isAktualnosci = Request::is('aktualnosci') || Request::is('aktualnosci/*');

                $facebookUrl = $isJarmark 
                    ? ($cms['jarmark_facebook_url'] ?? 'https://www.facebook.com/jarmark.miriola/') 
                    : ($cms['facebook_url'] ?? 'https://www.facebook.com/p/Miriola-noclegi-100057455918786/?locale=pl_PL');

                $olxUrl = $cms['olx_url'] ?? 'https://www.olx.pl/d/oferta/noclegi-zator-wadowice-rodziny-wycieczki-grupy-do-45-osob-posilki-hb-CID1816-IDKBWIY.html?isPreviewActive=0&sliderIndex=0&srsltid=AfmBOoqYM6MhpIRkEbA7QBXh6SWkobLNq8khCjq-ojhLXTUk3PByYanh';

                if ($isGospodarstwo) {
                    $callBtnLabel = 'Zamów plony: 608 103 119';
                    $mobileCallBtnLabel = 'Zadzwoń i zamów plony';
                } elseif ($isJarmark) {
                    $callBtnLabel = 'Zadzwoń: 608 103 119';
                    $mobileCallBtnLabel = 'Zadzwoń do kawiarni';
                } elseif ($isOsrodek) {
                    $callBtnLabel = 'Zarezerwuj: 608 103 119';
                    $mobileCallBtnLabel = 'Zadzwoń i zarezerwuj';
                } else {
                    $callBtnLabel = 'Kontakt: 608 103 119';
                    $mobileCallBtnLabel = 'Zadzwoń do nas';
                }
            @endphp
            <!-- Desktop Links -->
            <div class="hidden lg:flex items-center gap-6 text-xs font-semibold" role="navigation" aria-label="Główne menu">
                <a href="{{ url('/') }}" class="bg-primary/5 text-primary hover:bg-primary hover:text-white px-3.5 py-1.5 rounded-full transition-all flex items-center gap-1.5 border border-primary/10 font-bold">
                    <span class="material-symbols-outlined text-base">apps</span>
                    Wybór Działalności
                </a>

                @if($isAktualnosci)
                    @php
                        $activeBranch = $currentBranch ?? (isset($article) ? $article->branch : request()->query('branch', 'all'));
                    @endphp
                    <a href="{{ url('/aktualnosci?branch=all') }}" class="desktop-nav-link transition-all {{ $activeBranch === 'all' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary nav-underline' }}">Wszystkie</a>
                    <a href="{{ url('/aktualnosci?branch=resort') }}" class="desktop-nav-link transition-all {{ $activeBranch === 'resort' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary nav-underline' }}">Ośrodek</a>
                    <a href="{{ url('/aktualnosci?branch=jarmark') }}" class="desktop-nav-link transition-all {{ $activeBranch === 'jarmark' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary nav-underline' }}">Jarmark CEH</a>
                    <a href="{{ url('/aktualnosci?branch=farm') }}" class="desktop-nav-link transition-all {{ $activeBranch === 'farm' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary nav-underline' }}">Gospodarstwo</a>
                @endif

                @if($isOsrodek)
                    <a href="#pokoje" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Pokoje</a>
                    <a href="#galeria" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Galeria</a>
                    <a href="#atrakcje" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Atrakcje</a>
                    <a href="{{ url('/aktualnosci?branch=resort') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Aktualności</a>
                    <a href="#faq" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">FAQ</a>
                    <a href="#kontakt" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Kontakt</a>
                @endif

                @if($isJarmark)
                    <a href="#menu" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Menu Kawiarni</a>
                    <a href="#atrakcje-jarmark" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Atrakcje</a>
                    <a href="{{ url('/aktualnosci?branch=jarmark') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Aktualności</a>
                    <a href="#kontakt" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Kontakt</a>
                @endif

                @if($isGospodarstwo)
                    <a href="#produkty" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Oferta Produktów</a>
                    <a href="{{ url('/aktualnosci?branch=farm') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Aktualności</a>
                    <a href="#kontakt" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Kontakt</a>
                @endif

                @if(!$isOsrodek && !$isJarmark && !$isGospodarstwo && !$isAktualnosci)
                    <a href="{{ url('/osrodek#pokoje') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Pokoje</a>
                    <a href="{{ url('/osrodek#atrakcje') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Atrakcje</a>
                    <a href="{{ url('/osrodek#faq') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">FAQ</a>
                    <a href="#kontakt" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline transition-all">Kontakt</a>
                @endif
            </div>
            
            <!-- Phone Call Button (Desktop) -->
            <div class="flex items-center gap-4">
                <a href="tel:+48608103119" class="hidden md:flex bg-accent text-white font-bold py-2.5 px-6 rounded hover:bg-opacity-90 hover:shadow-md btn-animate items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2">
                    <span class="material-symbols-outlined text-[18px]">call</span>
                    {{ $callBtnLabel }}
                </a>
                
                <!-- Hamburger Button (Mobile) -->
                <button id="mobile-menu-btn" class="lg:hidden p-2 text-primary hover:bg-surface-dim/40 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-primary" aria-label="Otwórz menu" aria-expanded="false" aria-controls="mobile-menu">
                    <span class="material-symbols-outlined text-3xl">menu</span>
                </button>
            </div>
        </div>
        
        <!-- Mobile Dropdown Menu -->
        <div id="mobile-menu" class="lg:hidden bg-background border-t border-primary/10 absolute w-full pointer-events-none opacity-0 -translate-y-2 transition-all duration-300 ease-out z-30">
            <div class="flex flex-col px-6 py-5 space-y-2 shadow-lg text-sm">
                <a href="{{ url('/') }}" class="font-bold text-primary flex items-center gap-2 min-h-[48px] py-2 border-b border-primary/10">
                    <span class="material-symbols-outlined text-base">apps</span>
                    Wybór Działalności
                </a>
                @if($isAktualnosci)
                    @php
                        $activeBranch = $currentBranch ?? (isset($article) ? $article->branch : request()->query('branch', 'all'));
                    @endphp
                    <a href="{{ url('/aktualnosci?branch=all') }}" class="mobile-link font-medium min-h-[48px] flex items-center py-3 {{ $activeBranch === 'all' ? 'text-primary font-bold border-l-4 border-primary pl-2 bg-primary/5 rounded-r' : 'text-on-surface-variant hover:text-primary' }}">Wszystkie Aktualności</a>
                    <a href="{{ url('/aktualnosci?branch=resort') }}" class="mobile-link font-medium min-h-[48px] flex items-center py-3 {{ $activeBranch === 'resort' ? 'text-primary font-bold border-l-4 border-primary pl-2 bg-primary/5 rounded-r' : 'text-on-surface-variant hover:text-primary' }}">Ośrodek Wypoczynkowy</a>
                    <a href="{{ url('/aktualnosci?branch=jarmark') }}" class="mobile-link font-medium min-h-[48px] flex items-center py-3 {{ $activeBranch === 'jarmark' ? 'text-primary font-bold border-l-4 border-primary pl-2 bg-primary/5 rounded-r' : 'text-on-surface-variant hover:text-primary' }}">Jarmark Centrum Edukacyjno-Handlowe</a>
                    <a href="{{ url('/aktualnosci?branch=farm') }}" class="mobile-link font-medium min-h-[48px] flex items-center py-3 {{ $activeBranch === 'farm' ? 'text-primary font-bold border-l-4 border-primary pl-2 bg-primary/5 rounded-r' : 'text-on-surface-variant hover:text-primary' }}">Gospodarstwo Ogrodniczo-Pszczelarskie</a>
                @endif
                @if($isOsrodek)
                    <a href="#pokoje" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Pokoje i Domki</a>
                    <a href="#galeria" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Galeria Zdjęć</a>
                    <a href="#atrakcje" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Atrakcje</a>
                    <a href="{{ url('/aktualnosci?branch=resort') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Aktualności</a>
                    <a href="#faq" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">FAQ</a>
                    <a href="#kontakt" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Kontakt</a>
                @endif
                @if($isJarmark)
                    <a href="#menu" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Menu Kawiarni</a>
                    <a href="#atrakcje-jarmark" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Atrakcje</a>
                    <a href="{{ url('/aktualnosci?branch=jarmark') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Aktualności</a>
                    <a href="#kontakt" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Kontakt</a>
                @endif
                @if($isGospodarstwo)
                    <a href="#produkty" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Oferta Produktów</a>
                    <a href="{{ url('/aktualnosci?branch=farm') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Aktualności</a>
                    <a href="#kontakt" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Kontakt</a>
                @endif
                @if(!$isOsrodek && !$isJarmark && !$isGospodarstwo && !$isAktualnosci)
                    <a href="{{ url('/osrodek#pokoje') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Pokoje</a>
                    <a href="{{ url('/osrodek#atrakcje') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Atrakcje</a>
                    <a href="{{ url('/osrodek#faq') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">FAQ</a>
                    <a href="#kontakt" class="mobile-link text-on-surface-variant font-medium hover:text-primary min-h-[48px] flex items-center py-3">Kontakt</a>
                @endif
                <a href="tel:+48608103119" class="border border-accent text-accent text-center font-bold min-h-[48px] py-3 rounded hover:bg-accent hover:text-white btn-animate flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">call</span>
                    {{ $mobileCallBtnLabel }}
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="kontakt" class="bg-tertiary text-surface-dim w-full py-16 px-gutter border-t border-surface-dim/10">
        <div class="max-w-container-max mx-auto grid grid-cols-1 md:grid-cols-4 gap-gutter mb-12">
            <!-- Col 1: About -->
            <div class="space-y-4">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 group focus:outline-none focus:ring-2 focus:ring-white/20 rounded" aria-label="MIRiOLA - Strona główna">
                    <img src="{{ asset('favicon.webp') }}" alt="MIRiOLA Logo" width="48" height="48" class="h-10 sm:h-12 w-auto object-contain group-hover:scale-105 transition-transform shrink-0">
                    <div class="flex flex-col">
                        <span class="font-display text-2xl font-bold text-white tracking-wider leading-none">MIRiOLA</span>
                        <span class="text-[10px] uppercase tracking-widest text-surface-dim/70 font-semibold mt-1">Dolina Skawy</span>
                    </div>
                </a>
                <p class="text-sm text-surface-dim/90 leading-relaxed">
                    Twój przytulny przystanek na odpoczynek w malowniczej dolinie Skawy. Oferujemy gościnność, wysoki komfort i relaks blisko natury.
                </p>
            </div>
            
            <!-- Col 2: Contact -->
            <div class="space-y-4">
                <h3 class="text-white font-bold text-base uppercase tracking-wider">Kontakt</h3>
                <address class="not-italic text-sm text-surface-dim/80 space-y-3">
                    <p class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[18px] text-accent/80">location_on</span>
                        @if($isJarmark)
                            <span>ul. Zakopiańska 194,<br>34-100 Gorzeń Górny (k. Wadowic)</span>
                        @else
                            <span>ul. Zakopiańska 192,<br>34-100 Gorzeń Górny (k. Wadowic)</span>
                        @endif
                    </p>
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[18px] text-accent/80 shrink-0 mt-0.5">phone</span>
                        <div class="flex flex-col space-y-1">
                            <a href="tel:{{ !empty($cms['phone_number']) ? preg_replace('/\s+/', '', $cms['phone_number']) : '+48608103119' }}" class="hover:text-white transition-colors font-medium whitespace-nowrap">{{ $cms['phone_number'] ?? '+48 608 103 119' }}</a>
                            <a href="tel:{{ !empty($cms['phone_number_2']) ? preg_replace('/\s+/', '', $cms['phone_number_2']) : '+48696312574' }}" class="hover:text-white transition-colors font-medium whitespace-nowrap">{{ $cms['phone_number_2'] ?? '+48 696 312 574' }}</a>
                        </div>
                    </div>
                    <p class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-accent/80 shrink-0">mail</span>
                        <a href="mailto:{{ $cms['email_address'] ?? 'miroslawzadora@wp.pl' }}" class="hover:text-white transition-colors">{{ $cms['email_address'] ?? 'miroslawzadora@wp.pl' }}</a>
                    </p>
                </address>
            </div>
            
            <!-- Col 3: Map -->
            <div class="space-y-4">
                <a href="{{ $isJarmark ? 'https://www.google.com/maps/place/Jarmark+MIRiOLA+-+kawiarnia/@49.8438701,19.5107151,15z/data=!4m15!1m8!3m7!1s0x471687976afca075:0xd535241c323ecd0d!2zWmFrb3BpYcWEc2thIDE5MiwgMzQtMTAwIEdvcnplxYQgR8Ozcm55!3b1!8m2!3d49.8468904!4d19.5040928!16s%2Fg%2F11vyvtn3vc!3m5!1s0x47168898a8d2152b:0x58799b18ef33e6e!8m2!3d49.8438701!4d19.5107151!16s%2Fg%2F11xcj9yg52' : 'https://www.google.com/maps/place/O%C5%9Brodek+wypoczynkowy+MIRiOLA/@49.847133,19.504093,15z/data=!4m9!3m8!1s0x4716862dadd6ee87:0xbdb92fc80693a9ef!8m2!3d49.847133!4d19.504093!16s%2Fg%2F11b6q_6n7s' }}" 
                   target="_blank" rel="noopener noreferrer" 
                   class="group flex items-center justify-between text-white font-bold text-base uppercase tracking-wider hover:text-amber-200 transition-colors">
                    <span>{{ $isJarmark ? 'Mapa dojazdu do Jarmarku' : 'Mapa dojazdu' }}</span>
                    <span class="material-symbols-outlined text-sm opacity-60 group-hover:opacity-100 group-hover:translate-x-0.5 transition-all">open_in_new</span>
                </a>
                <div class="w-full h-52 bg-surface-dim/10 rounded-xl overflow-hidden border border-white/20 relative shadow-md">
                    @if($isJarmark)
                        <iframe title="Mapa dojazdu do Jarmark MIRiOLA - kawiarnia" class="w-full h-full border-0 transition-all duration-300" 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2576.223019864239!2d19.50814017734139!3d49.843870094970425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47168898a8d2152b%3A0x58799b18ef33e6e!2sJarmark%20MIRiOLA%20-%20kawiarnia!5e0!3m2!1spl!2spl!4v1723053000000!5m2!1spl!2spl" 
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @else
                        <iframe title="Mapa dojazdu do Ośrodka wypoczynkowego MIRiOLA w Gorzeniu Górnym" class="w-full h-full border-0 transition-all duration-300" 
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10291.00463901209!2d19.501518!3d49.847133!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4716862dadd6ee87%3A0xbdb92fc80088f865!2sO%C5%9Brodek%20wypoczynkowy%20MIRiOLA!5e0!3m2!1spl!2spl!4v1786125948764!5m2!1spl!2spl" 
                                allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    @endif
                </div>
            </div>
            
            <!-- Col 4: Links -->
            <div class="space-y-4">
                <h3 class="text-white font-bold text-base uppercase tracking-wider">Przydatne linki</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a class="text-surface-dim/80 hover:text-white transition-colors" href="{{ url('/polityka-prywatnosci') }}">Polityka Prywatności</a></li>
                    <li class="pt-2 flex items-center gap-2.5">
                        <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" onclick="this.blur()" aria-label="Profil MIRiOLA na Facebooku" title="Facebook MIRiOLA" class="w-9 h-9 rounded-xl bg-[#1877F2]/20 hover:bg-[#1877F2] text-white flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-[0_4px_12px_rgba(24,119,242,0.4)] focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="{{ $olxUrl }}" target="_blank" rel="noopener noreferrer" onclick="this.blur()" aria-label="Ogłoszenia MIRiOLA na serwisie OLX" title="Ogłoszenia OLX" class="w-9 h-9 rounded-xl bg-white/15 hover:bg-white text-white hover:text-[#002f34] flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-[0_4px_12px_rgba(255,255,255,0.35)] focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M20 4H4v2h16V4zm1 10v-2l-1-5H4l-1 5v2h1v6h10v-6h4v6h2v-6h1zm-9 6H6v-4h6v4z"/>
                            </svg>
                        </a>
                        <a href="{{ $cms['instagram_url'] ?? 'https://www.instagram.com/miroslawzadora/' }}" target="_blank" rel="noopener noreferrer" onclick="this.blur()" aria-label="Profil MIRiOLA na Instagramie" title="Instagram MIRiOLA" class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#f09433] via-[#dc2743] to-[#bc1888] text-white flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-[0_4px_12px_rgba(220,39,67,0.4)] focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        @if(!empty($cms['tiktok_url']))
                        <a href="{{ $cms['tiktok_url'] }}" target="_blank" rel="noopener noreferrer" onclick="this.blur()" aria-label="Profil MIRiOLA na TikToku" title="TikTok MIRiOLA" class="w-9 h-9 rounded-xl bg-white/15 hover:bg-black text-white flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-[0_4px_12px_rgba(0,0,0,0.5)] focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1.04-.1z"/>
                            </svg>
                        </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom border & Copyright -->
        <div class="max-w-container-max mx-auto border-t border-surface-dim/10 pt-8 text-center text-xs text-surface-dim/60 font-medium">
            <p>&copy; <span id="current-year"></span> Ośrodek Wypoczynkowy MIRiOLA. Wszelkie prawa zastrzeżone.</p>
        </div>
    </footer>

    <!-- Availability Bar (Floating Call Button for Mobile) -->
    <div class="fixed bottom-0 left-0 w-full bg-background border-t border-primary/10 shadow-[0_-4px_10px_rgba(0,30,64,0.06)] py-3 px-gutter z-40 md:hidden">
        <a href="tel:+48608103119" class="w-full bg-accent text-white font-bold py-3 rounded-lg flex items-center justify-center gap-2 hover:shadow-lg btn-animate focus:outline-none focus-visible:ring-2 focus-visible:ring-accent">
            <span class="material-symbols-outlined text-[20px]">call</span>
            {{ $mobileCallBtnLabel }}
        </a>
    </div>

    <!-- Scroll to Top Button (Strzałka w górę) -->
    <button id="scroll-top-btn" 
            class="fixed bottom-20 md:bottom-8 right-6 md:right-8 w-12 h-12 rounded-full bg-primary text-white border border-white/20 shadow-2xl z-50 flex items-center justify-center opacity-0 pointer-events-none translate-y-4 transition-all duration-300 hover:scale-110 hover:bg-accent focus:outline-none focus-visible:ring-2 focus-visible:ring-accent" 
            aria-label="Przewiń do góry">
        <span class="material-symbols-outlined text-2xl">arrow_upward</span>
    </button>

    <!-- Cookie Consent Banner — odsuniery od bottom bar na mobile (bottom-20) -->
    <div id="cookie-banner" class="fixed bottom-20 md:bottom-6 right-4 left-4 md:left-auto md:max-w-md bg-white border border-outline-variant shadow-2xl rounded-xl p-5 z-50 transform translate-y-24 opacity-0 transition-all duration-500 ease-out hidden" role="dialog" aria-labelledby="cookie-title" aria-describedby="cookie-desc">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0">
                <span class="material-symbols-outlined text-[22px]">cookie</span>
            </div>
            <div class="space-y-2">
                <h3 id="cookie-title" class="font-bold text-primary font-display text-base">Dbamy o Twoją prywatność</h3>
                <p id="cookie-desc" class="text-xs text-on-surface-variant leading-relaxed">
                    Strona Ośrodka MIRiOLA wykorzystuje pliki cookie w celach funkcjonalnych i statystycznych. Szczegółowe informacje znajdziesz w naszej <a href="{{ url('/polityka-prywatnosci') }}" class="text-primary font-semibold hover:underline">Polityce Prywatności</a>.
                </p>
                <div class="flex justify-end gap-2 pt-2 flex-wrap">
                    <button id="reject-cookies" class="text-on-surface-variant font-semibold text-xs px-4 py-2 rounded border border-outline-variant hover:border-primary hover:text-primary transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Tylko niezbędne
                    </button>
                    <button id="accept-cookies" class="bg-primary text-white font-bold text-xs px-5 py-2 rounded hover:bg-opacity-95 hover:shadow-sm btn-animate focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Akceptuję wszystkie
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- AOS Script & General Page Interactions -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Reset scroll to top and clear hash on page reload/refresh
        if (window.performance && window.performance.getEntriesByType("navigation").length > 0) {
            const navType = window.performance.getEntriesByType("navigation")[0].type;
            if (navType === "reload") {
                if (history.scrollRestoration) {
                    history.scrollRestoration = 'manual';
                }
                window.scrollTo(0, 0);
                if (window.location.hash) {
                    history.replaceState("", document.title, window.location.pathname + window.location.search);
                }
            }
        }

        // Initialize Animations
        AOS.init({
            disable: () => window.matchMedia('(prefers-reduced-motion: reduce)').matches,
            once: true,
            offset: 50,
            duration: 400
        });

        // Set Current Year
        document.getElementById('current-year').textContent = new Date().getFullYear();

        // Scroll-to-Top Button Handler (Strzałka w górę)
        const scrollTopBtn = document.getElementById('scroll-top-btn');
        if (scrollTopBtn) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 250) {
                    scrollTopBtn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
                    scrollTopBtn.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
                } else {
                    scrollTopBtn.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                    scrollTopBtn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
                }
            });
            scrollTopBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // Hamburger Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileLinks = document.querySelectorAll('.mobile-link');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                const isOpen = mobileMenu.classList.contains('opacity-100');
                const icon = mobileMenuBtn.querySelector('span');
                if (isOpen) {
                    mobileMenu.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                    mobileMenu.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
                    icon.textContent = 'menu';
                } else {
                    mobileMenu.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-2');
                    mobileMenu.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
                    icon.textContent = 'close';
                }
            });
            
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                    mobileMenu.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
                    mobileMenuBtn.querySelector('span').textContent = 'menu';
                });
            });
        }

        // Scrollspy Navigation Highlights (Active Section Indicator for all subpages)
        const navSections = document.querySelectorAll('section[id], footer[id]');
        const desktopLinks = document.querySelectorAll('.desktop-nav-link');
        const mobileNavLinks = document.querySelectorAll('.mobile-link');

        if (navSections.length > 0 && (desktopLinks.length > 0 || mobileNavLinks.length > 0)) {
            const activeDesktopClasses = ['text-primary', 'font-bold', 'border-b-2', 'border-primary', 'pb-1'];
            const inactiveDesktopClasses = ['text-on-surface-variant', 'hover:text-primary'];
            
            const activeMobileClasses = ['text-primary', 'font-bold', 'border-l-4', 'border-primary', 'pl-2'];
            const inactiveMobileClasses = ['text-on-surface-variant'];

            function updateScrollspy() {
                let currentSection = 'start';
                const scrollPos = window.scrollY;
                
                navSections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (scrollPos >= sectionTop - 180) {
                        currentSection = section.getAttribute('id');
                    }
                });

                if ((window.innerHeight + scrollPos) >= document.body.offsetHeight - 40) {
                    currentSection = 'kontakt';
                }

                desktopLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    if (!href || !href.startsWith('#')) return;
                    link.classList.remove(...activeDesktopClasses, 'font-semibold');
                    link.classList.add(...inactiveDesktopClasses);
                    
                    if (href === `#${currentSection}`) {
                        link.classList.remove(...inactiveDesktopClasses);
                        link.classList.add(...activeDesktopClasses);
                    }
                });

                mobileNavLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    if (!href || !href.startsWith('#')) return;
                    link.classList.remove(...activeMobileClasses, ...inactiveMobileClasses);
                    
                    if (href === `#${currentSection}`) {
                        link.classList.add(...activeMobileClasses);
                    } else {
                        link.classList.add(...inactiveMobileClasses);
                    }
                });
            }

            window.addEventListener('scroll', updateScrollspy);
            window.addEventListener('load', updateScrollspy);
            updateScrollspy();
        }

        // Cookie Consent Handler
        document.addEventListener('DOMContentLoaded', () => {
            const cookieBanner = document.getElementById('cookie-banner');
            const acceptButton = document.getElementById('accept-cookies');
            const rejectButton = document.getElementById('reject-cookies');
            
            function dismissBanner(value) {
                localStorage.setItem('cookie_consent_miriola', value);
                cookieBanner.classList.add('translate-y-24', 'opacity-0');
                setTimeout(() => {
                    cookieBanner.classList.add('hidden');
                }, 500);
            }

            if (cookieBanner && acceptButton) {
                if (!localStorage.getItem('cookie_consent_miriola')) {
                    cookieBanner.classList.remove('hidden');
                    setTimeout(() => {
                        cookieBanner.classList.remove('translate-y-24', 'opacity-0');
                    }, 200);
                }
                
                acceptButton.addEventListener('click', () => dismissBanner('accepted'));
                if (rejectButton) {
                    rejectButton.addEventListener('click', () => dismissBanner('essential_only'));
                }
            }
        });

        // Universal FAQ Accordion logic
        window.toggleFaq = function(button) {
            const currentItem = button.closest('.faq-item');
            if (!currentItem) return;
            const content = currentItem.querySelector('.faq-content');
            const icon = currentItem.querySelector('.faq-icon');
            
            const isOpen = content && content.classList.contains('grid-rows-[1fr]');
            
            document.querySelectorAll('.faq-item').forEach(item => {
                const itemContent = item.querySelector('.faq-content');
                const itemIcon = item.querySelector('.faq-icon');
                if (itemContent) {
                    itemContent.classList.remove('grid-rows-[1fr]');
                    itemContent.classList.add('grid-rows-[0fr]');
                }
                if (itemIcon) {
                    itemIcon.classList.remove('rotate-180');
                }
                item.classList.remove('bg-primary/[0.03]');
            });
            
            if (!isOpen && content) {
                content.classList.remove('grid-rows-[0fr]');
                content.classList.add('grid-rows-[1fr]');
                if (icon) icon.classList.add('rotate-180');
                currentItem.classList.add('bg-primary/[0.03]');
            }
        };
    </script>

    @yield('scripts')
</body>
</html>

