@extends('layouts.app')

@section('title', $cms['meta_title'] ?? 'Ośrodek Wypoczynkowy MIRiOLA - Pokoje w dolinie Skawy')
@section('meta_description', $cms['meta_description'] ?? 'Odkryj spokój w Ośrodku Wypoczynkowym MIRiOLA. Oferujemy noclegi w pokojach 2-osobowych, apartamentach rodzinnych i domkach letniskowych w otoczeniu przyrody.')

@section('head')
    @php
        $heroImgUrl = isset($cms['hero_image']) ? (str_starts_with($cms['hero_image'], 'http') ? $cms['hero_image'] : asset('storage/' . $cms['hero_image'])) : asset('assets/img/hero.jpg');
    @endphp
    <link rel="preload" as="image" href="{{ $heroImgUrl }}" fetchpriority="high">
@endsection

@section('content')
    <!-- Hero Section -->
    <section id="start" class="relative w-full h-[80vh] flex items-center justify-center bg-surface-dim overflow-hidden">
        <!-- Hero Background Image -->
        <div class="absolute inset-0 bg-cover bg-center opacity-100 scale-100 hover:scale-105 transition-transform duration-1000" 
             style="background-image: url('{{ isset($cms['hero_image']) ? (str_starts_with($cms['hero_image'], 'http') ? $cms['hero_image'] : asset('storage/' . $cms['hero_image'])) : asset('assets/img/hero.jpg') }}')">
        </div>
        <!-- Bright Light Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-primary/60 via-primary/25 to-black/15"></div>
        
        <!-- Hero Content -->
        <div class="relative z-10 text-center text-white px-gutter max-w-container-max mx-auto" data-aos="fade-up">
            <div class="inline-flex flex-wrap items-center justify-center gap-2 mb-6">
                <span class="inline-flex items-center gap-2 bg-white/15 border border-white/25 px-4 py-1.5 rounded-full backdrop-blur-md text-xs uppercase tracking-widest text-white font-semibold shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                    {{ $cms['hero_badge'] ?? 'Komfortowe noclegi w dolinie Skawy' }}
                </span>
                <span class="inline-flex items-center gap-2 bg-white/15 border border-white/25 px-4 py-1.5 rounded-full backdrop-blur-md text-xs uppercase tracking-widest text-white font-semibold shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                    Wynajem 2 Sal Bankietowo-Imprezowych
                </span>
            </div>
            <h1 class="font-display text-4xl md:text-5xl lg:text-display-lg font-bold mb-6 leading-tight drop-shadow-md max-w-4xl mx-auto">
                {{ $cms['hero_title'] ?? 'Odkryj spokój w sercu doliny Skawy' }}
            </h1>
            <p class="font-body text-base md:text-lg lg:text-body-lg mb-8 max-w-2xl mx-auto font-medium text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.85)]">
                {{ $cms['hero_description'] ?? 'Komfortowe noclegi blisko Wadowic i Jeziora Mucharskiego' }}
            </p>
            <a href="tel:+48608103119" class="bg-accent text-white font-bold py-3 sm:py-3.5 px-5 sm:px-8 rounded-xl hover:bg-opacity-95 hover:shadow-lg btn-animate inline-flex items-center justify-center gap-2 text-sm sm:text-base max-w-full focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2">
                <span class="material-symbols-outlined text-[20px] shrink-0">call</span>
                <span>Zadzwoń i zarezerwuj: <span class="whitespace-nowrap">608 103 119</span></span>
            </a>
        </div>
    </section>

    <!-- Nasza Oferta Pokoje -->
    <section id="pokoje" class="py-section-gap-mobile md:py-section-gap bg-background">
        <div class="max-w-container-max mx-auto px-gutter">
            <!-- Section Header -->
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-primary/60 font-bold block mb-2">Nasza Oferta</span>
                <h2 class="font-display text-3xl md:text-headline-md text-primary font-bold mb-4">
                    {{ $cms['rooms_section_title'] ?? 'Pokoje i Domki (10 Obiektów)' }}
                </h2>
                <div class="w-16 h-0.5 bg-primary/20 mx-auto mb-6"></div>
                
                <!-- Live Availability Trigger Button -->
                <div class="flex justify-center px-2">
                    <button onclick="openAvailabilityModal()" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs py-3 px-4 sm:px-7 rounded-full shadow-lg transition-all flex items-center justify-center gap-2 max-w-full btn-animate hover:scale-105">
                        <span class="w-2.5 h-2.5 rounded-full bg-white animate-pulse shrink-0"></span>
                        <span class="material-symbols-outlined text-lg shrink-0">domain</span>
                        <span class="text-center">Sprawdź Dostępność 10 Pokoi & Domków (Na Żywo)</span>
                    </button>
                </div>
            </div>
            
            <!-- Top 3 Rooms Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach(($rooms ?? [])->take(3) as $room)
                    @php
                        $imageList = !empty($room->images) && is_array($room->images) 
                            ? $room->images 
                            : ($room->image ? [$room->image] : ['https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80']);
                    @endphp
                    <article class="room-card bg-surface rounded-2xl overflow-hidden border border-primary/10 ambient-shadow hover:shadow-xl transition-all duration-300 flex flex-col justify-between" 
                             data-room-card="{{ $room->id }}" data-active-index="0" data-aos="fade-up">
                        
                        <!-- Photo Gallery Container (Click to open Lightbox) -->
                        <div onclick="openRoomLightbox({{ $room->id }})" class="relative bg-surface-dim overflow-hidden rounded-t-2xl cursor-pointer group/photo">
                            <!-- Main Image Display -->
                            <div class="aspect-[4/3] w-full relative overflow-hidden bg-primary/10">
                                @foreach($imageList as $idx => $imgUrl)
                                    @php
                                        $optImgUrl = (str_starts_with($imgUrl, 'http') && str_contains($imgUrl, 'unsplash.com'))
                                            ? preg_replace('/w=\d+/', 'w=600&q=75', $imgUrl)
                                            : (str_starts_with($imgUrl, 'http') ? $imgUrl : asset('storage/' . $imgUrl));
                                    @endphp
                                    <img class="room-slide-img absolute inset-0 w-full h-full object-cover transition-all duration-500 ease-in-out group-hover/photo:scale-105 {{ $idx === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }}" 
                                         src="{{ $optImgUrl }}" 
                                         alt="{{ $room->name }} - Zdjęcie {{ $idx + 1 }}" 
                                         loading="{{ $idx === 0 ? 'eager' : 'lazy' }}"
                                         decoding="async">
                                @endforeach

                                <!-- Zoom Hint Badge -->
                                <span class="absolute top-3 left-3 bg-black/60 hover:bg-black/90 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-sm z-10 flex items-center gap-1 opacity-90 group-hover/photo:opacity-100 transition-opacity">
                                    <span class="material-symbols-outlined text-xs">zoom_in</span>
                                    <span>Powiększ</span>
                                </span>

                                <!-- Category Badge -->
                                <span class="absolute top-3 right-3 bg-primary/85 backdrop-blur-md text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-sm z-10">
                                    {{ $room->room_type }}
                                </span>

                                <!-- Arrow Controls (< and >) -->
                                @if(count($imageList) > 1)
                                    <button type="button" onclick="prevRoomImage({{ $room->id }}, event)" aria-label="Poprzednie zdjęcie"
                                            class="absolute left-2.5 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-md z-20 focus:outline-none hover:scale-110">
                                        <span class="material-symbols-outlined text-lg">chevron_left</span>
                                    </button>
                                    <button type="button" onclick="nextRoomImage({{ $room->id }}, event)" aria-label="Następne zdjęcie"
                                            class="absolute right-2.5 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-md z-20 focus:outline-none hover:scale-110">
                                        <span class="material-symbols-outlined text-lg">chevron_right</span>
                                    </button>
                                @endif

                                <!-- Overlay Bottom Bar: Counter & Compact Thumbnails -->
                                @if(count($imageList) > 1)
                                    <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/85 via-black/55 to-transparent pt-5 pb-2 px-3 flex items-end justify-between gap-2 z-10">
                                        <!-- Counter e.g. "1 — 3" -->
                                        <span class="room-img-counter font-mono text-[10px] tracking-widest text-amber-200 font-bold drop-shadow-sm pb-0.5">
                                            1 — {{ count($imageList) }}
                                        </span>
                                        
                                        <!-- Compact Thumbnail Strip -->
                                        <div class="flex items-center gap-1 overflow-x-auto max-w-[75%] pb-0.5 scrollbar-none">
                                            @foreach($imageList as $idx => $imgUrl)
                                                <button type="button" onclick="changeRoomImage({{ $room->id }}, {{ $idx }}); event.stopPropagation();" 
                                                        class="room-thumb w-7 h-7 rounded overflow-hidden shrink-0 border border-white/40 transition-all {{ $idx === 0 ? 'border-amber-300 ring-1 ring-amber-300 scale-105 opacity-100' : 'opacity-60 hover:opacity-100' }}">
                                                    <img src="{{ str_starts_with($imgUrl, 'http') ? $imgUrl : asset('storage/' . $imgUrl) }}" 
                                                         class="w-full h-full object-cover" alt="Miniaturka {{ $idx + 1 }}">
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Content: Name & Udogodnienia (Bullet Points) -->
                        <div class="p-6 flex flex-col flex-grow justify-between space-y-4">
                            <div>
                                <!-- Room Name (Click opens Lightbox) -->
                                <h3 onclick="openRoomLightbox({{ $room->id }})" class="font-display text-xl font-bold text-primary mb-3 cursor-pointer hover:text-accent transition-colors flex items-center justify-between">
                                    <span>{{ $room->name }}</span>
                                    <span class="material-symbols-outlined text-lg text-primary/40 hover:text-accent">open_in_full</span>
                                </h3>

                                <!-- Udogodnienia (Bullet points) -->
                                @if(!empty($room->amenities) && is_array($room->amenities))
                                    <ul class="space-y-2 text-xs text-on-surface-variant my-3">
                                        @foreach($room->amenities as $amenity)
                                            <li class="flex items-center gap-2">
                                                <span class="w-2 h-2 rounded-full bg-accent shrink-0"></span>
                                                <span class="font-medium text-primary/90">{{ $amenity }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <!-- Footer Price & Buttons -->
                            <div class="space-y-3 pt-3 border-t border-primary/10 mt-auto">
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-on-surface-variant font-medium bg-primary/5 px-2.5 py-1 rounded-md">Maksymalnie {{ $room->capacity }} os.</span>
                                </div>

                                <div class="grid grid-cols-2 gap-2">
                                    <button onclick="selectRoomAndOpenCalendar({{ $room->id }})" class="border border-primary text-primary text-center font-bold text-xs py-2.5 rounded-lg hover:bg-primary hover:text-white btn-animate whitespace-nowrap">
                                        Dostępność
                                    </button>
                                    <a href="tel:{{ $cms['phone_number'] ?? '+48608103119' }}" class="bg-primary text-white text-center font-bold text-xs py-2.5 rounded-lg hover:bg-opacity-95 btn-animate flex items-center justify-center gap-1 whitespace-nowrap">
                                        <span class="material-symbols-outlined text-sm shrink-0">call</span>
                                        <span>Rezerwuj</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Expandable Container for Remaining Rooms -->
            @if(count($rooms ?? []) > 3)
                <div id="more-rooms-container" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8 border-t border-primary/10 pt-8">
                    @foreach(($rooms ?? [])->slice(3) as $room)
                        @php
                            $imageList = !empty($room->images) && is_array($room->images) 
                                ? $room->images 
                                : ($room->image ? [$room->image] : ['https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80']);
                        @endphp
                        <article class="room-card bg-surface rounded-2xl overflow-hidden border border-primary/10 ambient-shadow hover:shadow-xl transition-all duration-300 flex flex-col justify-between" 
                                 data-room-card="{{ $room->id }}" data-active-index="0">
                            
                            <!-- Photo Gallery Container -->
                            <div class="relative bg-surface-dim overflow-hidden rounded-t-2xl">
                                <!-- Main Image Display -->
                                <div class="aspect-[4/3] w-full relative overflow-hidden bg-primary/10">
                                    @foreach($imageList as $idx => $imgUrl)
                                        <img class="room-slide-img absolute inset-0 w-full h-full object-cover transition-opacity duration-500 ease-in-out {{ $idx === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }}" 
                                             src="{{ str_starts_with($imgUrl, 'http') ? $imgUrl : asset('storage/' . $imgUrl) }}" 
                                             alt="{{ $room->name }} - Zdjęcie {{ $idx + 1 }}" loading="lazy">
                                    @endforeach

                                    <!-- Category Badge -->
                                    <span class="absolute top-3 right-3 bg-primary/85 backdrop-blur-md text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-sm z-10">
                                        {{ $room->room_type }}
                                    </span>

                                    <!-- Arrow Controls (< and >) -->
                                    @if(count($imageList) > 1)
                                        <button type="button" onclick="prevRoomImage({{ $room->id }}, event)" aria-label="Poprzednie zdjęcie"
                                                class="absolute left-2.5 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-md z-20 focus:outline-none hover:scale-110">
                                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                                        </button>
                                        <button type="button" onclick="nextRoomImage({{ $room->id }}, event)" aria-label="Następne zdjęcie"
                                                class="absolute right-2.5 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-md z-20 focus:outline-none hover:scale-110">
                                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                                        </button>
                                    @endif

                                    <!-- Overlay Bottom Bar: Counter & Compact Thumbnails -->
                                    @if(count($imageList) > 1)
                                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/85 via-black/55 to-transparent pt-5 pb-2 px-3 flex items-end justify-between gap-2 z-10">
                                            <!-- Counter e.g. "1 — 3" -->
                                            <span class="room-img-counter font-mono text-[10px] tracking-widest text-amber-200 font-bold drop-shadow-sm pb-0.5">
                                                1 — {{ count($imageList) }}
                                            </span>
                                            
                                            <!-- Compact Thumbnail Strip -->
                                            <div class="flex items-center gap-1 overflow-x-auto max-w-[75%] pb-0.5 scrollbar-none">
                                                @foreach($imageList as $idx => $imgUrl)
                                                    <button type="button" onclick="changeRoomImage({{ $room->id }}, {{ $idx }}); event.stopPropagation();" 
                                                            class="room-thumb w-7 h-7 rounded overflow-hidden shrink-0 border border-white/40 transition-all {{ $idx === 0 ? 'border-amber-300 ring-1 ring-amber-300 scale-105 opacity-100' : 'opacity-60 hover:opacity-100' }}">
                                                        <img src="{{ str_starts_with($imgUrl, 'http') ? $imgUrl : asset('storage/' . $imgUrl) }}" 
                                                             class="w-full h-full object-cover" alt="Miniaturka {{ $idx + 1 }}">
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Content: Name & Udogodnienia (Bullet Points) -->
                            <div class="p-6 flex flex-col flex-grow justify-between space-y-4">
                                <div>
                                    <!-- Room Name -->
                                    <h3 class="font-display text-xl font-bold text-primary mb-3">
                                        {{ $room->name }}
                                    </h3>

                                    <!-- Udogodnienia (Bullet points) -->
                                    @if(!empty($room->amenities) && is_array($room->amenities))
                                        <ul class="space-y-2 text-xs text-on-surface-variant my-3">
                                            @foreach($room->amenities as $amenity)
                                                <li class="flex items-center gap-2">
                                                    <span class="w-2 h-2 rounded-full bg-accent shrink-0"></span>
                                                    <span class="font-medium text-primary/90">{{ $amenity }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>

                                <!-- Footer Price & Buttons -->
                                <div class="space-y-3 pt-3 border-t border-primary/10 mt-auto">
                                    <div class="flex justify-between items-center text-xs">
                                        <span class="text-on-surface-variant font-medium bg-primary/5 px-2.5 py-1 rounded-md">Maksymalnie {{ $room->capacity }} os.</span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2">
                                        <button onclick="selectRoomAndOpenCalendar({{ $room->id }})" class="border border-primary text-primary text-center font-bold text-xs py-2.5 rounded-lg hover:bg-primary hover:text-white btn-animate whitespace-nowrap">
                                            Dostępność
                                        </button>
                                        <a href="tel:{{ $cms['phone_number'] ?? '+48608103119' }}" class="bg-primary text-white text-center font-bold text-xs py-2.5 rounded-lg hover:bg-opacity-95 btn-animate flex items-center justify-center gap-1 whitespace-nowrap">
                                            <span class="material-symbols-outlined text-sm shrink-0">call</span>
                                            <span>Rezerwuj</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Show More / Less Rooms Button -->
                <div class="mt-10 text-center">
                    <button id="toggle-more-rooms-btn" onclick="toggleMoreRooms()" 
                            class="bg-surface border border-primary/20 hover:bg-primary hover:text-white text-primary font-bold text-xs py-3.5 px-8 rounded-full shadow-md transition-all inline-flex items-center gap-2 btn-animate hover:scale-105 focus:outline-none">
                        <span class="material-symbols-outlined text-xl" id="more-rooms-icon">expand_more</span>
                        <span id="more-rooms-text">Pokaż pozostałe pokoje i domki (7 Obiektów)</span>
                    </button>
                </div>
            @endif
        </div>
    </section>

    <!-- Galeria Zdjęć Ośrodka -->
    <section id="galeria" class="py-section-gap-mobile md:py-section-gap bg-background border-t border-primary/10">
        <div class="max-w-container-max mx-auto px-gutter">
            <!-- Section Header -->
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-primary/60 font-bold block mb-2">Odkryj Nasz Ośrodek</span>
                <h2 class="font-display text-3xl md:text-headline-md text-primary font-bold mb-4">
                    Galeria Zdjęć MIRiOLA
                </h2>
                <div class="w-16 h-0.5 bg-primary/20 mx-auto"></div>
            </div>

            <!-- Gallery Carousel Container -->
            <div class="relative group" data-aos="fade-up">
                <!-- Navigation Arrows (< and >) -->
                <button type="button" onclick="scrollGalleryLeft()" aria-label="Przewiń w lewo" class="absolute -left-2 sm:left-2 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/95 text-primary hover:bg-primary hover:text-white flex items-center justify-center shadow-lg backdrop-blur-md transition-all z-20 focus:outline-none hover:scale-110 border border-slate-200">
                    <span class="material-symbols-outlined text-2xl">chevron_left</span>
                </button>
                <button type="button" onclick="scrollGalleryRight()" aria-label="Przewiń w prawo" class="absolute -right-2 sm:right-2 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/95 text-primary hover:bg-primary hover:text-white flex items-center justify-center shadow-lg backdrop-blur-md transition-all z-20 focus:outline-none hover:scale-110 border border-slate-200">
                    <span class="material-symbols-outlined text-2xl">chevron_right</span>
                </button>

                <!-- Scrollable Gallery Row -->
                <div id="gallery-scroll-container" class="flex items-center gap-5 sm:gap-6 overflow-x-auto scroll-smooth pb-4 pt-1 px-2 scrollbar-none snap-x">
                    @forelse($galleryImages ?? [] as $idx => $gImg)
                        @php
                            $rawUrl = $gImg->image ?? '';
                            $fullUrl = str_starts_with($rawUrl, 'http') ? $rawUrl : asset('storage/' . $rawUrl);
                            $thumbUrl = (str_starts_with($rawUrl, 'http') && str_contains($rawUrl, 'unsplash.com'))
                                ? preg_replace('/w=\d+/', 'w=600&q=75', $rawUrl)
                                : $fullUrl;
                            $isVideo = ($gImg->media_type === 'video') || !empty($gImg->video_url);
                        @endphp
                        <div onclick="openGalleryLightbox({{ $idx }})" 
                             class="snap-center shrink-0 w-72 sm:w-96 aspect-[4/3] rounded-2xl overflow-hidden relative shadow-md hover:shadow-2xl transition-all duration-500 cursor-pointer group/card border border-slate-200/80 bg-slate-100">
                            @if($gImg->image)
                                <img src="{{ $thumbUrl }}" alt="{{ $gImg->title ?? 'Multimedium' }}" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover/card:scale-108 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-slate-900 flex items-center justify-center text-white">
                                    <span class="material-symbols-outlined text-6xl text-amber-300">movie</span>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-transparent opacity-80 group-hover/card:opacity-90 transition-opacity"></div>
                            
                            <!-- Video Badge or Zoom Icon Overlay -->
                            @if($isVideo)
                                <span class="absolute top-3 right-3 bg-red-600/90 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-md backdrop-blur-md flex items-center gap-1 z-10">
                                    <span class="material-symbols-outlined text-sm">play_arrow</span> Wideo
                                </span>
                            @endif

                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/card:opacity-100 transition-opacity duration-300">
                                <button type="button" onclick="openGalleryLightbox({{ $idx }}); event.stopPropagation();" aria-label="Powiększ" 
                                        class="w-14 h-14 rounded-full bg-white/30 hover:bg-white/50 backdrop-blur-md text-white flex items-center justify-center shadow-lg transform group-hover/card:scale-110 transition-all focus:outline-none hover:scale-125 z-20">
                                    <span class="material-symbols-outlined text-3xl">{{ $isVideo ? 'play_circle' : 'zoom_in' }}</span>
                                </button>
                            </div>

                            @if($gImg->title)
                                <div class="absolute bottom-4 inset-x-4 text-white">
                                    <p class="font-display text-sm font-bold drop-shadow-md truncate">{{ $gImg->title }}</p>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="w-full text-center py-12 text-slate-500">
                            Zdjęcia i wideo galerii są dodawane. Zapraszamy wkrótce!
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Atrakcje w okolicy -->
    <section id="atrakcje" class="py-section-gap-mobile md:py-section-gap bg-primary/[0.03] border-y border-primary/10">
        <div class="max-w-container-max mx-auto px-gutter">
            <!-- Section Header -->
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-primary/60 font-bold block mb-2">Komfort & Relaks</span>
                <h2 class="font-display text-3xl md:text-headline-md text-primary font-bold mb-4">
                    Udogodnienia i Atrakcje w MIRiOLA
                </h2>
                <div class="w-16 h-0.5 bg-primary/20 mx-auto"></div>
            </div>
            
            <!-- Amenities / Attractions Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                @forelse($attractions ?? [] as $attraction)
                    <div class="flex flex-col items-center group" data-aos="fade-up">
                        <div class="w-20 h-20 rounded-full bg-primary/5 flex items-center justify-center mb-5 text-primary group-hover:scale-105 group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-sm">
                            <span class="material-symbols-outlined text-4xl">{{ $attraction->icon ?? 'star' }}</span>
                        </div>
                        <h4 class="font-bold text-primary font-display text-base mb-1">{{ $attraction->title }}</h4>
                        <p class="text-xs text-on-surface-variant max-w-[180px] mx-auto leading-relaxed">
                            {{ $attraction->description }}
                        </p>
                    </div>
                @empty
                    <!-- Fallback default amenities -->
                    <div class="flex flex-col items-center group" data-aos="fade-up">
                        <div class="w-20 h-20 rounded-full bg-primary/5 flex items-center justify-center mb-5 text-primary">
                            <span class="material-symbols-outlined text-4xl">hot_tub</span>
                        </div>
                        <h4 class="font-bold text-primary font-display text-base mb-1">Jacuzzi w Ogrodzie</h4>
                        <p class="text-xs text-on-surface-variant max-w-[180px] mx-auto leading-relaxed">Relaksujące jacuzzi ogrodowe na świeżym powietrzu.</p>
                    </div>
                    <div class="flex flex-col items-center group" data-aos="fade-up">
                        <div class="w-20 h-20 rounded-full bg-primary/5 flex items-center justify-center mb-5 text-primary">
                            <span class="material-symbols-outlined text-4xl">deck</span>
                        </div>
                        <h4 class="font-bold text-primary font-display text-base mb-1">Duża Wiata Biesiadna</h4>
                        <p class="text-xs text-on-surface-variant max-w-[180px] mx-auto leading-relaxed">Zadaszona wiata ogrodowa ze strefą do grillowania.</p>
                    </div>
                    <div class="flex flex-col items-center group" data-aos="fade-up">
                        <div class="w-20 h-20 rounded-full bg-primary/5 flex items-center justify-center mb-5 text-primary">
                            <span class="material-symbols-outlined text-4xl">local_parking</span>
                        </div>
                        <h4 class="font-bold text-primary font-display text-base mb-1">Bezpłatny Parking</h4>
                        <p class="text-xs text-on-surface-variant max-w-[180px] mx-auto leading-relaxed">Ogrodzony i bezpłatny parking dla naszych gości.</p>
                    </div>
                    <div class="flex flex-col items-center group" data-aos="fade-up">
                        <div class="w-20 h-20 rounded-full bg-primary/5 flex items-center justify-center mb-5 text-primary">
                            <span class="material-symbols-outlined text-4xl">child_care</span>
                        </div>
                        <h4 class="font-bold text-primary font-display text-base mb-1">Plac Zabaw dla Dzieci</h4>
                        <p class="text-xs text-on-surface-variant max-w-[180px] mx-auto leading-relaxed">Bezpieczna strefa zabawy dla najmłodszych.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
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
                @forelse($faqs ?? [] as $faq)
                    <div class="faq-item group bg-surface rounded border border-primary/10 overflow-hidden transition-all duration-300 shadow-sm">
                        <button onclick="toggleFaq(this)" class="w-full flex justify-between items-center p-5 md:p-6 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary rounded">
                            <span class="font-display text-sm md:text-base font-bold text-primary">{{ $faq->question }}</span>
                            <span class="material-symbols-outlined text-primary faq-icon transition-transform duration-300 select-none">expand_more</span>
                        </button>
                        <div class="faq-content grid grid-rows-[0fr] transition-all duration-300 ease-in-out">
                            <div class="overflow-hidden">
                                <div class="px-5 pb-5 md:px-6 md:pb-6 pt-2 border-t border-primary/10 text-sm text-on-surface-variant leading-relaxed">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-slate-500">Pytania i odpowiedzi są aktualizowane.</div>
                @endforelse
            </div>
        </div>
    </section>

            </div>
        </div>
    </section>

    <!-- Real-Time Availability & Interactive Calendar Modal for All 10 Rooms/Cottages -->
    <div id="availability-modal" onclick="closeAvailabilityModal()" class="fixed inset-0 bg-primary/70 backdrop-blur-md z-[110] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div onclick="event.stopPropagation()" class="bg-white border border-slate-200/80 rounded-3xl max-w-3xl w-full max-h-[92vh] overflow-y-auto shadow-2xl relative p-6 md:p-8 space-y-6">
            <button onclick="closeAvailabilityModal()" aria-label="Zamknij kalendarz" class="absolute top-5 right-5 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>

            <div class="space-y-1 text-center sm:text-left pr-8">
                <h2 class="font-display text-2xl md:text-3xl font-bold text-primary tracking-tight">
                    Kalendarz Dostępności
                </h2>
                <p class="text-xs text-slate-500">
                    Sprawdź wolne terminy w 10 komfortowych pokojach i domkach Ośrodka MIRiOLA.
                </p>
            </div>

            <!-- Tabs Selection: Widok Kalendarza vs Wszystkie Obiekty -->
            <div class="flex border-b border-slate-200 gap-6 text-xs font-bold">
                <button id="tab-btn-calendar" onclick="switchAvailabilityTab('calendar')" class="pb-3 border-b-2 border-primary text-primary flex items-center gap-1.5 focus:outline-none">
                    <span class="material-symbols-outlined text-base">calendar_month</span>
                    Widok Kalendarza
                </button>
                <button id="tab-btn-list" onclick="switchAvailabilityTab('list')" class="pb-3 border-b-2 border-transparent text-slate-400 hover:text-primary flex items-center gap-1.5 focus:outline-none">
                    <span class="material-symbols-outlined text-base">format_list_bulleted</span>
                    Wszystkie 10 Obiektów
                </button>
            </div>

            <!-- Tab 1: Interactive Calendar View -->
            <div id="tab-content-calendar" class="space-y-5">
                <!-- Room Selector & Month Control Bar -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
                    <div class="flex-grow">
                        <label for="calendar-room-select" class="block text-[11px] uppercase tracking-wider font-semibold text-slate-500 mb-1">
                            Wybrany pokój / domek:
                        </label>
                        <select id="calendar-room-select" onchange="onCalendarRoomChange(this.value)" class="w-full bg-white text-slate-800 font-bold text-sm rounded-xl border-slate-300 px-3.5 py-2.5 focus:ring-2 focus:ring-primary focus:outline-none shadow-xs">
                            @foreach($rooms ?? [] as $r)
                                <option value="{{ $r->id }}">{{ $r->name }} ({{ $r->room_type }}) — do {{ $r->capacity }} os.</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Month Controls -->
                    <div class="flex items-center justify-between sm:justify-end gap-3 pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-200">
                        <button onclick="changeCalendarMonth(-1)" aria-label="Poprzedni miesiąc" class="w-9 h-9 rounded-full bg-white border border-slate-200 hover:bg-slate-100 flex items-center justify-center transition-all shadow-xs text-slate-700">
                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                        </button>
                        <span id="calendar-month-label" class="font-display font-bold text-primary text-base min-w-[140px] text-center">
                            Sierpień 2026
                        </span>
                        <button onclick="changeCalendarMonth(1)" aria-label="Następny miesiąc" class="w-9 h-9 rounded-full bg-white border border-slate-200 hover:bg-slate-100 flex items-center justify-center transition-all shadow-xs text-slate-700">
                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                        </button>
                    </div>
                </div>

                <!-- Calendar Legend -->
                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-6 text-xs font-medium text-slate-600 px-1 py-0.5">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 ring-2 ring-emerald-100"></span>
                        <span>Dzień Wolny</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-rose-200 border border-rose-300"></span>
                        <span>Zarezerwowany</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-slate-200"></span>
                        <span>Przeszłość</span>
                    </div>
                </div>

                <!-- Interactive Days Grid -->
                <div class="bg-white rounded-2xl border border-slate-200/90 p-4 md:p-6 shadow-xs">
                    <!-- Day names -->
                    <div class="grid grid-cols-7 gap-2 text-center font-bold text-[11px] text-slate-400 uppercase tracking-widest mb-3">
                        <div>Pn</div><div>Wt</div><div>Śr</div><div>Cz</div><div>Pt</div><div>So</div><div>Nd</div>
                    </div>
                    <!-- Days container -->
                    <div id="calendar-days-grid" class="grid grid-cols-7 gap-2 text-center">
                        <!-- Rendered dynamically by JS -->
                    </div>
                </div>

                <!-- Reservation Call Action -->
                <div class="bg-primary/5 border border-primary/10 rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="space-y-0.5 text-center sm:text-left">
                        <h4 class="font-bold text-primary text-sm" id="selected-room-info-name">Dostępność dla wybranego pokoju</h4>
                        <p class="text-xs text-slate-500" id="selected-room-info-desc">Kliknij dowolny wolny dzień w kalendarzu lub zadzwoń do nas!</p>
                    </div>
                    <a id="modal-phone-btn" href="tel:{{ $cms['phone_number'] ?? '+48608103119' }}" class="w-full sm:w-auto bg-accent text-white font-bold text-xs py-3 px-6 rounded-xl transition-all shadow hover:bg-opacity-95 flex items-center justify-center gap-2 btn-animate shrink-0">
                        <span class="material-symbols-outlined text-base">call</span>
                        <span>Rezerwuj: +48 608 103 119</span>
                    </a>
                </div>
            </div>

            <!-- Tab 2: Rooms Summary List -->
            <div id="tab-content-list" class="hidden grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($rooms ?? [] as $room)
                    <div class="p-5 rounded-2xl border bg-slate-50 border-slate-200 flex flex-col justify-between space-y-4 shadow-xs">
                        <div class="flex flex-wrap items-start justify-between gap-2">
                            <div>
                                <span class="text-[10px] uppercase font-bold tracking-wider px-2.5 py-0.5 rounded bg-primary/10 text-primary">
                                    {{ $room->room_type }}
                                </span>
                                <h3 class="font-bold text-primary text-base mt-1.5">{{ $room->name }}</h3>
                            </div>
                        </div>

                        <p class="text-xs text-slate-600 leading-relaxed line-clamp-2">
                            {{ $room->description ?? 'Komfortowy obiekt w Dolinie Skawy.' }}
                        </p>

                        <div class="flex justify-between items-center text-xs border-t border-slate-200/80 pt-3">
                            <span class="text-slate-600 font-medium">Maksymalnie {{ $room->capacity }} osoby</span>
                        </div>

                        <div class="pt-1 flex gap-2">
                            <button onclick="selectRoomAndOpenCalendar({{ $room->id }})" class="flex-1 bg-primary text-white font-bold text-xs py-2.5 px-3 rounded-xl hover:bg-primary/90 transition-all flex items-center justify-center gap-1.5 shadow-xs">
                                <span class="material-symbols-outlined text-base shrink-0">calendar_month</span>
                                <span class="whitespace-nowrap">Zobacz Kalendarz</span>
                            </button>
                            <a href="tel:{{ $cms['phone_number'] ?? '+48608103119' }}" class="bg-accent hover:bg-opacity-95 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition-all flex items-center justify-center gap-1 shrink-0">
                                <span class="material-symbols-outlined text-base shrink-0">call</span>
                                <span>Rezerwuj</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-8 text-slate-400">
                        <p>Wczytywanie listy 10 pokoi...</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Room High-Resolution Gallery Lightbox Modal (Bright White Glassmorphic Design) -->
    <div id="room-lightbox-modal" onclick="if(event.target === this) closeRoomLightbox()" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/75 backdrop-blur-md opacity-0 pointer-events-none transition-opacity duration-300 p-2 sm:p-4 md:p-6" role="dialog" aria-modal="true">
        <div class="relative w-full max-w-5xl bg-white/95 backdrop-blur-xl border border-white/60 rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[95vh] text-slate-800">
            
            <!-- Lightbox Header (Bright Light Glass) -->
            <div class="p-4 sm:p-5 bg-white/95 flex items-center justify-between border-b border-slate-200/80 shrink-0">
                <div>
                    <span id="lightbox-room-type" class="text-[11px] font-bold uppercase tracking-widest text-emerald-700 block mb-1">
                        Pokój
                    </span>
                    <h3 id="lightbox-room-title" class="font-display font-bold text-xl sm:text-2xl text-slate-900">
                        Nazwa Pokoju
                    </h3>
                </div>
                <button type="button" onclick="closeRoomLightbox()" class="w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-900 flex items-center justify-center transition-colors focus:outline-none shadow-xs" aria-label="Zamknij">
                    <span class="material-symbols-outlined text-2xl">close</span>
                </button>
            </div>

            <!-- Lightbox Main Stage (Large Image / Video with Navigation & Zoom Controls) -->
            <div class="relative flex-grow bg-slate-950 flex items-center justify-center overflow-hidden min-h-[340px] sm:min-h-[480px] max-h-[65vh] p-2">
                <img id="lightbox-main-img" src="" alt="Zdjęcie w pełnym rozmiarze" onclick="zoomInLightboxImage()" class="max-h-full max-w-full object-contain transition-transform duration-300 rounded-lg shadow-2xl cursor-zoom-in">
                <div id="lightbox-video-stage" class="hidden w-full h-full max-h-full max-w-full flex items-center justify-center"></div>
                
                <!-- Navigation Arrows (< and >) -->
                <button type="button" onclick="prevLightboxImg()" aria-label="Poprzednie" class="absolute left-3 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/65 hover:bg-primary text-white flex items-center justify-center backdrop-blur-md transition-all shadow-lg focus:outline-none hover:scale-110">
                    <span class="material-symbols-outlined text-2xl">chevron_left</span>
                </button>
                <button type="button" onclick="nextLightboxImg()" aria-label="Następne" class="absolute right-3 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/65 hover:bg-primary text-white flex items-center justify-center backdrop-blur-md transition-all shadow-lg focus:outline-none hover:scale-110">
                    <span class="material-symbols-outlined text-2xl">chevron_right</span>
                </button>

                <!-- Stage Controls Top Right: Zoom Buttons (Lupa + and Lupa -) -->
                <div id="lightbox-zoom-controls" class="absolute top-4 right-4 flex items-center gap-2 z-20">
                    <button type="button" onclick="zoomInLightboxImage()" title="Powiększ (Lupa +)" class="w-10 h-10 rounded-full bg-black/75 hover:bg-primary text-white flex items-center justify-center backdrop-blur-md shadow-md transition-all hover:scale-110 focus:outline-none border border-white/20">
                        <span class="material-symbols-outlined text-xl">zoom_in</span>
                    </button>
                    <button type="button" onclick="zoomOutLightboxImage()" title="Pomniejsz (Lupa -)" class="w-10 h-10 rounded-full bg-black/75 hover:bg-primary text-white flex items-center justify-center backdrop-blur-md shadow-md transition-all hover:scale-110 focus:outline-none border border-white/20">
                        <span class="material-symbols-outlined text-xl">zoom_out</span>
                    </button>
                    <button type="button" onclick="resetLightboxZoom()" title="Resetuj przybliżenie" class="w-10 h-10 rounded-full bg-black/75 hover:bg-primary text-white flex items-center justify-center backdrop-blur-md shadow-md transition-all hover:scale-110 focus:outline-none border border-white/20">
                        <span class="material-symbols-outlined text-xl">restart_alt</span>
                    </button>
                </div>

                <!-- Stage Photo Counter -->
                <span id="lightbox-counter" class="absolute bottom-4 left-4 bg-black/75 text-amber-200 font-mono text-xs font-bold px-3 py-1 rounded-full border border-white/20 backdrop-blur-md shadow-md">
                    1 / 1
                </span>
            </div>

            <!-- Lightbox Footer: Thumbnails, Amenities & Call Button (Bright Light Glass) -->
            <div class="p-4 sm:p-5 bg-white/95 border-t border-slate-200/80 space-y-4 shrink-0 overflow-y-auto max-h-[30vh]">
                <!-- Thumbnails Row -->
                <div id="lightbox-thumbs" class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none">
                    <!-- Populated dynamically via JS -->
                </div>

                <!-- Details & Reservation Footer -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-3 border-t border-slate-200/80 text-xs">
                    <div id="lightbox-amenities-tags" class="flex flex-wrap gap-1.5 text-slate-800">
                        <!-- Populated dynamically via JS -->
                    </div>
                    <div id="lightbox-call-footer" class="flex items-center justify-between sm:justify-end gap-4 shrink-0 w-full sm:w-auto pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-200/80">
                        <span id="lightbox-price" class="font-bold text-slate-900 text-base">od 0 zł / noc</span>
                        <a href="tel:{{ $cms['phone_number'] ?? '+48608103119' }}" class="bg-accent text-white font-bold py-2.5 px-6 rounded-lg hover:bg-opacity-95 transition-all flex items-center justify-center gap-1.5 shadow-md btn-animate">
                            <span class="material-symbols-outlined text-sm">call</span>
                            <span>Zadzwoń i Rezerwuj</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script>
    const allRoomsData = @json($rooms ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    let calActiveRoomId = allRoomsData[0]?.id || 1;
    // Was hardcoded to August 2026, so the calendar opened on the same month
    // forever. See REVIEW.md M-25.
    const calToday = new Date();
    let calYear = calToday.getFullYear();
    let calMonth = calToday.getMonth();

    const monthNamesPl = [
        'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec',
        'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'
    ];

    function openAvailabilityModal() {
        const modal = document.getElementById('availability-modal');
        if (modal) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            document.body.style.overflow = 'hidden';
            renderCustomerCalendar();
        }
    }

    function closeAvailabilityModal() {
        const modal = document.getElementById('availability-modal');
        if (modal) {
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'auto';
        }
    }

    function checkAvailability(roomId) {
        if (roomId) {
            const mappedId = typeof roomId === 'number' ? roomId : (roomId === 'room1' ? 1 : (roomId === 'room2' ? 6 : 9));
            selectRoomAndOpenCalendar(mappedId);
        } else {
            openAvailabilityModal();
        }
    }

    function switchAvailabilityTab(tab) {
        const btnCal = document.getElementById('tab-btn-calendar');
        const btnList = document.getElementById('tab-btn-list');
        const contentCal = document.getElementById('tab-content-calendar');
        const contentList = document.getElementById('tab-content-list');

        if (tab === 'calendar') {
            btnCal.className = 'pb-3 border-b-2 border-primary text-primary flex items-center gap-1.5 focus:outline-none';
            btnList.className = 'pb-3 border-b-2 border-transparent text-primary/60 hover:text-primary flex items-center gap-1.5 focus:outline-none';
            contentCal.classList.remove('hidden');
            contentList.classList.add('hidden');
            renderCustomerCalendar();
        } else {
            btnList.className = 'pb-3 border-b-2 border-primary text-primary flex items-center gap-1.5 focus:outline-none';
            btnCal.className = 'pb-3 border-b-2 border-transparent text-primary/60 hover:text-primary flex items-center gap-1.5 focus:outline-none';
            contentList.classList.remove('hidden');
            contentCal.classList.add('hidden');
        }
    }

    {{-- A second toggleMoreRooms() further down shadowed this one, so it never
         ran. Removed as dead code; behaviour is unchanged. REVIEW.md H-13. --}}

    function selectRoomAndOpenCalendar(roomId) {
        calActiveRoomId = roomId;
        const select = document.getElementById('calendar-room-select');
        if (select) select.value = roomId;
        openAvailabilityModal();
        switchAvailabilityTab('calendar');
    }

    function onCalendarRoomChange(val) {
        calActiveRoomId = parseInt(val);
        renderCustomerCalendar();
    }

    function changeCalendarMonth(delta) {
        calMonth += delta;
        if (calMonth < 0) {
            calMonth = 11;
            calYear--;
        } else if (calMonth > 11) {
            calMonth = 0;
            calYear++;
        }
        renderCustomerCalendar();
    }

    function renderCustomerCalendar() {
        const label = document.getElementById('calendar-month-label');
        if (label) {
            label.innerText = `${monthNamesPl[calMonth]} ${calYear}`;
        }

        const room = allRoomsData.find(r => r.id == calActiveRoomId) || allRoomsData[0];
        const roomInfoName = document.getElementById('selected-room-info-name');
        if (roomInfoName && room) {
            roomInfoName.innerText = `Kalendarz dla: ${room.name}`;
        }

        const grid = document.getElementById('calendar-days-grid');
        if (!grid) return;
        grid.innerHTML = '';

        const firstDayIndex = (new Date(calYear, calMonth, 1).getDay() + 6) % 7; // Monday = 0
        const daysInMonth = new Date(calYear, calMonth + 1, 0).getDate();
        const todayStr = new Date().toISOString().split('T')[0];

        // Empty lead cells
        for (let i = 0; i < firstDayIndex; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.className = 'aspect-square rounded-xl bg-transparent';
            grid.appendChild(emptyCell);
        }

        // Days cells
        for (let day = 1; day <= daysInMonth; day++) {
            const mStr = String(calMonth + 1).padStart(2, '0');
            const dStr = String(day).padStart(2, '0');
            const dateStr = `${calYear}-${mStr}-${dStr}`;

            const isBooked = room?.booked_ranges?.some(r => dateStr >= r.from && dateStr <= r.to);
            const isPast = dateStr < todayStr;
            const isToday = dateStr === todayStr;

            const cell = document.createElement('div');
            cell.className = 'aspect-square rounded-xl flex flex-col items-center justify-center text-xs transition-all relative cursor-pointer group';

            if (isBooked) {
                cell.className += ' bg-rose-50/80 text-rose-400 border border-rose-200/80 line-through cursor-not-allowed font-medium';
                cell.innerHTML = `<span class="font-semibold text-xs">${day}</span>`;
            } else if (isPast) {
                cell.className += ' bg-slate-50 text-slate-300 border border-transparent cursor-not-allowed font-normal';
                cell.innerHTML = `<span class="text-xs">${day}</span>`;
            } else {
                cell.className += ' bg-white text-slate-800 border border-slate-200/90 font-semibold hover:border-emerald-500 hover:bg-emerald-50/80 hover:text-emerald-800 shadow-xs';
                if (isToday) {
                    cell.className += ' ring-2 ring-primary ring-offset-1 font-bold';
                }
                cell.innerHTML = `
                    <span class="text-xs font-semibold">${day}</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-0.5 group-hover:scale-125 transition-transform"></span>
                `;
            }

            grid.appendChild(cell);
        }
    }

    // Room Slideshow Logic
    document.addEventListener('DOMContentLoaded', () => {
        const slideshows = document.querySelectorAll('.room-slideshow');
        slideshows.forEach(slideshow => {
            const images = slideshow.querySelectorAll('.room-image');
            if (images.length <= 1) return;
            
            let currentIndex = 0;
            const interval = parseInt(slideshow.getAttribute('data-interval')) || 4500;
            
            setInterval(() => {
                images[currentIndex].classList.replace('opacity-100', 'opacity-0');
                currentIndex = (currentIndex + 1) % images.length;
                images[currentIndex].classList.replace('opacity-0', 'opacity-100');
            }, interval);
        });
    });

    {{-- Modale pokoi (room1/2/3) usunięte: nic nie wywoływało openRoomModal(),
         więc nie dało się ich otworzyć, a zawierały ceny zakodowane na sztywno,
         sprzeczne z rooms.price_per_night. Zostaje tylko obsługa Escape dla
         działającego kalendarza dostępności. --}}
    document.addEventListener('DOMContentLoaded', () => {
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeAvailabilityModal();
            }
        });
    });

    // Accordion FAQ interaction logic
    function toggleFaq(button) {
        const currentItem = button.closest('.faq-item');
        const content = currentItem.querySelector('.faq-content');
        const icon = currentItem.querySelector('.faq-icon');
        
        const isOpen = content.classList.contains('grid-rows-[1fr]');
        
        document.querySelectorAll('.faq-item').forEach(item => {
            const itemContent = item.querySelector('.faq-content');
            const itemIcon = item.querySelector('.faq-icon');
            itemContent.classList.remove('grid-rows-[1fr]');
            itemContent.classList.add('grid-rows-[0fr]');
            itemIcon.classList.remove('rotate-180');
            item.classList.remove('bg-primary/[0.03]');
        });
        
        if (!isOpen) {
            content.classList.remove('grid-rows-[0fr]');
            content.classList.add('grid-rows-[1fr]');
            icon.classList.add('rotate-180');
            currentItem.classList.add('bg-primary/[0.03]');
        }
    }

    // Room Card Gallery Controls (< > arrows and thumbnails)
    function changeRoomImage(roomId, index) {
        const card = document.querySelector(`[data-room-card="${roomId}"]`);
        if (!card) return;
        
        const slides = card.querySelectorAll('.room-slide-img');
        const thumbs = card.querySelectorAll('.room-thumb');
        const counter = card.querySelector('.room-img-counter');

        if (!slides.length) return;

        let targetIndex = (index + slides.length) % slides.length;

        slides.forEach((img, i) => {
            if (i === targetIndex) {
                img.classList.remove('opacity-0', 'pointer-events-none');
                img.classList.add('opacity-100');
            } else {
                img.classList.remove('opacity-100');
                img.classList.add('opacity-0', 'pointer-events-none');
            }
        });

        thumbs.forEach((thumb, i) => {
            if (i === targetIndex) {
                thumb.classList.add('border-amber-300', 'ring-1', 'ring-amber-300', 'scale-105', 'opacity-100');
                thumb.classList.remove('border-white/40', 'opacity-60');
            } else {
                thumb.classList.remove('border-amber-300', 'ring-1', 'ring-amber-300', 'scale-105', 'opacity-100');
                thumb.classList.add('border-white/40', 'opacity-60');
            }
        });

        if (counter) {
            counter.textContent = `${targetIndex + 1} — ${slides.length}`;
        }

        card.setAttribute('data-active-index', targetIndex);
    }

    function prevRoomImage(roomId, event) {
        if (event) event.stopPropagation();
        const card = document.querySelector(`[data-room-card="${roomId}"]`);
        if (!card) return;
        const currentIndex = parseInt(card.getAttribute('data-active-index') || '0', 10);
        changeRoomImage(roomId, currentIndex - 1);
    }

    function nextRoomImage(roomId, event) {
        if (event) event.stopPropagation();
        const card = document.querySelector(`[data-room-card="${roomId}"]`);
        if (!card) return;
        const currentIndex = parseInt(card.getAttribute('data-active-index') || '0', 10);
        changeRoomImage(roomId, currentIndex + 1);
    }

    function toggleMoreRooms() {
        const container = document.getElementById('more-rooms-container');
        const text = document.getElementById('more-rooms-text');
        const icon = document.getElementById('more-rooms-icon');
        if (!container) return;

        if (container.classList.contains('hidden')) {
            container.classList.remove('hidden');
            if (text) text.textContent = 'Zwiń pozostałe pokoje i domki';
            if (icon) icon.textContent = 'expand_less';
        } else {
            container.classList.add('hidden');
            if (text) text.textContent = 'Pokaż pozostałe pokoje i domki (7 Obiektów)';
            if (icon) icon.textContent = 'expand_more';
        }
    }

    const allGalleryItemsData = @json($galleryImages ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

    {{-- Wszystkie miniatury budujemy w DOM zamiast wstrzykiwać HTML: adres
         zdjęcia pochodzi z panelu i cudzysłów w nazwie pliku wyrwałby się
         z atrybutu src. REVIEW.md H-4. --}}
    function buildThumbImage(url, idx) {
        const img = document.createElement('img');
        img.src = url;
        img.className = 'w-full h-full object-cover';
        img.alt = `Miniatura ${idx + 1}`;
        return img;
    }

    {{-- Zwraca 11-znakowe ID filmu albo null. Dzięki temu adres iframe'a
         powstaje z samego ID, a nie z niezaufanego pola video_url. --}}
    function extractYouTubeId(url) {
        const match = String(url).match(
            /(?:youtube\.com\/(?:watch\?(?:[^#]*&)?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/
        );
        return match ? match[1] : null;
    }
    let lightboxMode = 'room'; // 'room' or 'gallery'
    let currentLightboxRoom = null;
    let currentLightboxImgIndex = 0;
    let currentGalleryIndex = 0;

    function openRoomLightbox(roomId) {
        lightboxMode = 'room';
        const room = allRoomsData.find(r => r.id === roomId);
        if (!room) return;
        currentLightboxRoom = room;
        currentLightboxImgIndex = 0;

        let resolvedImages = [];
        if (Array.isArray(room.images) && room.images.length > 0) {
            resolvedImages = room.images;
        } else if (room.main_image) {
            resolvedImages = [room.main_image];
        } else {
            resolvedImages = ['https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1200&q=80'];
        }
        currentLightboxRoom._resolvedImages = resolvedImages;

        const typeEl = document.getElementById('lightbox-room-type');
        const titleEl = document.getElementById('lightbox-room-title');
        const priceEl = document.getElementById('lightbox-price');
        const callFooter = document.getElementById('lightbox-call-footer');

        if (typeEl) typeEl.textContent = room.room_type || 'Pokój';
        if (titleEl) titleEl.textContent = room.name || '';
        if (callFooter) callFooter.style.display = 'flex';
        
        if (priceEl) {
            priceEl.textContent = `Pojemność: do ${room.capacity || 2} os.`;
        }

        const amenitiesContainer = document.getElementById('lightbox-amenities-tags');
        if (amenitiesContainer) {
            amenitiesContainer.innerHTML = '';
            if (Array.isArray(room.amenities)) {
                room.amenities.forEach(am => {
                    const tag = document.createElement('span');
                    tag.className = 'bg-emerald-50 text-emerald-800 text-[11px] px-3 py-1 rounded-full border border-emerald-200/80 font-semibold shadow-2xs';
                    tag.textContent = `✓ ${am}`;
                    amenitiesContainer.appendChild(tag);
                });
            }
        }

        renderLightboxStage();

        const modal = document.getElementById('room-lightbox-modal');
        if (modal) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            document.body.style.overflow = 'hidden';
        }
    }

    function openGalleryLightbox(index) {
        lightboxMode = 'gallery';
        if (!allGalleryItemsData || allGalleryItemsData.length === 0) return;
        currentGalleryIndex = (index + allGalleryItemsData.length) % allGalleryItemsData.length;

        const callFooter = document.getElementById('lightbox-call-footer');
        if (callFooter) callFooter.style.display = 'none';

        const amenitiesContainer = document.getElementById('lightbox-amenities-tags');
        if (amenitiesContainer) amenitiesContainer.innerHTML = '';

        renderLightboxStage();

        const modal = document.getElementById('room-lightbox-modal');
        if (modal) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeRoomLightbox() {
        const modal = document.getElementById('room-lightbox-modal');
        if (modal) {
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'auto';
        }
        const videoStage = document.getElementById('lightbox-video-stage');
        if (videoStage) videoStage.innerHTML = '';
    }

    let currentZoomLevel = 1.0;

    function zoomInLightboxImage() {
        const img = document.getElementById('lightbox-main-img');
        if (!img) return;
        if (currentZoomLevel === 1.0) {
            currentZoomLevel = 1.75;
        } else if (currentZoomLevel < 2.5) {
            currentZoomLevel += 0.5;
        } else {
            currentZoomLevel = 1.0;
        }
        applyLightboxZoom(img);
    }

    function zoomOutLightboxImage() {
        const img = document.getElementById('lightbox-main-img');
        if (!img) return;
        if (currentZoomLevel > 1.0) {
            currentZoomLevel -= 0.5;
            if (currentZoomLevel < 1.0) currentZoomLevel = 1.0;
        } else {
            currentZoomLevel = 1.0;
        }
        applyLightboxZoom(img);
    }

    function resetLightboxZoom() {
        currentZoomLevel = 1.0;
        const img = document.getElementById('lightbox-main-img');
        if (img) applyLightboxZoom(img);
    }

    function applyLightboxZoom(img) {
        if (!img) return;
        img.style.transform = `scale(${currentZoomLevel})`;
        img.style.transformOrigin = 'center center';
        img.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        img.style.cursor = currentZoomLevel > 1.0 ? 'zoom-out' : 'zoom-in';
    }

    function renderLightboxStage() {
        resetLightboxZoom();
        const mainImg = document.getElementById('lightbox-main-img');
        const videoStage = document.getElementById('lightbox-video-stage');
        const counter = document.getElementById('lightbox-counter');
        const thumbsContainer = document.getElementById('lightbox-thumbs');
        const typeEl = document.getElementById('lightbox-room-type');
        const titleEl = document.getElementById('lightbox-room-title');

        if (mainImg) {
            mainImg.classList.remove('scale-150', 'cursor-zoom-out');
            mainImg.classList.add('scale-100', 'cursor-zoom-in');
        }

        if (lightboxMode === 'room') {
            if (!currentLightboxRoom || !currentLightboxRoom._resolvedImages) return;
            const images = currentLightboxRoom._resolvedImages;
            currentLightboxImgIndex = (currentLightboxImgIndex + images.length) % images.length;

            let currentImgUrl = images[currentLightboxImgIndex];
            if (!currentImgUrl.startsWith('http')) {
                currentImgUrl = '/storage/' + currentImgUrl;
            }

            if (videoStage) { videoStage.classList.add('hidden'); videoStage.innerHTML = ''; }
            if (mainImg) {
                mainImg.classList.remove('hidden');
                mainImg.src = currentImgUrl;
                mainImg.alt = `${currentLightboxRoom.name} - Zdjęcie ${currentLightboxImgIndex + 1}`;
            }

            if (counter) counter.textContent = `${currentLightboxImgIndex + 1} / ${images.length}`;

            if (thumbsContainer) {
                thumbsContainer.innerHTML = '';
                images.forEach((imgUrl, idx) => {
                    let fullUrl = imgUrl.startsWith('http') ? imgUrl : ('/storage/' + imgUrl);
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = `w-14 h-10 rounded-md overflow-hidden shrink-0 border-2 transition-all ${idx === currentLightboxImgIndex ? 'border-primary ring-2 ring-primary scale-105 opacity-100' : 'border-slate-300 opacity-60 hover:opacity-100'}`;
                    btn.onclick = (e) => {
                        e.stopPropagation();
                        currentLightboxImgIndex = idx;
                        renderLightboxStage();
                    };
                    btn.replaceChildren(buildThumbImage(fullUrl, idx));
                    thumbsContainer.appendChild(btn);
                });
            }
        } else if (lightboxMode === 'gallery') {
            if (!allGalleryItemsData || allGalleryItemsData.length === 0) return;
            currentGalleryIndex = (currentGalleryIndex + allGalleryItemsData.length) % allGalleryItemsData.length;
            const item = allGalleryItemsData[currentGalleryIndex];

            if (typeEl) typeEl.textContent = 'Galeria MIRiOLA';
            if (titleEl) titleEl.textContent = item.title || 'Galeria Obiektu';

            if (counter) counter.textContent = `${currentGalleryIndex + 1} / ${allGalleryItemsData.length}`;

            const isVideo = (item.media_type === 'video') || !!item.video_url;
            let imgUrl = item.image ? (item.image.startsWith('http') ? item.image : '/storage/' + item.image) : '';

            if (item.video_url) {
                if (mainImg) mainImg.classList.add('hidden');
                if (videoStage) {
                    videoStage.classList.remove('hidden');
                    const vUrl = String(item.video_url);
                    const ytId = extractYouTubeId(vUrl);
                    if (ytId) {
                        // Adres budowany z samego ID, nigdy z surowego pola —
                        // inaczej "https://zly.pl/#youtube.com" trafiłby do src.
                        const frame = document.createElement('iframe');
                        frame.className = 'w-full h-full max-h-[60vh] aspect-video rounded-lg shadow-2xl';
                        frame.src = 'https://www.youtube.com/embed/' + encodeURIComponent(ytId) + '?autoplay=1';
                        frame.setAttribute('frameborder', '0');
                        frame.setAttribute('allow', 'autoplay; encrypted-media');
                        frame.setAttribute('allowfullscreen', '');
                        videoStage.replaceChildren(frame);
                    } else {
                        const video = document.createElement('video');
                        video.controls = true;
                        video.autoplay = true;
                        video.className = 'max-h-[60vh] max-w-full rounded-lg shadow-2xl';
                        const source = document.createElement('source');
                        // Wszystko, co nie jest http(s), ląduje pod /storage/,
                        // więc schematy javascript: i data: nigdy nie ożyją.
                        source.src = /^https?:\/\//i.test(vUrl) ? vUrl : '/storage/' + vUrl;
                        video.appendChild(source);
                        video.appendChild(document.createTextNode('Twoja przeglądarka nie obsługuje tagu video.'));
                        videoStage.replaceChildren(video);
                    }
                }
            } else {
                if (videoStage) { videoStage.classList.add('hidden'); videoStage.innerHTML = ''; }
                if (mainImg) {
                    mainImg.classList.remove('hidden');
                    mainImg.src = imgUrl || 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80';
                    mainImg.alt = item.title || 'Zdjęcie galerii';
                }
            }

            if (thumbsContainer) {
                thumbsContainer.innerHTML = '';
                allGalleryItemsData.forEach((gItem, idx) => {
                    let fullUrl = gItem.image ? (gItem.image.startsWith('http') ? gItem.image : '/storage/' + gItem.image) : '';
                    let isV = (gItem.media_type === 'video') || !!gItem.video_url;
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = `relative w-14 h-10 rounded-md overflow-hidden shrink-0 border-2 transition-all ${idx === currentGalleryIndex ? 'border-primary ring-2 ring-primary scale-105 opacity-100' : 'border-slate-300 opacity-60 hover:opacity-100'}`;
                    btn.onclick = (e) => {
                        e.stopPropagation();
                        currentGalleryIndex = idx;
                        renderLightboxStage();
                    };
                    if (fullUrl) {
                        btn.replaceChildren(buildThumbImage(fullUrl, idx));
                        if (isV) {
                            const overlay = document.createElement('span');
                            overlay.className = 'absolute inset-0 bg-black/40 flex items-center justify-center text-white';
                            const playIcon = document.createElement('span');
                            playIcon.className = 'material-symbols-outlined text-sm';
                            playIcon.textContent = 'play_arrow';
                            overlay.appendChild(playIcon);
                            btn.appendChild(overlay);
                        }
                    } else {
                        const placeholder = document.createElement('div');
                        placeholder.className = 'w-full h-full bg-slate-800 flex items-center justify-center text-white';
                        const movieIcon = document.createElement('span');
                        movieIcon.className = 'material-symbols-outlined text-sm';
                        movieIcon.textContent = 'movie';
                        placeholder.appendChild(movieIcon);
                        btn.replaceChildren(placeholder);
                    }
                    thumbsContainer.appendChild(btn);
                });
            }
        }
    }

    function prevLightboxImg() {
        if (lightboxMode === 'room') {
            if (!currentLightboxRoom) return;
            currentLightboxImgIndex--;
        } else if (lightboxMode === 'gallery') {
            currentGalleryIndex--;
        }
        renderLightboxStage();
    }

    function nextLightboxImg() {
        if (lightboxMode === 'room') {
            if (!currentLightboxRoom) return;
            currentLightboxImgIndex++;
        } else if (lightboxMode === 'gallery') {
            currentGalleryIndex++;
        }
        renderLightboxStage();
    }

    document.addEventListener('keydown', (e) => {
        const modal = document.getElementById('room-lightbox-modal');
        if (modal && !modal.classList.contains('opacity-0')) {
            if (e.key === 'Escape') closeRoomLightbox();
            if (e.key === 'ArrowLeft') prevLightboxImg();
            if (e.key === 'ArrowRight') nextLightboxImg();
        }
    });

    function scrollGalleryLeft() {
        const container = document.getElementById('gallery-scroll-container');
        if (container) container.scrollBy({ left: -360, behavior: 'smooth' });
    }

    function scrollGalleryRight() {
        const container = document.getElementById('gallery-scroll-container');
        if (container) container.scrollBy({ left: 360, behavior: 'smooth' });
    }
</script>
@endsection
