<!DOCTYPE html>
<html lang="pl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIRiOLA - Ośrodek Wypoczynkowy, Jarmark & Kawiarnia, Gospodarstwo Rolne</title>
    <meta name="description" content="Witaj w kompleksie MIRiOLA w dolinie Skawy. Wybierz Ośrodek Wypoczynkowy, Jarmark z Kawiarnią lub nasze Gospodarstwo Rolne.">
    <meta name="keywords" content="MIRiOLA, Ośrodek Wypoczynkowy Wadowice, Jarmark Kawiarnia, Gospodarstwo Rolne Dolina Skawy">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Open Graph SEO -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="MIRiOLA - Ośrodek Wypoczynkowy, Jarmark & Kawiarnia, Gospodarstwo Rolne">
    <meta property="og:description" content="Witaj w kompleksie MIRiOLA w dolinie Skawy. Wybierz Ośrodek Wypoczynkowy, Jarmark z Kawiarnią lub nasze Gospodarstwo Rolne.">
    <meta property="og:image" content="{{ asset('assets/img/hero.jpg') }}">
    <meta property="og:locale" content="pl_PL">
    <meta property="og:site_name" content="MIRiOLA">

    <!-- Twitter Cards SEO -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="MIRiOLA - Ośrodek, Jarmark & Gospodarstwo">
    <meta name="twitter:description" content="Noclegi, Kawiarnia Rzemieślnicza oraz Ekologiczne Ogórki i Miody w Dolinie Skawy.">
    <meta name="twitter:image" content="{{ asset('assets/img/hero.jpg') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,600;0,700;1,400&family=Work+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Material Symbols Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <!-- Tailwind CSS Engine -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/tailwind-config.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-background text-on-background font-body antialiased min-h-screen flex flex-col justify-between selection:bg-primary selection:text-white">

    <!-- Top Header -->
    <header class="w-full py-3.5 sm:py-5 px-3 sm:px-gutter border-b border-primary/10 bg-surface/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-container-max mx-auto flex justify-between items-center gap-2">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 sm:gap-3 group focus:outline-none shrink-0" aria-label="Strona główna">
                <img src="{{ asset('images/logo.png') }}" alt="MIRiOLA Logo" class="h-10 sm:h-12 w-auto object-contain group-hover:scale-105 transition-transform">
                <div class="flex flex-col">
                    <span class="font-display text-lg sm:text-xl font-bold text-primary tracking-wide leading-none">MIRiOLA</span>
                    <span class="text-[9px] sm:text-[10px] uppercase tracking-widest text-primary/70 font-bold mt-1">Dolina Skawy</span>
                </div>
            </a>
            <div class="flex items-center gap-1.5 sm:gap-3 shrink-0">
                <a href="tel:{{ $cms['phone_number'] ?? '+48608103119' }}" class="hidden md:flex items-center gap-2 text-xs font-bold text-primary hover:text-accent transition-colors mr-2">
                    <span class="material-symbols-outlined text-sm text-accent">call</span>
                    {{ $cms['phone_number'] ?? '+48 608 103 119' }}
                </a>
                
                <!-- FB Link Badge -->
                <a href="{{ $cms['facebook_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" onclick="this.blur()"
                   class="bg-[#1877F2]/10 hover:bg-[#1877F2] text-[#1877F2] hover:text-white border border-[#1877F2]/25 text-[11px] sm:text-xs font-bold py-1.5 sm:py-2 w-[62px] sm:w-[76px] rounded-lg transition-all flex items-center justify-center gap-1 sm:gap-1.5 shadow-sm btn-animate hover:scale-105 hover:shadow-md focus:outline-none shrink-0"
                   title="Facebook MIRiOLA">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 fill-current shrink-0" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    <span>FB</span>
                </a>

                <!-- OLX Link Badge -->
                <a href="{{ $cms['olx_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" onclick="this.blur()"
                   class="bg-[#002f34]/10 hover:bg-[#002f34] text-[#002f34] hover:text-white border border-[#002f34]/25 text-[11px] sm:text-xs font-bold py-1.5 sm:py-2 w-[62px] sm:w-[76px] rounded-lg transition-all flex items-center justify-center gap-1 sm:gap-1.5 shadow-sm btn-animate hover:scale-105 hover:shadow-md focus:outline-none shrink-0"
                   title="Ogłoszenia OLX MIRiOLA">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 fill-current shrink-0" viewBox="0 0 24 24">
                        <path d="M20 4H4v2h16V4zm1 10v-2l-1-5H4l-1 5v2h1v6h10v-6h4v6h2v-6h1zm-9 6H6v-4h6v4z"/>
                    </svg>
                    <span>OLX</span>
                </a>

                <!-- Instagram Link Badge -->
                <a href="{{ $cms['instagram_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" onclick="this.blur()"
                   class="bg-[#E1306C]/10 hover:bg-[#E1306C] text-[#E1306C] hover:text-white border border-[#E1306C]/25 text-[11px] sm:text-xs font-bold py-1.5 sm:py-2 w-[62px] sm:w-[76px] rounded-lg transition-all flex items-center justify-center gap-1 sm:gap-1.5 shadow-sm btn-animate hover:scale-105 hover:shadow-md focus:outline-none shrink-0"
                   title="Instagram MIRiOLA">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 fill-current shrink-0" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                    <span>IG</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Hub Selection Grid -->
    <main class="flex-grow py-10 md:py-16 px-gutter max-w-container-max mx-auto w-full flex flex-col justify-center">
        
        <!-- Welcome Hero Text & Clean Central Logo Showcase -->
        <div class="text-center max-w-3xl mx-auto mb-6 md:mb-8 flex flex-col items-center" data-aos="fade-down">
            <span class="inline-flex items-center gap-2 bg-primary/5 text-primary text-xs md:text-sm font-bold px-5 py-2 rounded-full uppercase tracking-widest mb-4 border border-primary/10 shadow-xs">
                <span class="w-2.5 h-2.5 rounded-full bg-accent animate-pulse"></span>
                Witaj w Sercu Doliny Skawy
            </span>

            <div class="group my-1">
                <img src="{{ asset('images/logo.png') }}" 
                     alt="MIRiOLA - Witaj w Sercu Doliny Skawy" 
                     class="h-44 sm:h-60 md:h-72 w-auto object-contain mx-auto group-hover:scale-105 transition-transform duration-500">
            </div>
        </div>

        <!-- 3 Interactive Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch w-full">
            
            <!-- CARD 1: Ośrodek Wypoczynkowy -->
            <a href="{{ url('/osrodek') }}" data-aos="fade-up" data-aos-delay="100" 
               class="group relative bg-surface rounded-2xl overflow-hidden border border-primary/15 ambient-shadow hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between min-h-[460px]">
                
                <!-- Background Image Overlay with Zoom Effect -->
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-110"
                     style="background-image: url('{{ asset('assets/img/hero.jpg') }}')"></div>
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
                     style="background-image: url('{{ asset('assets/img/jarmark-hero.jpg') }}')"></div>
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
                     style="background-image: url('https://images.unsplash.com/photo-1449300079323-02e209d9d3a6?auto=format&fit=crop&w=1000&q=80')"></div>
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
                            Prosto z naszych pól: tradycyjne ogórki kiszone i gruntowe, naturalne miody oraz wiejskie jajka.
                        </p>
                    </div>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 pt-2 border-t border-white/15 text-[11px]">
                        <span class="bg-white/10 px-2.5 py-1 rounded">Ogórki Gruntowe</span>
                        <span class="bg-white/10 px-2.5 py-1 rounded">Przetwory & Miody</span>
                        <span class="bg-white/10 px-2.5 py-1 rounded">Zamówienia Tel.</span>
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
                    Bądź na bieżąco z wydarzeniami, warsztatami rzemieślniczymi oraz nowościami w naszym kompleksie.
                </p>
            </div>

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestNews as $item)
                    <article class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group cursor-pointer"
                             onclick="openNewsModal({{ $item->id }})">
                        <div>
                            <!-- News Image / Badge Container -->
                            <div class="aspect-[16/9] w-full bg-slate-100 relative overflow-hidden">
                                @if($item->image)
                                    <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" 
                                         alt="{{ $item->title }}"
                                         loading="lazy" decoding="async"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-primary/5 text-primary/30">
                                        <span class="material-symbols-outlined text-5xl">newspaper</span>
                                    </div>
                                @endif

                                <!-- Category Badge -->
                                <span class="absolute top-3 left-3 text-[11px] font-bold px-3 py-1 rounded-full shadow-md backdrop-blur-md text-white {{ $item->branch === 'resort' ? 'bg-primary/90' : ($item->branch === 'jarmark' ? 'bg-amber-600/90' : 'bg-slate-700/90') }}">
                                    {{ $item->branch === 'resort' ? '🏡 Ośrodek' : ($item->branch === 'jarmark' ? '☕ Jarmark' : '🌐 Ogólne') }}
                                </span>
                            </div>

                            <!-- News Content -->
                            <div class="p-6 space-y-3">
                                <div class="flex items-center gap-2 text-xs text-primary/60 font-semibold">
                                    <span class="material-symbols-outlined text-sm text-accent">calendar_today</span>
                                    <span>{{ $item->published_at ? $item->published_at->format('d.m.Y') : $item->created_at->format('d.m.Y') }}</span>
                                </div>
                                <h3 class="font-display font-bold text-primary text-xl leading-snug group-hover:text-accent transition-colors line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                                <p class="text-xs md:text-sm text-slate-600 leading-relaxed line-clamp-3">
                                    {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 120) }}
                                </p>
                            </div>
                        </div>

                        <!-- Read More Footer -->
                        <div class="p-6 pt-0 flex items-center text-xs font-bold text-accent group-hover:translate-x-1 transition-transform">
                            <span>Czytaj cały artykuł</span>
                            <span class="material-symbols-outlined text-base ml-1">arrow_forward</span>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- View All News Button -->
            <div class="mt-10 text-center">
                <a href="{{ url('/aktualnosci') }}" class="inline-flex items-center gap-2 bg-primary text-white font-bold py-3.5 px-8 rounded-xl hover:bg-primary/90 transition-all shadow-md hover:shadow-lg btn-animate text-xs uppercase tracking-wider">
                    <span>Zobacz wszystkie aktualności</span>
                    <span class="material-symbols-outlined text-lg">newspaper</span>
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
                <a href="tel:+48608103119" class="font-bold text-primary hover:underline whitespace-nowrap">+48 608 103 119</a>
            </p>
        </div>

    </main>

    <!-- News Article Full-Screen Modal -->
    <div id="hub-news-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300 p-4" onclick="closeHubNewsModal()">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-slate-200 transform scale-95 transition-transform duration-300" onclick="event.stopPropagation()">
            <!-- Modal Header Image -->
            <div class="relative h-64 bg-slate-100">
                <img id="hub-modal-news-image" src="" alt="Zdjęcie artykułu aktualności MIRiOLA" class="w-full h-full object-cover">
                <button onclick="closeHubNewsModal()" class="absolute top-4 right-4 bg-slate-900/60 hover:bg-slate-900 text-white rounded-full w-10 h-10 flex items-center justify-center transition-colors shadow-lg">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-6 md:p-8 space-y-4">
                <div class="flex items-center gap-3">
                    <span id="hub-modal-news-badge" class="text-xs font-bold px-3 py-1 rounded-full text-white bg-primary"></span>
                    <span id="hub-modal-news-date" class="text-xs text-slate-500 font-semibold"></span>
                </div>
                <h3 id="hub-modal-news-title" class="font-display text-2xl md:text-3xl font-bold text-primary"></h3>
                <div id="hub-modal-news-content" class="text-sm md:text-base text-slate-700 leading-relaxed space-y-4 pt-2 border-t border-slate-100"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="w-full py-8 px-gutter border-t border-primary/10 bg-surface text-center text-xs text-on-surface-variant">
        <div class="max-w-container-max mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
            <p>&copy; {{ date('Y') }} MIRiOLA. Wszelkie prawa zastrzeżone.</p>
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

        const hubNewsData = @json($latestNews ?? []);

        function openNewsModal(newsId) {
            const item = hubNewsData.find(n => n.id === newsId);
            if (!item) return;

            document.getElementById('hub-modal-news-title').innerText = item.title;
            document.getElementById('hub-modal-news-date').innerText = item.published_at ? new Date(item.published_at).toLocaleDateString('pl-PL') : '';
            document.getElementById('hub-modal-news-content').innerHTML = item.content || item.excerpt || '';
            
            const badge = document.getElementById('hub-modal-news-badge');
            if (item.branch === 'resort') {
                badge.innerText = '🏡 Ośrodek Wypoczynkowy';
                badge.className = 'text-xs font-bold px-3 py-1 rounded-full text-white bg-primary';
            } else if (item.branch === 'jarmark') {
                badge.innerText = '☕ Jarmark & Kawiarnia';
                badge.className = 'text-xs font-bold px-3 py-1 rounded-full text-white bg-amber-600';
            } else {
                badge.innerText = '🌐 Ogólne';
                badge.className = 'text-xs font-bold px-3 py-1 rounded-full text-white bg-slate-700';
            }

            const img = document.getElementById('hub-modal-news-image');
            if (item.image) {
                img.src = item.image.startsWith('http') ? item.image : '/storage/' + item.image;
                img.parentElement.style.display = 'block';
            } else {
                img.parentElement.style.display = 'none';
            }

            const modal = document.getElementById('hub-news-modal');
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            modal.querySelector('div').classList.remove('scale-95');
            document.body.style.overflow = 'hidden';
        }

        function closeHubNewsModal() {
            const modal = document.getElementById('hub-news-modal');
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.querySelector('div').classList.add('scale-95');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeHubNewsModal();
            }
        });
    </script>
</body>
</html>
