<!DOCTYPE html>
<html lang="pl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIRiOLA – Kompleks Wypoczynkowy w Dolinie Skawy koło Wadowic</title>
    <meta name="description" content="Witaj w kompleksie MIRiOLA w dolinie Skawy koło Wadowic. Wybierz Ośrodek Wypoczynkowy, Jarmark z Kawiarnią lub nasze Gospodarstwo Rolne.">
    <meta name="keywords" content="MIRiOLA, Ośrodek Wypoczynkowy Wadowice, Jarmark Kawiarnia, Gospodarstwo Rolne Dolina Skawy, noclegi Wadowice">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Open Graph SEO -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="MIRiOLA – Kompleks Wypoczynkowy w Dolinie Skawy koło Wadowic">
    <meta property="og:description" content="Witaj w kompleksie MIRiOLA w dolinie Skawy koło Wadowic. Wybierz Ośrodek Wypoczynkowy, Jarmark z Kawiarnią lub nasze Gospodarstwo Rolne.">
    <meta property="og:image" content="{{ asset('assets/img/hero.jpg') }}">
    <meta property="og:locale" content="pl_PL">
    <meta property="og:site_name" content="MIRiOLA">

    <!-- Twitter Cards SEO -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="MIRiOLA – Kompleks Wypoczynkowy w Dolinie Skawy koło Wadowic">
    <meta name="twitter:description" content="Noclegi, Kawiarnia Rzemieślnicza oraz Ekologiczne Ogórki i Miody w Dolinie Skawy.">
    <meta name="twitter:image" content="{{ asset('assets/img/hero.jpg') }}">
    
    <!-- Schema.org JSON-LD Structured Data for LocalBusiness & Resort -->
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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,600;0,700;1,400&family=Work+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Material Symbols Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-background text-on-background font-body antialiased min-h-screen flex flex-col justify-between selection:bg-primary selection:text-white">

    <!-- Top Header -->
    <header class="w-full py-3.5 sm:py-5 px-3 sm:px-gutter border-b border-primary/10 bg-surface/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-container-max mx-auto flex justify-between items-center gap-2">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 sm:gap-3 group focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 rounded shrink-0" aria-label="Strona główna">
                <img src="{{ asset('images/logo.png') }}" alt="MIRiOLA Logo" width="180" height="48" class="h-10 sm:h-12 w-auto object-contain group-hover:scale-105 transition-transform">
                <div class="flex flex-col">
                    <span class="font-display text-lg sm:text-xl font-bold text-primary tracking-wide leading-none">MIRiOLA</span>
                    <span class="text-[9px] sm:text-[10px] uppercase tracking-widest text-primary/70 font-bold mt-1">Dolina Skawy</span>
                </div>
            </a>
            <div class="flex items-center gap-1.5 sm:gap-3 shrink-0">
                <!-- Phone Number Badge -->
                <a href="tel:{{ !empty($cms['phone_number']) ? preg_replace('/\s+/', '', $cms['phone_number']) : '+48608103119' }}" 
                   class="hidden lg:inline-flex items-center gap-2 bg-primary/5 hover:bg-primary hover:text-white text-primary border border-primary/15 text-xs font-bold py-2 px-3.5 rounded-xl transition-all duration-300 shadow-xs mr-1 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    <span class="material-symbols-outlined text-base text-accent">call</span>
                    <span>{{ $cms['phone_number'] ?? '+48 608 103 119' }}</span>
                </a>
                
                <!-- FB Link Badge -->
                <a href="{{ $cms['facebook_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                   class="social-badge-btn bg-[#1877F2]/10 hover:bg-[#1877F2] active:bg-[#1877F2] text-[#1877F2] hover:text-white active:text-white border border-[#1877F2]/25 hover:shadow-[0_4px_12px_rgba(24,119,242,0.35)] focus:outline-none focus:ring-2 focus:ring-[#1877F2]"
                   title="Facebook MIRiOLA" aria-label="Facebook MIRiOLA">
                    <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    <span class="social-text">Facebook</span>
                </a>

                <!-- OLX Link Badge -->
                <a href="{{ $cms['olx_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                   class="social-badge-btn bg-[#002f34]/10 hover:bg-[#002f34] active:bg-[#002f34] text-[#002f34] hover:text-white active:text-white border border-[#002f34]/25 hover:shadow-[0_4px_12px_rgba(0,47,52,0.35)] focus:outline-none focus:ring-2 focus:ring-[#002f34]"
                   title="Ogłoszenia OLX MIRiOLA" aria-label="Ogłoszenia OLX MIRiOLA">
                    <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
                        <path d="M20 4H4v2h16V4zm1 10v-2l-1-5H4l-1 5v2h1v6h10v-6h4v6h2v-6h1zm-9 6H6v-4h6v4z"/>
                    </svg>
                    <span class="social-text">OLX</span>
                </a>

                <!-- Instagram Link Badge -->
                <a href="{{ $cms['instagram_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                   class="social-badge-btn bg-[#E1306C]/10 hover:bg-gradient-to-tr hover:from-[#f09433] hover:via-[#dc2743] hover:to-[#bc1888] active:bg-[#E1306C] text-[#E1306C] hover:text-white active:text-white border border-[#E1306C]/25 hover:shadow-[0_4px_12px_rgba(225,48,108,0.35)] focus:outline-none focus:ring-2 focus:ring-[#E1306C]"
                   title="Instagram MIRiOLA" aria-label="Instagram MIRiOLA">
                    <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                    <span class="social-text">Instagram</span>
                </a>

                <!-- TikTok Link Badge -->
                <a href="{{ $cms['tiktok_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                   class="social-badge-btn bg-slate-900/10 hover:bg-slate-900 active:bg-slate-900 text-slate-900 hover:text-white active:text-white border border-slate-900/25 hover:shadow-[0_4px_12px_rgba(15,23,42,0.35)] focus:outline-none focus:ring-2 focus:ring-slate-900"
                   title="TikTok MIRiOLA" aria-label="TikTok MIRiOLA">
                    <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1.04-.1z"/>
                    </svg>
                    <span class="social-text">TikTok</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Hub Selection Grid -->
    <main class="flex-grow py-10 md:py-16 px-gutter max-w-container-max mx-auto w-full flex flex-col justify-center">
        
        <!-- Welcome Hero Text & Clean Central Logo Showcase -->
        <div class="text-center max-w-3xl mx-auto mb-6 md:mb-8 flex flex-col items-center" data-aos="fade-down">
            <span class="inline-flex items-center gap-2 bg-primary/5 text-primary text-xs md:text-sm font-bold px-5 py-2 rounded-full uppercase tracking-widest mb-3 border border-primary/10 shadow-xs">
                <span class="w-2.5 h-2.5 rounded-full bg-accent animate-pulse"></span>
                Witaj w Sercu Doliny Skawy
            </span>

            <h1 class="font-display text-2xl sm:text-3xl md:text-4xl font-bold text-primary tracking-tight mb-4">
                MIRiOLA – Kompleks Wypoczynkowy w Dolinie Skawy koło Wadowic
            </h1>

            <div class="group my-1">
                <img src="{{ asset('images/logo.png') }}" 
                     alt="MIRiOLA - Witaj w Sercu Doliny Skawy" 
                     width="300" height="256" fetchpriority="high"
                     class="h-40 sm:h-56 md:h-64 w-auto object-contain mx-auto group-hover:scale-105 transition-transform duration-500">
            </div>
        </div>

        <!-- 3 Interactive Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch w-full">
            
            <!-- CARD 1: Ośrodek Wypoczynkowy -->
            <a href="{{ url('/osrodek') }}" data-aos="fade-up" data-aos-delay="100" 
               class="group relative bg-surface rounded-2xl overflow-hidden border border-primary/15 ambient-shadow hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between min-h-[460px]">
                
                <!-- Background Image Overlay with Zoom Effect -->
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-110"
                     style="background-image: url('{{ asset('assets/img/hero.webp') }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/35 to-black/10"></div>
                
                <!-- Content Top Badge -->
                <div class="relative z-10 p-6 flex justify-between items-start">
                    <span class="bg-white/20 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-full border border-white/30 shadow-sm">
                        Noclegi & Relaks
                    </span>
                    <span class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white group-hover:bg-accent group-hover:border-accent transition-colors">
                        <span class="material-symbols-outlined">hotel</span>
                    </span>
                </div>

                <!-- Content Bottom Text -->
                <div class="relative z-10 p-6 md:p-8 space-y-4 text-white">
                    <div>
                        <h2 class="font-display text-2xl md:text-3xl font-bold mb-2 group-hover:text-amber-200 transition-colors">
                            Ośrodek Wypoczynkowy
                        </h2>
                        <p class="text-xs md:text-sm text-white/80 leading-relaxed font-light">
                            Komfortowe pokoje, domki letniskowe, 2 sale restauracyjne oraz relaks nad wodą z widokiem na góry.
                        </p>
                    </div>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 pt-2 border-t border-white/15 text-[11px]">
                        <span class="bg-white/10 px-2.5 py-1 rounded">10 Pokoi & Domków</span>
                        <span class="bg-white/10 px-2.5 py-1 rounded">Wynajem 2 Sal Imprezowych</span>
                        <span class="bg-white/10 px-2.5 py-1 rounded">Dolina Skawy</span>
                    </div>

                    <!-- CTA Button inside card -->
                    <div class="pt-3 flex items-center text-xs font-bold text-amber-200 group-hover:translate-x-1 transition-transform">
                        <span>Przejdź do Ośrodka</span>
                        <span class="material-symbols-outlined text-base ml-1">arrow_forward</span>
                    </div>
                </div>
            </a>

            <!-- CARD 2: Jarmark CEH & Kawiarnia -->
            <a href="{{ url('/jarmark') }}" data-aos="fade-up" data-aos-delay="200" 
               class="group relative bg-surface rounded-2xl overflow-hidden border border-primary/15 ambient-shadow hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between min-h-[460px]">
                
                <!-- Background Image Overlay with Zoom Effect -->
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-110"
                     style="background-image: url('{{ asset('assets/img/jarmark-hero.webp') }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/35 to-black/10"></div>
                
                <!-- Content Top Badge -->
                <div class="relative z-10 p-6 flex justify-between items-start">
                    <span class="bg-white/20 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-full border border-white/30 shadow-sm">
                        Kawiarnia & Rzemiosło
                    </span>
                    <span class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white group-hover:bg-accent group-hover:border-accent transition-colors">
                        <span class="material-symbols-outlined">local_cafe</span>
                    </span>
                </div>

                <!-- Content Bottom Text -->
                <div class="relative z-10 p-6 md:p-8 space-y-4 text-white">
                    <div>
                        <h2 class="font-display text-2xl md:text-3xl font-bold mb-2 group-hover:text-amber-200 transition-colors">
                            Jarmark Centrum Edukacyjno-Handlowe
                        </h2>
                        <p class="text-xs md:text-sm text-white/80 leading-relaxed font-light">
                            Kawiarnia rzemieślnicza w ogrodzie ze sferycznym namiotem, leżakami i strefą zabawy dla dzieci.
                        </p>
                    </div>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 pt-2 border-t border-white/15 text-[11px]">
                        <span class="bg-white/10 px-2.5 py-1 rounded">Menu Kawiarni</span>
                        <span class="bg-white/10 px-2.5 py-1 rounded">Domowe Wypieki</span>
                        <span class="bg-white/10 px-2.5 py-1 rounded">Strefa Plenerowa</span>
                    </div>

                    <!-- CTA Button inside card -->
                    <div class="pt-3 flex items-center text-xs font-bold text-amber-200 group-hover:translate-x-1 transition-transform">
                        <span>Odkryj Jarmark CEH</span>
                        <span class="material-symbols-outlined text-base ml-1">arrow_forward</span>
                    </div>
                </div>
            </a>

            <!-- CARD 3: Gospodarstwo Rolne -->
            <a href="{{ url('/gospodarstwo') }}" data-aos="fade-up" data-aos-delay="300" 
               class="group relative bg-surface rounded-2xl overflow-hidden border border-primary/15 ambient-shadow hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between min-h-[460px]">
                
                <!-- Background Image Overlay with Zoom Effect -->
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-110"
                     style="background-image: url('{{ asset('assets/img/gospodarstwo-hero.webp') }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/35 to-black/10"></div>
                
                <!-- Content Top Badge -->
                <div class="relative z-10 p-6 flex justify-between items-start">
                    <span class="bg-white/20 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-full border border-white/30 shadow-sm">
                        Ekologiczne Plony
                    </span>
                    <span class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white group-hover:bg-accent group-hover:border-accent transition-colors">
                        <span class="material-symbols-outlined">eco</span>
                    </span>
                </div>

                <!-- Content Bottom Text -->
                <div class="relative z-10 p-6 md:p-8 space-y-4 text-white">
                    <div>
                        <h2 class="font-display text-2xl md:text-3xl font-bold mb-2 group-hover:text-amber-200 transition-colors">
                            Gospodarstwo Ogrodniczo-Pszczelarskie
                        </h2>
                        <p class="text-xs md:text-sm text-white/80 leading-relaxed font-light">
                            Prosto z naszych pól i pasieki: 3 rodzaje czosnku, świeże borówki oraz naturalne miody z własnego gospodarstwa.
                        </p>
                    </div>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 pt-2 border-t border-white/15 text-[11px]">
                        <span class="bg-white/10 px-2.5 py-1 rounded">3 Rodzaje Czosnku</span>
                        <span class="bg-white/10 px-2.5 py-1 rounded">Świeże Borówki</span>
                        <span class="bg-white/10 px-2.5 py-1 rounded">Naturalne Miody</span>
                    </div>

                    <!-- CTA Button inside card -->
                    <div class="pt-3 flex items-center text-xs font-bold text-amber-200 group-hover:translate-x-1 transition-transform">
                        <span>Zobacz Ofertę Gospodarstwa</span>
                        <span class="material-symbols-outlined text-base ml-1">arrow_forward</span>
                    </div>
                </div>
            </a>

        </div><!-- End 3 Interactive Squares Grid -->

        <!-- Latest News Section under 3 Cards Grid -->
        @if(isset($latestNews) && count($latestNews) > 0)
        <section class="mt-20 pt-16 border-t border-primary/10 w-full" data-aos="fade-up">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="inline-flex items-center gap-2 bg-primary/5 text-primary text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-3 border border-primary/10">
                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                    Co nowego w MIRiOLA
                </span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-primary tracking-tight mb-3">
                    Najnowsze Aktualności & Wydarzenia
                </h2>
                <p class="text-on-surface-variant text-sm leading-relaxed">
                    Bądź na bieżąco z wydarzeniami oraz nowościami w naszym kompleksie.
                </p>
            </div>

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestNews as $item)
                    <article class="bg-white rounded-3xl overflow-hidden border border-slate-200/70 shadow-[0_10px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_45px_rgba(0,30,64,0.12)] hover:-translate-y-2 hover:border-amber-400/40 transition-all duration-500 flex flex-col h-full group relative cursor-pointer" itemscope itemtype="https://schema.org/NewsArticle">
                        <a href="{{ url('/aktualnosci/' . $item->slug) }}" 
                           class="flex flex-col flex-grow justify-between h-full text-left"
                           onclick="event.preventDefault(); openNewsModal({{ $item->id }})"
                           itemprop="url">
                            <div>
                                <!-- News Image / Media Container -->
                                <div class="aspect-[16/10] w-full bg-slate-950 relative overflow-hidden shrink-0" style="aspect-ratio: 16/10;">
                                    <img src="{{ $item->thumbnail_url }}" 
                                         alt="{{ $item->title }}"
                                         width="400" height="250"
                                         loading="lazy" decoding="async"
                                         onerror="this.onerror=null; this.src='{{ asset('assets/img/' . ($item->branch === 'jarmark' ? 'jarmark-hero.webp' : ($item->branch === 'farm' ? 'gospodarstwo-hero.webp' : 'hero.webp'))) }}';"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                         itemprop="image">
                                    
                                    <!-- Gradient Overlay over image for text readability -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/15 to-transparent pointer-events-none"></div>

                                    @if($item->video_url)
                                        <!-- Video Badge in Top Right -->
                                        <span class="absolute top-3.5 right-3.5 bg-amber-500/95 text-slate-950 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full border border-amber-300/40 z-10 flex items-center gap-1.5 shadow-md">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-950"></span>
                                            Wideo
                                        </span>

                                        <!-- Play Button Overlay in Center (Static at rest, smooth hover scale) -->
                                        <div class="absolute inset-0 flex items-center justify-center z-10 pointer-events-none">
                                            <div class="w-14 h-14 rounded-full bg-amber-500/95 text-slate-950 flex items-center justify-center shadow-xl border-2 border-amber-300/80 transform group-hover:scale-115 transition-all duration-300 group-hover:bg-amber-400 group-hover:shadow-2xl">
                                                <span class="material-symbols-outlined text-3xl ml-0.5 transition-transform duration-300 group-hover:scale-105">play_arrow</span>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Category Badge in Top Left -->
                                    <span class="absolute top-3.5 left-3.5 text-[11px] font-bold px-3 py-1 rounded-full shadow-md backdrop-blur-md text-white border border-white/20 z-10 {{ $item->branch === 'resort' ? 'bg-primary/90' : ($item->branch === 'jarmark' ? 'bg-amber-700/90' : ($item->branch === 'farm' ? 'bg-emerald-700/90' : 'bg-slate-800/90')) }}">
                                        {{ $item->branch === 'resort' ? '🏡 Ośrodek' : ($item->branch === 'jarmark' ? '☕ Jarmark' : ($item->branch === 'farm' ? '🌿 Gospodarstwo' : '🌐 MIRiOLA')) }}
                                    </span>
                                </div>

                                <!-- News Content Body -->
                                <div class="p-6 md:p-7 space-y-3">
                                    <div class="flex items-center gap-1.5 text-[11px] text-amber-700 font-bold uppercase tracking-wider">
                                        <span class="material-symbols-outlined text-sm text-amber-600">calendar_month</span>
                                        <time itemprop="datePublished" datetime="{{ $item->published_at?->toIso8601String() }}">
                                            {{ $item->published_at ? $item->published_at->format('d.m.Y') : $item->created_at->format('d.m.Y') }}
                                        </time>
                                    </div>
                                    <h3 itemprop="headline" class="font-display font-bold text-slate-900 text-lg md:text-xl leading-snug group-hover:text-amber-600 transition-colors line-clamp-2 [overflow-wrap:anywhere] break-words">
                                        {{ $item->title }}
                                    </h3>
                                    @if(!empty($item->excerpt) || !empty(strip_tags($item->content)))
                                        <p itemprop="description" class="text-xs md:text-sm text-slate-600 leading-relaxed line-clamp-3 font-normal [overflow-wrap:anywhere] break-words">
                                            {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 120) }}
                                        </p>
                                    @elseif($item->video_url)
                                        <div class="inline-flex items-center gap-1.5 text-xs text-amber-900/90 font-medium bg-amber-50 px-3 py-2 rounded-xl border border-amber-200/60 mt-1">
                                            <span class="material-symbols-outlined text-base text-amber-600">play_circle</span>
                                            <span>Kliknij, aby obejrzeć materiał wideo</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Read More Footer CTA -->
                            <div class="px-6 pb-6 pt-0 mt-auto">
                                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-amber-700 group-hover:text-amber-800 transition-colors">
                                    <span>{{ $item->video_url ? 'Obejrzyj wideo' : 'Czytaj cały artykuł' }}</span>
                                    <span class="w-8 h-8 rounded-full bg-amber-50 group-hover:bg-amber-500 group-hover:text-slate-950 flex items-center justify-center transition-all duration-300 shadow-sm">
                                        <span class="material-symbols-outlined text-base group-hover:translate-x-0.5 transition-transform">{{ $item->video_url ? 'play_circle' : 'arrow_forward' }}</span>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <!-- View All News Button -->
            <div class="mt-10 text-center">
                <a href="{{ url('/aktualnosci') }}" class="inline-flex items-center gap-2 bg-primary text-white font-bold py-3.5 px-8 rounded-xl hover:bg-primary/90 transition-all shadow-md hover:shadow-lg btn-animate text-xs uppercase tracking-wider">
                    <span>Zobacz wszystkie aktualności</span>
                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                </a>
            </div>
        </section>
        @endif

        <!-- Call Notice -->
        <div class="mt-12 text-center px-4" data-aos="fade-up" data-aos-delay="400">
            <p class="text-xs text-on-surface-variant flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-1.5 leading-relaxed">
                <span class="inline-flex items-center gap-1 text-center">
                    <span class="material-symbols-outlined text-base text-accent shrink-0">info</span>
                    <span>Masz pytania lub chcesz dokonać rezerwacji telefonicznej? Zadzwoń:</span>
                </span>
                <span class="inline-flex items-center gap-2">
                    <a href="tel:{{ !empty($cms['phone_number']) ? preg_replace('/\s+/', '', $cms['phone_number']) : '+48608103119' }}" class="font-bold text-primary hover:underline whitespace-nowrap">{{ $cms['phone_number'] ?? '+48 608 103 119' }}</a>
                    <span class="text-slate-400">/</span>
                    <a href="tel:{{ !empty($cms['phone_number_2']) ? preg_replace('/\s+/', '', $cms['phone_number_2']) : '+48696312574' }}" class="font-bold text-primary hover:underline whitespace-nowrap">{{ $cms['phone_number_2'] ?? '+48 696 312 574' }}</a>
                </span>
            </p>
        </div>

    </main>

    <!-- News Article Full-Screen Modal (Nowoczesne okno modalne na stronie głównej) -->
    <div id="hub-news-modal" class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-6 bg-slate-950/75 backdrop-blur-md opacity-0 pointer-events-none invisible transition-all duration-300" onclick="closeHubNewsModal()">
        
        <div id="hub-modal-wrapper" class="relative w-full max-w-2xl flex justify-center items-center my-auto transition-all duration-300 max-h-[92vh]">
            <!-- Modal Card Container (Jednolite okno bez sztucznego wewnętrznego paska przewijania) -->
            <div id="hub-news-modal-card" class="bg-white rounded-3xl w-full max-h-[90vh] overflow-y-auto modal-scrollbar shadow-2xl border border-slate-200/80 relative transform scale-95 transition-all duration-300" onclick="event.stopPropagation()">
                
                <!-- Single Floating Close Button on Card -->
                <button onclick="closeHubNewsModal()" aria-label="Zamknij okno" class="absolute top-4 right-4 z-30 w-10 h-10 rounded-full bg-slate-900/65 hover:bg-slate-900 text-white backdrop-blur-md shadow-lg border border-white/20 flex items-center justify-center transition-all duration-200 hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-amber-400 cursor-pointer group">
                    <span class="material-symbols-outlined text-xl group-hover:rotate-90 transition-transform duration-200">close</span>
                </button>

                <!-- Media Header Wrapper (Image or Video) -->
                <div id="hub-modal-media-wrapper" class="relative w-full bg-slate-950 overflow-hidden hidden">
                    <!-- Video Container -->
                    <div id="hub-modal-video-container" class="hidden w-full"></div>
                    
                    <!-- Image Container -->
                    <div id="hub-modal-image-wrapper" class="hidden w-full max-h-[300px] sm:max-h-[360px] bg-slate-950 flex items-center justify-center relative overflow-hidden">
                        <img id="hub-modal-news-image" 
                             src="" 
                             alt="Zdjęcie artykułu MIRiOLA" 
                             onerror="this.onerror=null; this.parentElement.classList.add('hidden'); document.getElementById('hub-modal-media-wrapper').classList.add('hidden');"
                             class="w-full h-full max-h-[300px] sm:max-h-[360px] object-cover sm:object-contain bg-slate-950">
                    </div>
                </div>

                <!-- Modal Body (Naturalny przepływ treści bez wewnętrznego ucinania) -->
                <div id="hub-modal-scroll-body" class="p-6 sm:p-7 space-y-4 [overflow-wrap:anywhere] break-words text-left">
                    <!-- Category Badge & Date Row -->
                    <div class="flex items-center gap-2.5 flex-wrap pr-10">
                        <span id="hub-modal-news-badge" class="text-[11px] font-bold px-3 py-1 rounded-full text-white bg-primary shadow-sm"></span>
                        <div id="hub-modal-date-wrapper" class="flex items-center gap-1 text-xs text-amber-700 font-bold uppercase tracking-wider">
                            <span class="material-symbols-outlined text-sm text-amber-600">calendar_month</span>
                            <span id="hub-modal-news-date"></span>
                        </div>
                    </div>

                    <!-- Headline Title (Safe from overflow) -->
                    <h3 id="hub-modal-news-title" class="font-display text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 leading-tight [overflow-wrap:anywhere] break-words"></h3>

                    <!-- Article Body Content (Safe from overflow, multi-line support) -->
                    <div id="hub-modal-news-content" class="text-sm sm:text-base text-slate-700 leading-relaxed space-y-3 pt-3 border-t border-slate-100 hidden [overflow-wrap:anywhere] break-words"></div>

                    <!-- Footer Action Bar -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-3 text-xs">
                        <a id="hub-modal-full-link" href="#" class="inline-flex items-center gap-1.5 font-bold text-amber-700 hover:text-amber-800 transition-colors">
                            <span>Otwórz dedykowaną stronę wpisu</span>
                            <span class="material-symbols-outlined text-sm">open_in_new</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="w-full py-8 px-gutter border-t border-primary/10 bg-surface text-center text-xs text-on-surface-variant">
        <div class="max-w-container-max mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('favicon.png') }}" alt="MIRiOLA Logo" class="h-7 w-auto object-contain">
                <p>&copy; {{ date('Y') }} MIRiOLA. Wszelkie prawa zastrzeżone.</p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-6">
                <a href="{{ url('/osrodek') }}" class="hover:text-primary transition-colors whitespace-nowrap">Ośrodek</a>
                <a href="{{ url('/jarmark') }}" class="hover:text-primary transition-colors whitespace-nowrap">Jarmark &amp; Kawiarnia</a>
                <a href="{{ url('/gospodarstwo') }}" class="hover:text-primary transition-colors whitespace-nowrap">Gospodarstwo</a>
                <a href="{{ url('/aktualnosci') }}" class="hover:text-primary transition-colors whitespace-nowrap">Aktualności</a>
            </div>
        </div>
    </footer>

    <!-- AOS & News Modal Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });

        const hubNewsData = @json($latestNews ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

        function openNewsModal(newsId) {
            const item = hubNewsData.find(n => n.id === newsId);
            if (!item) return;

            const modalWrapper = document.getElementById('hub-modal-wrapper');
            const modalCard = document.getElementById('hub-news-modal-card');
            const mediaWrapper = document.getElementById('hub-modal-media-wrapper');
            const videoContainer = document.getElementById('hub-modal-video-container');
            const imgWrapper = document.getElementById('hub-modal-image-wrapper');
            const img = document.getElementById('hub-modal-news-image');
            const titleEl = document.getElementById('hub-modal-news-title');
            const dateEl = document.getElementById('hub-modal-news-date');
            const dateWrapper = document.getElementById('hub-modal-date-wrapper');
            const badgeEl = document.getElementById('hub-modal-news-badge');
            const hubContentEl = document.getElementById('hub-modal-news-content');
            const fullLink = document.getElementById('hub-modal-full-link');

            // Set Title
            titleEl.textContent = item.title || 'Aktualność MIRiOLA';

            // Set Date
            if (item.published_at || item.created_at) {
                const rawDate = item.published_at || item.created_at;
                dateEl.textContent = new Date(rawDate).toLocaleDateString('pl-PL');
                dateWrapper.classList.remove('hidden');
            } else {
                dateEl.textContent = '';
                dateWrapper.classList.add('hidden');
            }

            // Set Badge
            if (item.branch === 'resort') {
                badgeEl.textContent = '🏡 Ośrodek Wypoczynkowy';
                badgeEl.className = 'text-[11px] font-bold px-3 py-1 rounded-full text-white bg-primary shadow-sm';
            } else if (item.branch === 'jarmark') {
                badgeEl.textContent = '☕ Jarmark & Kawiarnia';
                badgeEl.className = 'text-[11px] font-bold px-3 py-1 rounded-full text-white bg-amber-700 shadow-sm';
            } else if (item.branch === 'farm') {
                badgeEl.textContent = '🌿 Gospodarstwo Rolne';
                badgeEl.className = 'text-[11px] font-bold px-3 py-1 rounded-full text-white bg-emerald-700 shadow-sm';
            } else {
                badgeEl.textContent = '🌐 MIRiOLA';
                badgeEl.className = 'text-[11px] font-bold px-3 py-1 rounded-full text-white bg-slate-800 shadow-sm';
            }

            // Set Full Article Link
            if (item.slug) {
                fullLink.href = '/aktualnosci/' + item.slug;
                fullLink.classList.remove('hidden');
            } else {
                fullLink.classList.add('hidden');
            }

            // Set Content with safe lead accent line without duplicate excerpt
            hubContentEl.innerHTML = '';
            const textToUse = (item.content && item.content.trim() !== '') ? item.content.trim() : ((item.excerpt && item.excerpt.trim() !== '') ? item.excerpt.trim() : '');

            if (textToUse) {
                const paragraphs = textToUse.split('\n').filter(p => p.trim() !== '');
                if (paragraphs.length > 0) {
                    const leadBox = document.createElement('div');
                    leadBox.className = 'border-l-4 border-amber-500 bg-amber-50/60 pl-4 py-2.5 rounded-r-xl text-slate-800 font-medium italic text-sm sm:text-base leading-relaxed';
                    leadBox.textContent = paragraphs[0];
                    hubContentEl.appendChild(leadBox);

                    if (paragraphs.length > 1) {
                        const restWrapper = document.createElement('div');
                        restWrapper.className = 'space-y-3 pt-2 text-slate-700 leading-relaxed';
                        paragraphs.slice(1).forEach(text => {
                            const p = document.createElement('p');
                            p.className = 'leading-relaxed [overflow-wrap:anywhere] break-words';
                            p.textContent = text;
                            restWrapper.appendChild(p);
                        });
                        hubContentEl.appendChild(restWrapper);
                    }
                }
                hubContentEl.classList.remove('hidden');
            } else {
                hubContentEl.classList.add('hidden');
            }

            // Handle Media
            videoContainer.innerHTML = '';
            videoContainer.classList.add('hidden');
            imgWrapper.classList.add('hidden');
            mediaWrapper.classList.add('hidden');

            const videoUrl = item.video_url ? item.video_url.trim() : '';
            const rawImage = item.image ? item.image.trim() : '';

            if (videoUrl !== '') {
                mediaWrapper.classList.remove('hidden');
                videoContainer.classList.remove('hidden');
                let embedHtml = '';

                if (videoUrl.includes('tiktok.com')) {
                    modalWrapper.style.maxWidth = '460px';
                    const match = videoUrl.match(/(?:video\/|\/v\/)(\d+)/) || videoUrl.match(/(\d{15,25})/);
                    const ttId = (match && match[1]) ? match[1] : '';
                    if (ttId) {
                        embedHtml = `
                            <div class="w-full bg-slate-950 flex flex-col items-center py-3 px-2">
                                <iframe src="https://www.tiktok.com/player/v1/${encodeURIComponent(ttId)}?music_info=1&description=1" 
                                        class="w-full h-[520px] max-h-[60vh] border-0 rounded-2xl shadow-lg" 
                                        style="max-width: 340px; width: 100%; height: 520px; margin: 0 auto; display: block;" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen"
                                        title="${item.title ? encodeURIComponent(item.title) : 'Wideo TikTok'}">
                                </iframe>
                                <a href="${encodeURI(videoUrl)}" target="_blank" rel="noopener noreferrer" 
                                   class="mt-3 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold shadow-md border border-slate-700/80 transition-all hover:scale-105 active:scale-95">
                                    <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                                    <span>Otwórz w aplikacji TikTok</span>
                                    <span class="material-symbols-outlined text-sm">open_in_new</span>
                                </a>
                            </div>
                        `;
                    }
                } else {
                    modalWrapper.style.maxWidth = '680px';

                    if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
                        const match = videoUrl.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^"&?\/ ]{11})/);
                        if (match && match[1]) {
                            embedHtml = `<div class="aspect-video w-full"><iframe src="https://www.youtube.com/embed/${encodeURIComponent(match[1])}?rel=0&autoplay=1" class="w-full h-full border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen"></iframe></div>`;
                        }
                    } else if (videoUrl.includes('vimeo.com')) {
                        const match = videoUrl.match(/vimeo\.com\/(\d+)/);
                        if (match && match[1]) {
                            embedHtml = `<div class="aspect-video w-full"><iframe src="https://player.vimeo.com/video/${encodeURIComponent(match[1])}?autoplay=1" class="w-full h-full border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen"></iframe></div>`;
                        }
                    } else if (/^https?:\/\/.*\.(mp4|webm)$/i.test(videoUrl) || videoUrl.startsWith('storage/') || videoUrl.startsWith('/storage/')) {
                        const src = videoUrl.startsWith('http') ? videoUrl : (videoUrl.startsWith('/') ? videoUrl : '/' + videoUrl);
                        embedHtml = `<video src="${encodeURI(src)}" controls autoplay playsinline webkit-playsinline preload="metadata" class="w-full max-h-[380px] object-contain bg-black"></video>`;
                    }
                }

                if (embedHtml) {
                    videoContainer.innerHTML = embedHtml;
                } else {
                    videoContainer.classList.add('hidden');
                    mediaWrapper.classList.add('hidden');
                }
            } else if (rawImage !== '') {
                modalWrapper.style.maxWidth = '680px';
                const safeImgSrc = rawImage.startsWith('http') ? rawImage : (rawImage.startsWith('/storage') ? rawImage : '/storage/' + rawImage.replace(/^\/?storage\//, ''));
                img.src = safeImgSrc;
                imgWrapper.classList.remove('hidden');
                mediaWrapper.classList.remove('hidden');
            } else {
                modalWrapper.style.maxWidth = '680px';
            }

            // Open Modal
            const modal = document.getElementById('hub-news-modal');
            modal.classList.remove('opacity-0', 'pointer-events-none', 'invisible');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            if (modalCard) {
                modalCard.classList.remove('scale-95');
                modalCard.classList.add('scale-100');
            }
            document.body.style.overflow = 'hidden';
        }

        function closeHubNewsModal() {
            const modal = document.getElementById('hub-news-modal');
            const modalCard = document.getElementById('hub-news-modal-card');
            if (modal) {
                modal.classList.remove('opacity-100', 'pointer-events-auto');
                modal.classList.add('opacity-0', 'pointer-events-none');
                if (modalCard) {
                    modalCard.classList.remove('scale-100');
                    modalCard.classList.add('scale-95');
                }
                document.body.style.overflow = 'auto';
                setTimeout(() => {
                    if (modal.classList.contains('opacity-0')) {
                        modal.classList.add('invisible');
                    }
                }, 300);
            }
            // Clean video to stop playback
            const vc = document.getElementById('hub-modal-video-container');
            if (vc) vc.innerHTML = '';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeHubNewsModal();
            }
        });

        // Cookie Consent Handler on Hub Landing Page
        document.addEventListener('DOMContentLoaded', () => {
            const cookieBanner = document.getElementById('hub-cookie-banner');
            const acceptButton = document.getElementById('hub-accept-cookies');
            const rejectButton = document.getElementById('hub-reject-cookies');
            
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
    </script>

    <!-- Cookie Consent Banner on Hub Landing Page -->
    <div id="hub-cookie-banner" class="fixed bottom-6 right-4 left-4 md:left-auto md:max-w-md bg-white border border-slate-200 shadow-2xl rounded-2xl p-5 z-50 transform translate-y-24 opacity-0 transition-all duration-500 ease-out hidden" role="dialog" aria-labelledby="hub-cookie-title" aria-describedby="hub-cookie-desc">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0">
                <span class="material-symbols-outlined text-[22px]">cookie</span>
            </div>
            <div class="space-y-2">
                <h3 id="hub-cookie-title" class="font-bold text-primary font-display text-base">Dbamy o Twoją prywatność</h3>
                <p id="hub-cookie-desc" class="text-xs text-slate-600 leading-relaxed">
                    Strona Ośrodka MIRiOLA wykorzystuje pliki cookie w celach funkcjonalnych i statystycznych. Szczegółowe informacje znajdziesz w naszej <a href="{{ url('/polityka-prywatnosci') }}" class="text-primary font-semibold hover:underline">Polityce Prywatności</a>.
                </p>
                <div class="flex justify-end gap-2 pt-2 flex-wrap">
                    <button id="hub-reject-cookies" class="text-slate-600 font-semibold text-xs px-4 py-2 rounded-lg border border-slate-200 hover:border-primary hover:text-primary transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Tylko niezbędne
                    </button>
                    <button id="hub-accept-cookies" class="bg-primary text-white font-bold text-xs px-5 py-2 rounded-lg hover:bg-primary/95 hover:shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Akceptuję wszystkie
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
