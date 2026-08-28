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

            <!-- Prominent Kawiarnia Opening Hours Banner -->
            <div class="mb-14 max-w-3xl mx-auto bg-gradient-to-r from-primary via-slate-900 to-primary text-white rounded-2xl p-6 md:p-8 shadow-xl border border-primary/20 flex flex-col sm:flex-row items-center justify-between gap-6" data-aos="fade-up">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-accent/20 border border-accent/40 flex items-center justify-center shrink-0 shadow-inner">
                        <span class="material-symbols-outlined text-accent text-3xl">schedule</span>
                    </div>
                    <div>
                        <span class="text-amber-300 font-bold uppercase tracking-widest text-[11px] block">Zapraszamy do Kawiarni</span>
                        <h3 class="font-display font-bold text-xl sm:text-2xl text-white">Godziny Otwarcia</h3>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row items-center gap-3 text-xs font-semibold w-full sm:w-auto text-center sm:text-left">
                    <div class="bg-white/10 backdrop-blur-md px-5 py-3 rounded-xl border border-white/15 w-full sm:w-auto shadow-xs">
                        <span class="text-white/70 text-[10px] block uppercase font-bold tracking-wider mb-0.5">Tydzień (Pon – Pt)</span>
                        <span class="text-amber-200 text-base font-mono font-bold">15:00 – 20:00</span>
                    </div>
                    <div class="bg-accent/20 backdrop-blur-md px-5 py-3 rounded-xl border border-accent/40 w-full sm:w-auto shadow-xs">
                        <span class="text-amber-200 text-[10px] block uppercase font-bold tracking-wider mb-0.5">Weekend (Sob – Niedz)</span>
                        <span class="text-white text-base font-mono font-bold">10:00 – 20:00</span>
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
                                                <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-amber-700 bg-amber-50 border border-amber-200/80 px-2.5 py-0.5 rounded-full shrink-0">
                                                    <span class="material-symbols-outlined text-[12px]">star</span> Hit
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

