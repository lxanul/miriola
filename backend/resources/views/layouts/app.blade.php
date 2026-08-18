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
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Open Graph / Social Media SEO -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Ośrodek Wypoczynkowy MIRiOLA - Dolina Skawy, Noclegi blisko Wadowic')">
    <meta property="og:description" content="@yield('meta_description', 'Zapraszamy do Ośrodka Wypoczynkowego MIRiOLA w dolinie Skawy. Oferujemy komfortowe pokoje, apartamenty i domki letniskowe blisko Wadowic i Jeziora Mucharskiego.')">
    <meta property="og:image" content="{{ asset('assets/img/hero.jpg') }}">
    <meta property="og:locale" content="pl_PL">
    <meta property="og:site_name" content="MIRiOLA">

    <!-- Twitter Card SEO -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Ośrodek Wypoczynkowy MIRiOLA - Dolina Skawy')">
    <meta name="twitter:description" content="@yield('meta_description', 'Komfortowe noclegi, Jarmark i Kawiarnia oraz Gospodarstwo Rolne w Dolinie Skawy.')">
    <meta name="twitter:image" content="{{ asset('assets/img/hero.jpg') }}">

    <!-- Schema.org JSON-LD Structured Data for LocalBusiness & Lodging -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Resort",
      "name": "Ośrodek Wypoczynkowy MIRiOLA",
      "image": "{{ asset('assets/img/hero.jpg') }}",
      "@@id": "{{ url('/') }}",
      "url": "{{ url('/') }}",
      "telephone": "+48608103119",
      "email": "miroslawzadora@wp.pl",
      "priceRange": "250 zł - 450 zł",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "ul. Zakopiańska 192",
        "addressLocality": "Wadowice",
        "postalCode": "34-100",
        "addressCountry": "PL"
      },
      "geo": {
        "@@type": "GeoCoordinates",
        "latitude": 49.8833,
        "longitude": 19.4833
      },
      "openingHoursSpecification": {
        "@@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        "opens": "00:00",
        "closes": "23:59"
      }
    }
    </script>
    
    <!-- Fonts & Icons Optimization -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com" crossorigin>
    <link rel="dns-prefetch" href="https://images.unsplash.com">
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&family=Work+Sans:wght@400;500;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- AOS Animations CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
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
                <img src="{{ asset('images/logo.png') }}" alt="MIRiOLA Logo" class="h-10 sm:h-12 w-auto object-contain group-hover:scale-105 transition-transform">
                <div class="flex flex-col">
                    <span class="font-display text-lg sm:text-xl font-bold text-primary tracking-wide leading-none">MIRiOLA</span>
                    <span class="text-[9px] sm:text-[10px] uppercase tracking-widest text-primary/70 font-bold mt-1">Dolina Skawy</span>
                </div>
            </a>
            
            @php
                $isOsrodek = Request::is('osrodek');
                $isJarmark = Request::is('jarmark');
                $isGospodarstwo = Request::is('gospodarstwo');
                $isAktualnosci = Request::is('aktualnosci');

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
                    <a href="{{ url('/osrodek') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Ośrodek</a>
                    <a href="{{ url('/jarmark') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Jarmark CEH</a>
                    <a href="{{ url('/gospodarstwo') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Gospodarstwo Ogrodniczo-Pszczelarskie</a>
                    <a href="{{ url('/aktualnosci') }}" class="desktop-nav-link text-primary font-bold border-b-2 border-primary pb-1 transition-all">Aktualności</a>
                @endif

                @if($isOsrodek)
                    <a href="#pokoje" class="desktop-nav-link text-primary font-semibold nav-underline pb-1 transition-all">Pokoje</a>
                    <a href="#galeria" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Galeria</a>
                    <a href="#atrakcje" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Atrakcje</a>
                    <a href="{{ url('/aktualnosci?branch=resort') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Aktualności</a>
                    <a href="#faq" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">FAQ</a>
                    <a href="#kontakt" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Kontakt</a>
                @endif

                @if($isJarmark)
                    <a href="#menu" class="desktop-nav-link text-primary font-semibold nav-underline pb-1 transition-all">Menu Kawiarni</a>
                    <a href="#atrakcje-jarmark" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Atrakcje</a>
                    <a href="{{ url('/aktualnosci?branch=jarmark') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Aktualności</a>
                    <a href="#kontakt" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Kontakt</a>
                @endif

                @if($isGospodarstwo)
                    <a href="#produkty" class="desktop-nav-link text-primary font-semibold nav-underline pb-1 transition-all">Oferta Produktów</a>
                    <a href="#kontakt" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Kontakt</a>
                @endif

                @if(!$isOsrodek && !$isJarmark && !$isGospodarstwo && !$isAktualnosci)
                    <a href="{{ url('/osrodek#pokoje') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Pokoje</a>
                    <a href="{{ url('/osrodek#atrakcje') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Atrakcje</a>
                    <a href="{{ url('/osrodek#faq') }}" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">FAQ</a>
                    <a href="#kontakt" class="desktop-nav-link text-on-surface-variant hover:text-primary nav-underline pb-1 transition-all">Kontakt</a>
                @endif
            </div>
            
            <!-- Phone Call Button (Desktop) -->
            <div class="flex items-center gap-4">
                <a href="tel:+48608103119" class="hidden md:flex bg-accent text-white font-bold py-2.5 px-6 rounded hover:bg-opacity-90 hover:shadow-md btn-animate items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2">
                    <span class="material-symbols-outlined text-[18px]">call</span>
                    {{ $callBtnLabel }}
                </a>
                
                <!-- Hamburger Button (Mobile) -->
                <button id="mobile-menu-btn" class="md:hidden p-2 text-primary hover:bg-surface-dim/40 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-primary" aria-label="Otwórz menu">
                    <span class="material-symbols-outlined text-3xl">menu</span>
                </button>
            </div>
        </div>
        
        <!-- Mobile Dropdown Menu -->
        <div id="mobile-menu" class="lg:hidden bg-background border-t border-primary/10 absolute w-full pointer-events-none opacity-0 -translate-y-2 transition-all duration-300 ease-out z-30">
            <div class="flex flex-col px-6 py-5 space-y-4 shadow-lg text-sm">
                <a href="{{ url('/') }}" class="font-bold text-primary flex items-center gap-2 py-1 border-b border-primary/10">
                    <span class="material-symbols-outlined text-base">apps</span>
                    Wybór Działalności
                </a>
                @if($isAktualnosci)
                    <a href="{{ url('/osrodek') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Ośrodek Wypoczynkowy</a>
                    <a href="{{ url('/jarmark') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Jarmark Centrum Edukacyjno-Handlowe</a>
                    <a href="{{ url('/gospodarstwo') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Gospodarstwo Ogrodniczo-Pszczelarskie</a>
                    <a href="{{ url('/aktualnosci') }}" class="mobile-link text-primary font-bold py-1">Aktualności</a>
                @endif
                @if($isOsrodek)
                    <a href="#pokoje" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Pokoje i Domki</a>
                    <a href="#galeria" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Galeria Zdjęć</a>
                    <a href="#atrakcje" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Atrakcje</a>
                    <a href="{{ url('/aktualnosci?branch=resort') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Aktualności</a>
                    <a href="#faq" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">FAQ</a>
                    <a href="#kontakt" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Kontakt</a>
                @endif
                @if($isJarmark)
                    <a href="#menu" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Menu Kawiarni</a>
                    <a href="#atrakcje-jarmark" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Atrakcje</a>
                    <a href="{{ url('/aktualnosci?branch=jarmark') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Aktualności</a>
                    <a href="#kontakt" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Kontakt</a>
                @endif
                @if($isGospodarstwo)
                    <a href="#produkty" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Oferta Produktów</a>
                    <a href="#kontakt" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Kontakt</a>
                @endif
                @if(!$isOsrodek && !$isJarmark && !$isGospodarstwo && !$isAktualnosci)
                    <a href="{{ url('/osrodek#pokoje') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Pokoje</a>
                    <a href="{{ url('/osrodek#atrakcje') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Atrakcje</a>
                    <a href="{{ url('/osrodek#faq') }}" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">FAQ</a>
                    <a href="#kontakt" class="mobile-link text-on-surface-variant font-medium hover:text-primary py-1">Kontakt</a>
                @endif
                <a href="tel:+48608103119" class="border border-accent text-accent text-center font-bold py-2.5 rounded hover:bg-accent hover:text-white btn-animate flex items-center justify-center gap-2">
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
                    <img src="{{ asset('favicon.png') }}" alt="MIRiOLA Logo" class="h-10 sm:h-12 w-auto object-contain group-hover:scale-105 transition-transform shrink-0">
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
                    <p class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-accent/80">phone</span>
                        <a href="tel:{{ $cms['phone_number'] ?? '+48608103119' }}" class="hover:text-white transition-colors font-medium whitespace-nowrap">{{ $cms['phone_number'] ?? '+48 608 103 119' }}</a>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-accent/80">mail</span>
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
                    <li class="pt-2 flex flex-wrap items-center gap-3">
                        <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" onclick="this.blur()" aria-label="Profil MIRiOLA na Facebooku" class="bg-[#1877F2]/20 text-white hover:bg-[#1877F2] text-xs font-bold px-3.5 py-1.5 rounded flex items-center gap-1.5 transition-all focus:outline-none">
                            <span>Facebook</span>
                        </a>
                        <a href="{{ $olxUrl }}" target="_blank" rel="noopener noreferrer" onclick="this.blur()" aria-label="Ogłoszenia MIRiOLA na serwisie OLX" class="bg-white/20 text-white hover:bg-white hover:text-primary text-xs font-bold px-3.5 py-1.5 rounded flex items-center gap-1.5 transition-all focus:outline-none">
                            <span>OLX</span>
                        </a>
                        <a href="{{ $cms['instagram_url'] ?? 'https://www.instagram.com/miroslawzadora/' }}" target="_blank" rel="noopener noreferrer" onclick="this.blur()" aria-label="Profil MIRiOLA na Instagramie" class="bg-gradient-to-tr from-[#f09433] via-[#dc2743] to-[#bc1888] text-white text-xs font-bold px-3.5 py-1.5 rounded flex items-center gap-1.5 transition-all hover:opacity-90 focus:outline-none">
                            <span>Instagram</span>
                        </a>
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
        <a href="tel:+48608103119" class="w-full bg-accent text-white font-bold py-3 rounded-lg flex items-center justify-center gap-2 hover:shadow-lg btn-animate">
            <span class="material-symbols-outlined text-[20px]">call</span>
            {{ $mobileCallBtnLabel }}
        </a>
    </div>

    <!-- Scroll to Top Button (Strzałka w górę) -->
    <button id="scroll-top-btn" 
            class="fixed bottom-20 md:bottom-8 right-6 md:right-8 w-12 h-12 rounded-full bg-primary text-white border border-white/20 shadow-2xl z-50 flex items-center justify-center opacity-0 pointer-events-none translate-y-4 transition-all duration-300 hover:scale-110 hover:bg-accent focus:outline-none" 
            aria-label="Przewiń do góry">
        <span class="material-symbols-outlined text-2xl">arrow_upward</span>
    </button>

    <!-- Cookie Consent Banner -->
    <div id="cookie-banner" class="fixed bottom-6 right-6 left-6 md:left-auto md:max-w-md bg-white border border-outline-variant shadow-2xl rounded-xl p-6 z-50 transform translate-y-24 opacity-0 transition-all duration-500 ease-out hidden" role="dialog" aria-labelledby="cookie-title" aria-describedby="cookie-desc">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0">
                <span class="material-symbols-outlined text-[22px]">cookie</span>
            </div>
            <div class="space-y-2">
                <h3 id="cookie-title" class="font-bold text-primary font-display text-base">Dbamy o Twoją prywatność</h3>
                <p id="cookie-desc" class="text-xs text-on-surface-variant leading-relaxed">
                    Strona Ośrodka MIRiOLA wykorzystuje pliki cookie w celach funkcjonalnych i statystycznych. Szczegółowe informacje znajdziesz w naszej <a href="{{ url('/polityka-prywatnosci') }}" class="text-primary font-semibold hover:underline">Polityce Prywatności</a>.
                </p>
                <div class="flex justify-end gap-3 pt-2">
                    <button id="accept-cookies" class="bg-primary text-white font-bold text-xs px-5 py-2 rounded hover:bg-opacity-95 hover:shadow-sm btn-animate focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Akceptuję
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
                    if (!href) return;
                    link.classList.remove(...activeDesktopClasses, 'font-semibold');
                    link.classList.add(...inactiveDesktopClasses);
                    
                    if (href === `#${currentSection}` || href.endsWith(`/#${currentSection}`)) {
                        link.classList.remove(...inactiveDesktopClasses);
                        link.classList.add(...activeDesktopClasses);
                    }
                });

                mobileNavLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    if (!href) return;
                    link.classList.remove(...activeMobileClasses, ...inactiveMobileClasses);
                    
                    if (href === `#${currentSection}` || href.endsWith(`/#${currentSection}`)) {
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
            
            if (cookieBanner && acceptButton) {
                if (!localStorage.getItem('cookie_consent_miriola')) {
                    cookieBanner.classList.remove('hidden');
                    setTimeout(() => {
                        cookieBanner.classList.remove('translate-y-24', 'opacity-0');
                    }, 200);
                }
                
                acceptButton.addEventListener('click', () => {
                    localStorage.setItem('cookie_consent_miriola', 'accepted');
                    cookieBanner.classList.add('translate-y-24', 'opacity-0');
                    setTimeout(() => {
                        cookieBanner.classList.add('hidden');
                    }, 500);
                });
            }
        });
    </script>

    @yield('scripts')
</body>
</html>
