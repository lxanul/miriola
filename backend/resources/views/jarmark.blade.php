@extends('layouts.app')

@section('title', 'Jarmark - CEH & Kawiarnia MIRiOLA | Menu, Atrakcje, Nowości')

@section('content')
    <!-- Hero Section Jarmark & Kawiarnia -->
    <section id="start" class="relative w-full h-[75vh] min-h-[520px] flex items-center justify-center bg-slate-900 overflow-hidden">
        <!-- Hero Background Image -->
        <div class="absolute inset-0 bg-cover bg-center opacity-100 scale-100 hover:scale-105 transition-transform duration-1000" 
             style="background-image: url('{{ asset('assets/img/jarmark-hero.jpg') }}')">
        </div>
        <!-- Bright Light Overlay for Crisp Text Contrast -->
        <div class="absolute inset-0 bg-gradient-to-t from-primary/55 via-primary/25 to-black/15"></div>
        
        <!-- Hero Content -->
        <div class="relative z-10 text-center text-white px-gutter max-w-container-max mx-auto" data-aos="fade-up">
            <div class="inline-flex items-center gap-2.5 bg-white/10 border border-white/20 px-4 py-2 rounded-full mb-6 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                <span class="font-body text-xs uppercase tracking-widest text-white font-semibold">
                    Kawiarnia Rzemieślnicza & Strefa Plenerowa
                </span>
            </div>
            <h1 class="font-display text-4xl md:text-5xl lg:text-display-lg font-bold mb-6 leading-tight drop-shadow-md max-w-4xl mx-auto text-white">
                Jarmark Centrum Edukacyjno-Handlowe
            </h1>
            <p class="font-body text-base md:text-lg lg:text-body-lg mb-8 max-w-2xl mx-auto font-medium text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.85)]">
                Zapraszamy do naszej kawiarni plenerowej na aromatyczną kawę, domowe ciasta, lody oraz relaks w ogrodzie ze sferycznym namiotem i dmuchańcem dla dzieci.
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

            <!-- Menu Grid (Without Price, Photo + Title + Description) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up">
                @forelse($cafeMenuItems ?? [] as $item)
                    @php
                        $optItemImg = (str_starts_with($item->image ?? '', 'http') && str_contains($item->image, 'unsplash.com'))
                            ? preg_replace('/w=\d+/', 'w=400&q=75', $item->image)
                            : (str_starts_with($item->image ?? '', 'http') ? $item->image : asset('storage/' . ($item->image ?? '')));
                    @endphp
                    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-lg transition-all duration-300 flex items-center gap-5 group hover:-translate-y-0.5">
                        @if($item->image)
                            <img src="{{ $optItemImg }}" 
                                 alt="{{ $item->name }}" 
                                 loading="lazy" decoding="async" width="96" height="96"
                                 class="w-24 h-24 rounded-xl object-cover shrink-0 group-hover:scale-105 transition-transform duration-500 shadow-xs">
                        @else
                            <div class="w-24 h-24 rounded-xl bg-primary/5 flex items-center justify-center text-primary shrink-0 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                <span class="material-symbols-outlined text-4xl">local_cafe</span>
                            </div>
                        @endif
                        <div class="flex-grow min-w-0">
                            <h3 class="font-display font-bold text-primary text-lg md:text-xl group-hover:text-accent transition-colors truncate">
                                {{ $item->name }}
                            </h3>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-16 bg-white rounded-2xl border border-slate-200 p-8">
                        <span class="material-symbols-outlined text-5xl text-primary/30 mb-3 block">local_cafe</span>
                        <p class="text-slate-600 font-medium">Menu kawiarni jest obecnie aktualizowane.</p>
                    </div>
                @endforelse
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

            <!-- Attractions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($attractions ?? [] as $attraction)
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-lg transition-all flex flex-col sm:flex-row group" data-aos="fade-up">
                        @if($attraction->image)
                            <img src="{{ str_starts_with($attraction->image, 'http') ? $attraction->image : asset('storage/' . $attraction->image) }}" 
                                 alt="{{ $attraction->title }}" 
                                 loading="lazy" decoding="async" width="400" height="300"
                                 class="sm:w-56 h-52 sm:h-auto object-cover shrink-0 group-hover:scale-105 transition-transform duration-500">
                        @endif
                        <div class="p-6 flex flex-col justify-between">
                            <div>
                                <div class="w-10 h-10 rounded-full bg-amber-50 border border-amber-200 flex items-center justify-center mb-3">
                                    <span class="material-symbols-outlined text-amber-600 text-xl">{{ $attraction->icon ?? 'star' }}</span>
                                </div>
                                <h3 class="font-display font-bold text-primary text-xl mb-2 group-hover:text-accent transition-colors">
                                    {{ $attraction->title }}
                                </h3>
                                <p class="text-xs md:text-sm text-slate-600 leading-relaxed">
                                    {{ $attraction->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-16 bg-white rounded-2xl border border-slate-200 p-8">
                        <span class="material-symbols-outlined text-5xl text-primary/30 mb-3 block">sparkles</span>
                        <p class="text-slate-600 font-medium">Brak aktualnie zaplanowanych pokazów i atrakcji.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
