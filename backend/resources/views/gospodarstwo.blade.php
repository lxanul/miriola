@extends('layouts.app')

@section('title', 'Gospodarstwo Ogrodniczo-Pszczelarskie MIRiOLA | Ekologiczne Ogórki, Miody i Plony')

@section('styles')
    <link rel="preload" as="image" href="https://images.unsplash.com/photo-1449300079323-02e209d9d3a6?auto=format&fit=crop&w=1600&q=80">
@endsection

@section('content')
    <!-- Hero Section Gospodarstwo Ogrodniczo-Pszczelarskie -->
    <section id="start" class="relative w-full h-[75vh] min-h-[520px] flex items-center justify-center bg-slate-900 overflow-hidden">
        <!-- Hero Background Image -->
        <div class="absolute inset-0 bg-cover bg-center opacity-100 scale-100 hover:scale-105 transition-transform duration-1000" 
             style="background-image: url('https://images.unsplash.com/photo-1449300079323-02e209d9d3a6?auto=format&fit=crop&w=1600&q=80')">
        </div>
        <!-- Bright Light Overlay for Crisp Text Contrast -->
        <div class="absolute inset-0 bg-gradient-to-t from-primary/55 via-primary/25 to-black/15"></div>
        
        <!-- Hero Content -->
        <div class="relative z-10 text-center text-white px-gutter max-w-container-max mx-auto" data-aos="fade-up">
            <div class="inline-flex items-center gap-2.5 bg-white/10 border border-white/20 px-4 py-2 rounded-full mb-6 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                <span class="font-body text-xs uppercase tracking-widest text-white font-semibold">
                    Tradycyjna Uprawa w Dolinie Skawy
                </span>
            </div>
            <h1 class="font-display text-4xl md:text-5xl lg:text-display-lg font-bold mb-6 leading-tight drop-shadow-md max-w-4xl mx-auto text-white">
                Gospodarstwo Ogrodniczo-Pszczelarskie MIRiOLA
            </h1>
            <p class="font-body text-base md:text-lg lg:text-body-lg mb-8 max-w-2xl mx-auto font-medium text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.85)]">
                Tradycyjna uprawa i ekologiczne plony w czystym mikroklimacie Doliny Skawy. Prosto z naszych pól oferujemy świeże ogórki gruntowe, słynne słoiki ogórków kiszonych, miody oraz wiejskie jajka.
            </p>

            <div class="flex flex-col sm:flex-row flex-wrap justify-center gap-3 sm:gap-4 px-2 max-w-full">
                <a href="#produkty" class="bg-accent text-white font-bold py-3 sm:py-3.5 px-4 sm:px-8 rounded-xl hover:bg-opacity-95 hover:shadow-lg btn-animate inline-flex items-center justify-center gap-2 text-sm sm:text-base max-w-full focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2">
                    <span class="material-symbols-outlined text-[20px] shrink-0">shopping_basket</span>
                    <span>Zobacz Ofertę Plonów</span>
                </a>
                <a href="tel:+48608103119" class="bg-white/15 hover:bg-white/25 text-white font-bold py-3 sm:py-3.5 px-4 sm:px-8 rounded-xl border border-white/30 backdrop-blur-sm btn-animate inline-flex items-center justify-center gap-2 text-sm sm:text-base max-w-full">
                    <span class="material-symbols-outlined text-[20px] shrink-0">call</span>
                    <span>Zamów Telefonicznie: <span class="whitespace-nowrap">608 103 119</span></span>
                </a>
            </div>
        </div>
    </section>

    <!-- Product Catalog Section -->
    <section id="produkty" class="py-section-gap-mobile md:py-section-gap bg-background">
        <div class="max-w-container-max mx-auto px-gutter">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-primary/70 font-bold block mb-2">Naturalne Plony</span>
                <h2 class="font-display text-3xl md:text-headline-md text-primary font-bold mb-4">
                    Oferta Produktów Rolnych
                </h2>
                <div class="w-16 h-0.5 bg-primary/20 mx-auto mb-4"></div>
                <p class="text-sm text-slate-600 font-medium">
                    Wszystkie plony pochodzą z naszej certyfikowanej uprawy. Skontaktuj się z nami telefonicznie, aby potwierdzić aktualną dostępność i ustalić termin odbioru!
                </p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($farmProducts ?? [] as $product)
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group" data-aos="fade-up">
                        <div>
                            <!-- Image Box with Status Badge & Price Badge -->
                            <div class="aspect-square w-full bg-slate-100 relative overflow-hidden">
                                @if($product->image)
                                    <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         loading="lazy" decoding="async" width="400" height="400"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 {{ !$product->is_available ? 'grayscale opacity-75' : '' }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-primary/5 text-primary/30">
                                        <span class="material-symbols-outlined text-6xl">eco</span>
                                    </div>
                                @endif

                                <!-- Top Badges Container -->
                                <div class="absolute inset-x-0 top-0 p-3 flex items-start justify-between gap-2 z-10">
                                    <!-- Status Badge -->
                                    <span class="text-[11px] font-bold px-3 py-1 rounded-full shadow-md flex items-center gap-1.5 backdrop-blur-md {{ $product->is_available ? 'bg-emerald-600 text-white' : 'bg-slate-800/90 text-slate-200' }}">
                                        <span class="w-2 h-2 rounded-full {{ $product->is_available ? 'bg-white animate-pulse' : 'bg-slate-400' }}"></span>
                                        {{ $product->is_available ? 'Dostępny' : 'Niedostępny' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-6 space-y-2">
                                <h3 class="font-display font-bold text-primary text-xl leading-snug group-hover:text-accent transition-colors">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-xs md:text-sm text-slate-600 leading-relaxed">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>

                        <!-- Phone Order CTA Button -->
                        <div class="p-6 pt-0">
                            @if($product->is_available)
                                <a href="tel:{{ $product->phone_contact ?? '+48608103119' }}" 
                                   class="w-full bg-primary text-white text-center font-bold text-xs py-3.5 px-4 rounded-xl hover:bg-primary/95 transition-all shadow-sm hover:shadow-md btn-animate flex items-center justify-center gap-2 whitespace-nowrap">
                                    <span class="material-symbols-outlined text-base shrink-0">call</span>
                                    <span>Zadzwoń i zamów</span>
                                </a>
                            @else
                                <a href="tel:{{ $product->phone_contact ?? '+48608103119' }}" 
                                   class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-center font-bold text-xs py-3.5 px-4 rounded-xl transition-colors flex items-center justify-center gap-2 whitespace-nowrap">
                                    <span class="material-symbols-outlined text-base text-slate-500 shrink-0">info</span>
                                    <span>Zapytaj o dostępność</span>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-16 bg-white rounded-2xl border border-slate-200 p-8">
                        <span class="material-symbols-outlined text-5xl text-primary/30 mb-3 block">eco</span>
                        <p class="text-slate-600 font-medium">Brak aktualnie opublikowanych produktów rolnych w ofercie.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
