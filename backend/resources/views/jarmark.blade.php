@extends('layouts.app')

@section('title', 'Jarmark - CEH & Kawiarnia MIRiOLA | Menu, Atrakcje, Nowości')
@section('meta_description', 'Zapraszamy do Kawiarni Plenerowej i Centrum Edukacyjno-Handlowego Jarmark w Gorzeniu Górnym. Aromatyczna kawa, domowe ciasta, strefa relaksu w ogrodzie i atrakcje dla dzieci.')
@section('og_image', asset('assets/img/jarmark-hero.webp'))

@section('head')
    <link rel="preload" as="image" href="{{ asset('assets/img/jarmark-hero.webp') }}" fetchpriority="high">
@endsection

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "CafeOrCoffeeShop",
  "@@id": "{{ url('/jarmark') }}#cafe",
  "name": "Kawiarnia Plenerowa Jarmark MIRiOLA",
  "description": "Kawiarnia plenerowa w Centrum Edukacyjno-Handlowym Jarmark MIRiOLA. Wyśmienita kawa, domowe ciasta, lody rzemieślnicze i strefa relaksu w ogrodzie.",
  "image": "{{ asset('assets/img/jarmark-hero.webp') }}",
  "url": "{{ url('/jarmark') }}",
  "telephone": "+48608103119",
  "servesCuisine": ["Kawa specialty", "Ciasta domowe", "Desery", "Lody rzemieślnicze"],
  "hasMenu": "{{ url('/jarmark#menu') }}",
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
    "latitude": 49.8439,
    "longitude": 19.5107
  },
  "openingHoursSpecification": [
    {
      "@@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
      "opens": "09:00",
      "closes": "20:00"
    }
  ],
  "parentOrganization": { "@@id": "{{ url('/') }}#resort" }
}
</script>
@endsection

@section('content')
    <!-- Hero Section Jarmark & Kawiarnia -->
    <section id="start" class="relative w-full h-[75vh] min-h-[520px] flex items-center justify-center bg-slate-900 overflow-hidden">
        <!-- Hero Background Image -->
        <div class="absolute inset-0 bg-cover bg-center opacity-100 scale-100 hover:scale-105 transition-transform duration-1000" 
             style="background-image: url('{{ asset('assets/img/jarmark-hero.webp') }}')">
        </div>
        <!-- Bright Light Overlay for Crisp Text Contrast -->
        <div class="absolute inset-0 bg-gradient-to-t from-primary/55 via-primary/25 to-black/15"></div>
        
        <!-- Hero Content -->
        <div class="relative z-10 text-center text-white px-gutter max-w-container-max mx-auto" data-aos="fade-up">
            <div class="inline-flex items-center gap-2.5 bg-white/10 border border-white/20 px-4 py-2 rounded-full mb-6 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                <span class="font-body text-xs uppercase tracking-widest text-white font-semibold">
                    Kawiarnia Plenerowa & Strefa Relaksu
                </span>
            </div>
            <h1 class="font-display text-4xl md:text-5xl lg:text-display-lg font-bold mb-6 leading-tight drop-shadow-md max-w-4xl mx-auto text-white">
                {{ !empty($cms['jarmark_hero_title']) ? $cms['jarmark_hero_title'] : 'Jarmark Centrum Edukacyjno-Handlowe' }}
            </h1>
            <p class="font-body text-base md:text-lg lg:text-body-lg mb-8 max-w-2xl mx-auto font-medium text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.85)]">
                {{ !empty($cms['jarmark_hero_description']) ? $cms['jarmark_hero_description'] : 'Zapraszamy do naszej kawiarni plenerowej na aromatyczną kawę, domowe ciasta, lody oraz relaks w ogrodzie ze sferycznym namiotem i dmuchańcem dla dzieci.' }}
            </p>

            <div class="flex flex-col sm:flex-row flex-wrap justify-center gap-3 sm:gap-4 px-2 max-w-full">
                <a href="#menu" class="bg-accent text-white font-bold py-3 sm:py-3.5 px-4 sm:px-8 rounded-xl hover:bg-opacity-95 hover:shadow-lg btn-animate inline-flex items-center justify-center gap-2 text-sm sm:text-base max-w-full focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2">
                    <span class="material-symbols-outlined text-[20px] shrink-0">restaurant_menu</span>
                    <span>Zobacz Menu Kawiarni</span>
                </a>
                <a href="#atrakcje-jarmark" class="bg-white/15 hover:bg-white/25 text-white font-bold py-3 sm:py-3.5 px-4 sm:px-8 rounded-xl border border-white/30 backdrop-blur-sm btn-animate inline-flex items-center justify-center gap-2 text-sm sm:text-base max-w-full">
                    <span class="material-symbols-outlined text-[20px] shrink-0">child_care</span>
                    <span>Atrakcje & Strefa Relaksu</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Kawiarnia Menu Section -->
    <section id="menu" class="py-section-gap-mobile md:py-section-gap bg-background">
        <div class="max-w-container-max mx-auto px-gutter">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-primary/70 font-bold block mb-2">Smaki z Naszej Pieczeni</span>
                <h2 class="font-display text-3xl md:text-headline-md text-primary font-bold mb-4">
                    Menu Kawiarni Jarmark
                </h2>
                <div class="w-16 h-0.5 bg-primary/20 mx-auto"></div>
            </div>

            <!-- Prominent Kawiarnia Opening Hours Banner (Dynamic from CMS) -->
            @php
                $isOpenToday = !empty($cms['cafe_open_today']) && $cms['cafe_open_today'] !== '0' && $cms['cafe_open_today'] !== false;
                $todayHours = !empty($cms['cafe_today_hours']) ? $cms['cafe_today_hours'] : null;
                $todayNotice = !empty($cms['cafe_today_notice']) ? $cms['cafe_today_notice'] : null;

                $daysSchedule = [
                    1 => ['short' => 'Pon',  'full' => 'Poniedziałek', 'hours' => $cms['cafe_hours_mon'] ?? '15:00 – 20:00'],
                    2 => ['short' => 'Wt',   'full' => 'Wtorek',       'hours' => $cms['cafe_hours_tue'] ?? '15:00 – 20:00'],
                    3 => ['short' => 'Śr',   'full' => 'Środa',        'hours' => $cms['cafe_hours_wed'] ?? '15:00 – 20:00'],
                    4 => ['short' => 'Czw',  'full' => 'Czwartek',     'hours' => $cms['cafe_hours_thu'] ?? '15:00 – 20:00'],
                    5 => ['short' => 'Pt',   'full' => 'Piątek',       'hours' => $cms['cafe_hours_fri'] ?? '15:00 – 20:00'],
                    6 => ['short' => 'Sob',  'full' => 'Sobota',       'hours' => $cms['cafe_hours_sat'] ?? '10:00 – 20:00'],
                    7 => ['short' => 'Niedz','full' => 'Niedziela',     'hours' => $cms['cafe_hours_sun'] ?? '10:00 – 20:00'],
                ];

                $currentDayNum = (int) date('N'); // 1 (Mon) - 7 (Sun)
            @endphp

            <div class="mb-14 max-w-5xl mx-auto bg-gradient-to-br from-primary via-slate-900 to-primary text-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-primary/20" data-aos="fade-up">
                <!-- Top Header & Today Status -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-white/10">
                    <div class="flex items-center gap-4">
                        <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl bg-accent/20 border border-accent/40 flex items-center justify-center shrink-0 shadow-inner">
                            <span class="material-symbols-outlined text-accent text-3xl">schedule</span>
                        </div>
                        <div>
                            <span class="text-amber-300 font-bold uppercase tracking-widest text-[11px] block">Zapraszamy do Kawiarni</span>
                            <h3 class="font-display font-bold text-xl sm:text-2xl text-white">Godziny Otwarcia</h3>
                        </div>
                    </div>

                    <!-- Dynamic "Dzisiaj otwieramy" Badge (Only visible when active in Admin Panel) -->
                    @if($isOpenToday)
                        <div class="inline-flex items-center gap-2.5 bg-emerald-500/20 border border-emerald-400/50 text-emerald-200 px-4 py-2 rounded-2xl shadow-lg backdrop-blur-md self-start md:self-auto">
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-400"></span>
                            </span>
                            <span class="font-bold text-xs sm:text-sm uppercase tracking-wide text-white">Dzisiaj Otwieramy!</span>
                            @if($todayHours)
                                <span class="bg-emerald-600/90 text-white text-xs font-mono font-bold px-2.5 py-0.5 rounded-lg shadow-2xs">
                                    {{ $todayHours }}
                                </span>
                            @endif
                            @if($todayNotice)
                                <span class="hidden lg:inline text-white/90 text-xs font-normal border-l border-emerald-400/30 pl-2.5">
                                    {{ $todayNotice }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

                @if($isOpenToday && $todayNotice)
                    <div class="mt-3 lg:hidden text-xs text-emerald-200 bg-emerald-950/40 border border-emerald-500/20 px-3.5 py-1.5 rounded-xl">
                        <span class="font-semibold text-white">Wiadomość dnia:</span> {{ $todayNotice }}
                    </div>
                @endif

                <!-- Weekly Schedule (Monday - Sunday Compact Responsive Grid) -->
                <div class="pt-6">
                    <div class="text-[11px] uppercase tracking-wider font-semibold text-white/60 mb-3 flex items-center justify-between">
                        <span>Harmonogram tygodniowy (Poniedziałek – Niedziela)</span>
                        <span class="text-amber-300/80 text-[10px] hidden sm:inline">● Wyróżniony dzień: dzisiaj</span>
                    </div>

                    <div class="cafe-schedule-grid">
                        @foreach($daysSchedule as $dayNum => $dayData)
                            @php
                                $isCurrentDay = ($dayNum === $currentDayNum);
                                $isClosed = (mb_stripos($dayData['hours'], 'zamknięt') !== false || mb_stripos($dayData['hours'], 'nieczynn') !== false);
                            @endphp
                            <div class="flex flex-col justify-between p-3 rounded-2xl border transition-all text-center relative {{ $isCurrentDay ? 'bg-amber-400/15 border-amber-300/80 ring-2 ring-amber-400/30 shadow-md' : 'bg-white/5 border-white/10 hover:border-white/20' }}">
                                @if($isCurrentDay)
                                    <span class="absolute -top-2 left-1/2 -translate-x-1/2 bg-amber-400 text-slate-950 text-[9px] font-black uppercase tracking-wider px-2 py-0.2 rounded-full shadow-xs">
                                        Dziś
                                    </span>
                                @endif
                                <div>
                                    <span class="text-xs font-bold block {{ $isCurrentDay ? 'text-amber-200' : 'text-white/80' }}">
                                        {{ $dayData['short'] }}
                                    </span>
                                    <span class="text-[10px] text-white/50 block font-normal sm:hidden">
                                        {{ $dayData['full'] }}
                                    </span>
                                </div>
                                <div class="mt-2">
                                    @if($isClosed)
                                        <span class="inline-block text-[11px] font-semibold px-2 py-0.5 rounded-lg bg-rose-500/20 text-rose-200 border border-rose-400/30">
                                            {{ $dayData['hours'] }}
                                        </span>
                                    @else
                                        <span class="font-mono text-xs font-bold {{ $isCurrentDay ? 'text-amber-100' : 'text-white' }} whitespace-nowrap">
                                            {{ $dayData['hours'] }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Categorized Menu Cards (1 Image per Category, Dynamic from CMS, Bright Photos, No Prices, items-start Grid) -->
            @php
                $allMenu = collect($cafeMenuItems ?? []);
                $groupedMenu = $allMenu->groupBy(function($item) {
                    $val = is_object($item->category) ? $item->category->value : ($item->category ?? 'kawy_napoje');
                    return match($val) {
                        'kawy', 'kawy_napoje' => 'kawy_napoje',
                        'lody' => 'lody',
                        'gofry' => 'gofry',
                        'desery', 'ciasta' => 'desery',
                        'zapiekanki', 'przekaski' => 'zapiekanki',
                        default => 'kawy_napoje',
                    };
                });

                $categoriesMeta = [
                    'kawy_napoje' => [
                        'title' => 'Kawy & Napoje',
                        'icon' => 'local_cafe',
                        'cms_key' => 'cafe_cat_image_kawy_napoje',
                        'default_image' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&w=800&q=80',
                    ],
                    'lody' => [
                        'title' => 'Lody Świderki',
                        'icon' => 'icecream',
                        'cms_key' => 'cafe_cat_image_lody',
                        'default_image' => asset('assets/img/lody.webp'),
                    ],
                    'gofry' => [
                        'title' => 'Chrupiące Gofry',
                        'icon' => 'cookie',
                        'cms_key' => 'cafe_cat_image_gofry',
                        'default_image' => 'https://images.unsplash.com/photo-1562376552-0d160a2f238d?auto=format&fit=crop&w=800&q=80',
                    ],
                    'desery' => [
                        'title' => 'Desery & Wypieki',
                        'icon' => 'cake',
                        'cms_key' => 'cafe_cat_image_desery',
                        'default_image' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?auto=format&fit=crop&w=800&q=80',
                    ],
                    'zapiekanki' => [
                        'title' => 'Chrupiące Zapiekanki',
                        'icon' => 'fastfood',
                        'cms_key' => 'cafe_cat_image_zapiekanki',
                        'default_image' => 'https://images.unsplash.com/photo-1509722747041-616f39b57569?auto=format&fit=crop&w=800&q=80',
                    ],
                ];
            @endphp

            <div class="columns-1 lg:columns-2 gap-8 space-y-8" data-aos="fade-up">
                @foreach($categoriesMeta as $catKey => $meta)
                    @php
                        $itemsInCat = $groupedMenu->get($catKey, collect());
                        $cmsImgRaw = $cms[$meta['cms_key']] ?? null;
                        if (!empty($cmsImgRaw)) {
                            if (str_starts_with($cmsImgRaw, 'http://') || str_starts_with($cmsImgRaw, 'https://')) {
                                $catImage = $cmsImgRaw;
                            } elseif (str_starts_with($cmsImgRaw, 'assets/') || str_starts_with($cmsImgRaw, 'images/') || file_exists(public_path($cmsImgRaw))) {
                                $catImage = asset($cmsImgRaw);
                            } else {
                                $catImage = asset('storage/' . ltrim($cmsImgRaw, '/'));
                            }
                        } else {
                            $catImage = $meta['default_image'];
                        }
                    @endphp
                    @if($itemsInCat->isNotEmpty())
                        <div class="break-inside-avoid inline-block w-full bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-lg transition-all duration-300 group">
                            <!-- Category Banner Image — tall, vivid, no heavy dark overlay -->
                            <div class="relative h-52 w-full bg-slate-100 overflow-hidden">
                                <img src="{{ $catImage }}" 
                                     onerror="this.onerror=null; this.src='{{ $meta['default_image'] }}';" 
                                     alt="{{ $meta['title'] }}" 
                                     loading="lazy" 
                                     decoding="async" 
                                     width="400"
                                     height="208"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-slate-950/10 to-transparent"></div>
                                
                                <div class="absolute bottom-3 left-4 right-4 flex items-center gap-3 text-white">
                                    <div class="w-9 h-9 rounded-lg bg-white/25 backdrop-blur-md border border-white/40 flex items-center justify-center text-white shrink-0 shadow-xs">
                                        <span class="material-symbols-outlined text-xl">{{ $meta['icon'] }}</span>
                                    </div>
                                    <h3 class="font-display font-bold text-xl md:text-2xl text-white drop-shadow-md tracking-tight">
                                        {{ $meta['title'] }}
                                    </h3>
                                </div>
                            </div>

                            <!-- Items List -->
                            <div class="p-5">
                                <ul class="divide-y divide-slate-100">
                                    @foreach($itemsInCat as $item)
                                        <li class="py-2.5 first:pt-0 last:pb-0 flex items-center justify-between gap-3 group/item">
                                            <div class="flex items-center gap-2.5 min-w-0">
                                                <span class="w-2 h-2 rounded-full bg-accent shrink-0 group-hover/item:scale-125 transition-transform"></span>
                                                <span class="font-medium text-slate-800 text-sm md:text-base group-hover/item:text-primary transition-colors">
                                                    {{ $item->name }}
                                                </span>
                                            </div>
                                            @if($item->is_featured)
                                                <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-amber-800 bg-gradient-to-r from-amber-50 to-amber-100/80 border border-amber-300/80 px-2.5 py-0.5 rounded-full shrink-0 shadow-2xs">
                                                    <span class="material-symbols-outlined text-[13px] text-amber-600">recommend</span> Dzisiaj polecamy
                                                </span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- Atrakcje Jarmarku Section -->
    <section id="atrakcje-jarmark" class="py-section-gap-mobile md:py-section-gap bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-container-max mx-auto px-gutter">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-primary/70 font-bold block mb-2">Plener i Rozrywka</span>
                <h2 class="font-display text-3xl md:text-headline-md text-primary font-bold mb-4">
                    Atrakcje Jarmarku & Strefa Relaksu
                </h2>
                <div class="w-16 h-0.5 bg-primary/20 mx-auto"></div>
            </div>

            <!-- Attractions Grid — vertical cards with large image on top -->
            <div class="flex flex-wrap justify-center gap-8">
                @forelse($attractions ?? [] as $attraction)
                    <div class="w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] max-w-sm bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group" data-aos="fade-up">
                        <!-- Attraction Large Image -->
                        <div class="relative h-56 md:h-64 w-full bg-slate-100 overflow-hidden shrink-0">
                            @if($attraction->image)
                                <img src="{{ str_starts_with($attraction->image, 'http') ? $attraction->image : asset('storage/' . $attraction->image) }}" 
                                     alt="{{ $attraction->title }}" 
                                     loading="lazy" decoding="async" width="600" height="400"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-amber-50">
                                    <span class="material-symbols-outlined text-6xl text-amber-300">{{ $attraction->icon ?? 'star' }}</span>
                                </div>
                            @endif
                            <!-- Icon Badge overlay -->
                            <div class="absolute top-4 left-4 w-11 h-11 rounded-xl bg-white/90 backdrop-blur-md border border-white/60 flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined text-amber-600 text-2xl">{{ $attraction->icon ?? 'star' }}</span>
                            </div>
                        </div>
                        <!-- Attraction Content -->
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="font-display font-bold text-primary text-xl mb-2 group-hover:text-accent transition-colors leading-snug">
                                {{ $attraction->title }}
                            </h3>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                {{ $attraction->description }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center py-16 bg-white rounded-2xl border border-slate-200 p-8">
                        <span class="material-symbols-outlined text-5xl text-primary/30 mb-3 block">sparkles</span>
                        <p class="text-slate-600 font-medium">Brak aktualnie zaplanowanych atrakcji.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FAQ Section Jarmark -->
    @if(isset($faqs) && count($faqs) > 0)
    <section id="faq" class="py-section-gap-mobile md:py-section-gap bg-background">
        <div class="max-w-container-max mx-auto px-gutter">
            <!-- Section Header -->
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-primary/60 font-bold block mb-2">Informacje</span>
                <h2 class="font-display text-3xl md:text-headline-md text-primary font-bold mb-4">
                    Często Zadawane Pytania
                </h2>
                <div class="w-16 h-0.5 bg-primary/20 mx-auto"></div>
            </div>

            <!-- Accordion Container -->
            <div class="max-w-3xl mx-auto space-y-4" data-aos="fade-up" data-aos-delay="100">
                @foreach($faqs as $faq)
                    <div class="faq-item group bg-surface rounded border border-primary/10 overflow-hidden transition-all duration-300 shadow-sm">
                        <button onclick="toggleFaq(this)" class="w-full flex justify-between items-center p-5 md:p-6 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary rounded">
                            <span class="font-display text-sm md:text-base font-bold text-primary">{{ $faq->question }}</span>
                            <span class="material-symbols-outlined text-primary faq-icon transition-transform duration-300 select-none">expand_more</span>
                        </button>
                        <div class="faq-content grid grid-rows-[0fr]">
                            <div class="overflow-hidden">
                                <div class="px-5 pb-5 md:px-6 md:pb-6 pt-2 border-t border-primary/10 text-sm text-on-surface-variant leading-relaxed">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection

