@extends('layouts.app')

@section('title', 'Gospodarstwo Ogrodniczo-Pszczelarskie MIRiOLA | Czosnek, Borówki i Miody')
@section('meta_description', 'Gospodarstwo Ogrodniczo-Pszczelarskie MIRiOLA w dolinie Skawy. Oferujemy 3 rodzaje naturalnego czosnku, świeże borówki oraz naturalne miody z własnej pasieki.')
@section('og_image', asset('assets/img/gospodarstwo-hero.webp'))

@section('head')
    <link rel="preload" as="image" href="{{ asset('assets/img/gospodarstwo-hero.webp') }}" fetchpriority="high">
@endsection

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": ["LocalBusiness", "Farm"],
  "@@id": "{{ url('/gospodarstwo') }}#farm",
  "name": "Gospodarstwo Ogrodniczo-Pszczelarskie MIRiOLA",
  "description": "Naturalne uprawy ogrodniczne i pasieka w dolinie Skawy. W ofercie: czosnek (3 odmiany), borówki amerykańskie oraz miody naturalne z własnej pasieki.",
  "image": "{{ asset('assets/img/gospodarstwo-hero.webp') }}",
  "url": "{{ url('/gospodarstwo') }}",
  "telephone": "+48608103119",
  "email": "miroslawzadora@wp.pl",
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
  "hasOfferCatalog": {
    "@@type": "OfferCatalog",
    "name": "Produkty rolne MIRiOLA",
    "itemListElement": [
      {"@@type": "Offer", "itemOffered": {"@@type": "Product", "name": "Czosnek naturalny"}},
      {"@@type": "Offer", "itemOffered": {"@@type": "Product", "name": "Borówki amerykańskie"}},
      {"@@type": "Offer", "itemOffered": {"@@type": "Product", "name": "Miody naturalne"}}
    ]
  },
  "parentOrganization": { "@@id": "{{ url('/') }}#resort" }
}
</script>
@endsection

@section('content')
    <!-- Hero Section Gospodarstwo Ogrodniczo-Pszczelarskie -->
    <section id="start" class="relative w-full h-[75vh] min-h-[520px] flex items-center justify-center bg-slate-900 overflow-hidden">
        <!-- Hero Background Image -->
        <div class="absolute inset-0 bg-cover bg-center opacity-100 scale-100 hover:scale-105 transition-transform duration-1000" 
             style="background-image: url('{{ asset('assets/img/gospodarstwo-hero.webp') }}')">
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
                {{ !empty($cms['gospodarstwo_hero_title']) ? $cms['gospodarstwo_hero_title'] : 'Gospodarstwo Ogrodniczo-Pszczelarskie MIRiOLA' }}
            </h1>
            <p class="font-body text-base md:text-lg lg:text-body-lg mb-8 max-w-2xl mx-auto font-medium text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.85)]">
                {{ !empty($cms['gospodarstwo_hero_description']) ? $cms['gospodarstwo_hero_description'] : 'Tradycyjna uprawa i naturalne plony w czystym mikroklimacie Doliny Skawy. Prosto z naszych pól i pasieki oferujemy 3 rodzaje naturalnego czosnku, świeże borówki, naturalne miody oraz domowe przetwory i nie tylko.' }}
            </p>

            <div class="flex flex-col sm:flex-row flex-wrap justify-center gap-3 sm:gap-4 px-2 max-w-full">
                <a href="#produkty" class="bg-accent text-white font-bold py-3 sm:py-3.5 px-4 sm:px-8 rounded-xl hover:bg-opacity-95 hover:shadow-lg btn-animate inline-flex items-center justify-center gap-2 text-sm sm:text-base max-w-full focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2">
                    <span class="material-symbols-outlined text-[20px] shrink-0">shopping_basket</span>
                    <span>Zobacz Ofertę Plonów</span>
                </a>
                <a href="tel:{{ !empty($cms['gospodarstwo_phone']) ? preg_replace('/\s+/', '', $cms['gospodarstwo_phone']) : '+48608103119' }}" class="bg-white/15 hover:bg-white/25 text-white font-bold py-3 sm:py-3.5 px-4 sm:px-8 rounded-xl border border-white/30 backdrop-blur-sm btn-animate inline-flex items-center justify-center gap-2 text-sm sm:text-base max-w-full">
                    <span class="material-symbols-outlined text-[20px] shrink-0">call</span>
                    <span>Zamów Telefonicznie: <span class="whitespace-nowrap">{{ !empty($cms['gospodarstwo_phone']) ? $cms['gospodarstwo_phone'] : '608 103 119' }}</span></span>
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
                <p class="text-sm md:text-base text-slate-600 font-medium max-w-2xl mx-auto leading-relaxed">
                    {{ !empty($cms['gospodarstwo_cert_info']) ? $cms['gospodarstwo_cert_info'] : 'Gospodarstwo prowadzi Rolniczy Handel Detaliczny (RHD) i jest zarejestrowane w Sanepidzie. Skontaktuj się z nami telefonicznie, aby potwierdzić aktualną dostępność i ustalić termin odbioru!' }}
                </p>
            </div>

            <!-- Products Grid (Centered Flex Layout for 3 Products or Any Count) -->
            <div class="flex flex-wrap justify-center gap-8">
                @forelse($farmProducts ?? [] as $product)
                    @php
                        $prodImages = $product->images_urls;
                        if (empty($prodImages) && !empty($product->image_url)) {
                            $prodImages = [$product->image_url];
                        }
                    @endphp
                    <div class="w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] max-w-sm bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group" data-aos="fade-up">
                        <div>
                            <!-- Image Box with Lightbox Trigger & Inline Arrows -->
                            <div class="aspect-square w-full bg-slate-100 relative overflow-hidden flex items-center justify-center select-none"
                                 id="product-card-box-{{ $product->id }}">
                                
                                @if(!empty($prodImages))
                                    <!-- Main Display Image (Click to open Lightbox) -->
                                    <img id="product-card-img-{{ $product->id }}"
                                         src="{{ $prodImages[0] }}" 
                                         alt="{{ $product->name }}" 
                                         loading="lazy" 
                                         decoding="async" 
                                         width="400" 
                                         height="400"
                                         onclick="openProductLightbox({{ $product->id }})"
                                         class="w-full h-full object-cover cursor-pointer group-hover:scale-105 transition-transform duration-500 {{ !$product->is_available ? 'grayscale opacity-75' : '' }}">

                                    @if(count($prodImages) > 1)
                                        <!-- Prev Slide Button -->
                                        <button type="button" 
                                                onclick="slideProductCard({{ $product->id }}, -1, event)" 
                                                aria-label="Poprzednie zdjęcie oferty"
                                                class="absolute left-2.5 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/55 hover:bg-black/85 text-white flex items-center justify-center backdrop-blur-md transition-all z-20 shadow-md opacity-90 sm:opacity-0 sm:group-hover:opacity-100 focus:opacity-100">
                                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                                        </button>

                                        <!-- Next Slide Button -->
                                        <button type="button" 
                                                onclick="slideProductCard({{ $product->id }}, 1, event)" 
                                                aria-label="Następne zdjęcie oferty"
                                                class="absolute right-2.5 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/55 hover:bg-black/85 text-white flex items-center justify-center backdrop-blur-md transition-all z-20 shadow-md opacity-90 sm:opacity-0 sm:group-hover:opacity-100 focus:opacity-100">
                                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                                        </button>

                                        <!-- Image Counter Badge in Bottom Right -->
                                        <div id="product-card-counter-{{ $product->id }}" 
                                             onclick="openProductLightbox({{ $product->id }})"
                                             class="absolute bottom-3 right-3 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-black/65 text-white backdrop-blur-md shadow-md z-10 cursor-pointer flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[13px]">photo_library</span>
                                            <span>1 / {{ count($prodImages) }}</span>
                                        </div>
                                    @endif
                                @else
                                    <!-- Elegant Product Icon Placeholder -->
                                    <div class="w-full h-full bg-emerald-50/70 flex flex-col items-center justify-center p-6 text-center group-hover:scale-105 transition-transform duration-500">
                                        <div class="w-20 h-20 rounded-2xl bg-emerald-100/80 text-emerald-800 flex items-center justify-center shadow-inner mb-3">
                                            <span class="material-symbols-outlined text-4xl" style="color: #065f46;">eco</span>
                                        </div>
                                        <span class="text-xs uppercase tracking-wider font-bold text-slate-800" style="color: #1e293b;">Produkt Gospodarstwa</span>
                                    </div>
                                @endif

                                <!-- Top Badges Container -->
                                <div class="absolute inset-x-0 top-0 p-3 flex items-start justify-between gap-2 z-10 pointer-events-none">
                                    <!-- Status Badge (High Contrast Solid Colors) -->
                                    <span class="text-[11px] font-bold px-3 py-1 rounded-full shadow-md flex items-center gap-1.5 backdrop-blur-md {{ $product->is_available ? 'badge-available' : 'badge-unavailable' }}"
                                          style="background-color: {{ $product->is_available ? '#047857' : '#1e293b' }} !important; color: #ffffff !important; border: 1px solid rgba(255, 255, 255, 0.25) !important;">
                                        <span class="w-2 h-2 rounded-full {{ $product->is_available ? 'bg-white animate-pulse' : 'bg-slate-400' }}" style="background-color: {{ $product->is_available ? '#ffffff' : '#94a3b8' }};"></span>
                                        <span style="color: #ffffff !important; font-weight: 700;">{{ $product->is_available ? 'Dostępny' : 'Niedostępny' }}</span>
                                    </span>

                                    @if(!empty($prodImages))
                                        <!-- Quick Zoom Button -->
                                        <button type="button" 
                                                onclick="openProductLightbox({{ $product->id }})" 
                                                aria-label="Powiększ galerię zdjęć"
                                                class="w-8 h-8 rounded-full bg-black/50 hover:bg-black/80 text-white flex items-center justify-center backdrop-blur-md shadow-md transition-all pointer-events-auto">
                                            <span class="material-symbols-outlined text-base">zoom_in</span>
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-6">
                                <h3 class="font-display font-bold text-primary text-xl leading-snug group-hover:text-accent transition-colors">
                                    {{ $product->name }}
                                </h3>
                                @if(!empty($prodImages) && count($prodImages) > 1)
                                    <button type="button" 
                                            onclick="openProductLightbox({{ $product->id }})" 
                                            class="mt-2 text-xs font-semibold text-accent hover:text-accent/80 flex items-center gap-1 transition-colors">
                                        <span class="material-symbols-outlined text-sm">photo_library</span>
                                        <span>Zobacz galerię ({{ count($prodImages) }} zdjęcia)</span>
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Phone Order CTA Button -->
                        <div class="p-6 pt-0">
                            @if($product->is_available)
                                <a href="tel:{{ $product->phone_contact ?? (!empty($cms['gospodarstwo_phone']) ? preg_replace('/\s+/', '', $cms['gospodarstwo_phone']) : '+48608103119') }}" 
                                   class="w-full bg-primary text-white text-center font-bold text-xs py-3.5 px-4 rounded-xl hover:bg-primary/95 transition-all shadow-sm hover:shadow-md btn-animate flex items-center justify-center gap-2 whitespace-nowrap">
                                    <span class="material-symbols-outlined text-base shrink-0">call</span>
                                    <span>Zadzwoń i zamów</span>
                                </a>
                            @else
                                <a href="tel:{{ $product->phone_contact ?? (!empty($cms['gospodarstwo_phone']) ? preg_replace('/\s+/', '', $cms['gospodarstwo_phone']) : '+48608103119') }}" 
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

            <!-- Allegro Lokalnie Section (Styled exactly like Section Header) -->
            <div class="mt-20 text-center max-w-2xl mx-auto" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-primary/70 font-bold block mb-2">Zakupy Online</span>
                <h3 class="font-display text-3xl md:text-headline-md text-primary font-bold mb-4">
                    {{ !empty($cms['gospodarstwo_allegro_text']) ? $cms['gospodarstwo_allegro_text'] : 'Istnieje możliwość zakupu na Allegro Lokalnie' }}
                </h3>
                <div class="w-16 h-0.5 bg-primary/20 mx-auto mb-4"></div>
                <p class="text-sm md:text-base text-slate-600 font-medium max-w-2xl mx-auto leading-relaxed mb-8">
                    Zamawiaj nasze naturalne plony, naturalny czosnek i miody z bezpieczną płatnością i szybką dostawą lub odbiorem osobistym.
                </p>

                <div class="flex justify-center">
                    <a href="{{ !empty($cms['gospodarstwo_allegro_url']) ? $cms['gospodarstwo_allegro_url'] : 'https://allegrolokalnie.pl' }}" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       style="background-color: #ff5a00; color: #ffffff;"
                       class="hover:opacity-95 font-bold text-sm sm:text-base py-3.5 sm:py-4 px-8 sm:px-10 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 inline-flex items-center justify-center gap-3 focus:outline-none focus:ring-4 focus:ring-[#ff5a00]/30 btn-animate">
                        <span class="material-symbols-outlined text-[22px]">shopping_cart</span>
                        <span class="text-white font-bold">Kup na Allegro Lokalnie</span>
                        <span class="material-symbols-outlined text-lg">open_in_new</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Full-Screen Farm Product Photo Lightbox Modal -->
    <div id="product-lightbox-modal" 
         class="fixed inset-0 z-[100] bg-slate-950/95 backdrop-blur-md hidden flex flex-col transition-opacity duration-300 opacity-0"
         role="dialog" 
         aria-modal="true" 
         aria-label="Podgląd galerii produktu">
        
        <!-- Lightbox Top Navigation Bar -->
        <div class="relative z-10 flex items-center justify-between px-4 sm:px-6 py-4 bg-slate-950/70 border-b border-white/10 shrink-0">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-emerald-400 text-2xl">eco</span>
                <div>
                    <h3 id="product-lightbox-title" class="font-display font-bold text-white text-base sm:text-lg leading-tight">
                        Produkt Rolny
                    </h3>
                    <p id="product-lightbox-counter" class="text-xs text-slate-400 font-medium mt-0.5">
                        1 / 1
                    </p>
                </div>
            </div>

            <!-- Action Controls (Zoom & Close) -->
            <div class="flex items-center gap-2">
                <button type="button" 
                        onclick="toggleProductLightboxZoom()" 
                        title="Powiększ / zmniejsz zdjęcie"
                        class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
                    <span id="product-lightbox-zoom-icon" class="material-symbols-outlined text-xl">zoom_in</span>
                </button>
                <button type="button" 
                        onclick="closeProductLightbox()" 
                        aria-label="Zamknij podgląd galerii"
                        class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-500/80 text-white flex items-center justify-center transition-colors">
                    <span class="material-symbols-outlined text-2xl">close</span>
                </button>
            </div>
        </div>

        <!-- Lightbox Main Stage (Large Image with Left/Right Arrows) -->
        <div class="relative flex-1 min-h-0 flex items-center justify-center p-4 sm:p-6 select-none overflow-hidden" 
             onclick="handleProductLightboxBackdropClick(event)">
            
            <!-- Left Arrow Button -->
            <button type="button" 
                    id="product-lightbox-prev-btn"
                    onclick="changeProductLightboxIndex(-1)" 
                    aria-label="Poprzednie zdjęcie"
                    class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-black/60 hover:bg-white/20 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-xl z-20">
                <span class="material-symbols-outlined text-3xl">chevron_left</span>
            </button>

            <!-- Main Stage Image Container -->
            <div class="relative max-w-5xl max-h-full flex items-center justify-center overflow-hidden">
                <img id="product-lightbox-main-img" 
                     src="" 
                     alt="Zdjęcie produktu rolnego" 
                     class="max-w-full max-h-[68vh] md:max-h-[72vh] object-contain rounded-xl shadow-2xl transition-transform duration-300 cursor-zoom-in"
                     onclick="toggleProductLightboxZoom()">
            </div>

            <!-- Right Arrow Button -->
            <button type="button" 
                    id="product-lightbox-next-btn"
                    onclick="changeProductLightboxIndex(1)" 
                    aria-label="Następne zdjęcie"
                    class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-black/60 hover:bg-white/20 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-xl z-20">
                <span class="material-symbols-outlined text-3xl">chevron_right</span>
            </button>
        </div>

        <!-- Lightbox Bottom Navigation Bar & Thumbnails -->
        <div class="relative z-10 px-4 sm:px-6 py-3 bg-slate-950/80 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3 shrink-0">
            <!-- Thumbnails Strip -->
            <div id="product-lightbox-thumbs" class="flex items-center gap-2 overflow-x-auto max-w-full py-1 scrollbar-thin scrollbar-thumb-white/20">
                <!-- Injected dynamically via JS -->
            </div>

            <!-- CTA Order Button in Lightbox -->
            <div class="shrink-0 flex items-center gap-3">
                <a id="product-lightbox-order-btn" 
                   href="tel:+48608103119"
                   class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm py-2.5 px-5 rounded-xl transition-all shadow-md flex items-center gap-2 whitespace-nowrap">
                    <span class="material-symbols-outlined text-base">call</span>
                    <span>Zamów ten produkt</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Client-Side Farm Products Gallery & Lightbox Script -->
    <script>
        const rawFarmProducts = @json($farmProducts ?? []);
        
        // Normalize products mapping with resolved images array
        const farmProductsData = (rawFarmProducts || []).reduce((acc, p) => {
            let imgs = [];
            if (Array.isArray(p.images_urls) && p.images_urls.length > 0) {
                imgs = p.images_urls;
            } else if (Array.isArray(p.images) && p.images.length > 0) {
                imgs = p.images.map(img => {
                    if (img.startsWith('http')) return img;
                    if (img.startsWith('assets/') || img.startsWith('images/')) return '/' + img;
                    return '/storage/' + img.replace(/^\/+/, '');
                });
            } else if (p.image_url) {
                imgs = [p.image_url];
            } else if (p.image) {
                const single = p.image.startsWith('http') ? p.image : (p.image.startsWith('assets/') ? '/' + p.image : '/storage/' + p.image.replace(/^\/+/, ''));
                imgs = [single];
            }
            acc[p.id] = {
                id: p.id,
                name: p.name,
                images: imgs,
                phone: p.phone_contact || '+48608103119',
                is_available: !!p.is_available,
                cardIndex: 0
            };
            return acc;
        }, {});

        // Slide card image without opening lightbox
        function slideProductCard(productId, direction, event) {
            if (event) {
                event.stopPropagation();
            }
            const product = farmProductsData[productId];
            if (!product || !product.images || product.images.length <= 1) return;

            product.cardIndex = (product.cardIndex + direction + product.images.length) % product.images.length;
            
            const imgEl = document.getElementById('product-card-img-' + productId);
            if (imgEl) {
                imgEl.src = product.images[product.cardIndex];
            }
            const counterEl = document.getElementById('product-card-counter-' + productId);
            if (counterEl) {
                counterEl.innerHTML = '<span class="material-symbols-outlined text-[13px]">photo_library</span> ' + (product.cardIndex + 1) + ' / ' + product.images.length;
            }
        }

        // Lightbox State
        let currentLightboxProductId = null;
        let currentLightboxImageIndex = 0;
        let isLightboxZoomed = false;

        function openProductLightbox(productId, imageIndex = null) {
            const product = farmProductsData[productId];
            if (!product || !product.images || product.images.length === 0) return;

            currentLightboxProductId = productId;
            currentLightboxImageIndex = (imageIndex !== null) ? imageIndex : (product.cardIndex || 0);
            isLightboxZoomed = false;

            const modal = document.getElementById('product-lightbox-modal');
            if (!modal) return;

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
            }, 10);
            document.body.style.overflow = 'hidden';

            renderProductLightbox();
        }

        function closeProductLightbox() {
            const modal = document.getElementById('product-lightbox-modal');
            if (!modal) return;

            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
                currentLightboxProductId = null;
                isLightboxZoomed = false;
            }, 300);
        }

        function handleProductLightboxBackdropClick(e) {
            if (e.target.id === 'product-lightbox-main-img' || 
                e.target.closest('#product-lightbox-prev-btn') || 
                e.target.closest('#product-lightbox-next-btn')) {
                return;
            }
            closeProductLightbox();
        }

        function renderProductLightbox() {
            const product = farmProductsData[currentLightboxProductId];
            if (!product) return;

            const titleEl = document.getElementById('product-lightbox-title');
            const counterEl = document.getElementById('product-lightbox-counter');
            const mainImg = document.getElementById('product-lightbox-main-img');
            const thumbsContainer = document.getElementById('product-lightbox-thumbs');
            const orderBtn = document.getElementById('product-lightbox-order-btn');
            const prevBtn = document.getElementById('product-lightbox-prev-btn');
            const nextBtn = document.getElementById('product-lightbox-next-btn');

            if (titleEl) titleEl.textContent = product.name;
            if (counterEl) counterEl.textContent = `${currentLightboxImageIndex + 1} / ${product.images.length}`;

            if (mainImg) {
                mainImg.src = product.images[currentLightboxImageIndex];
                mainImg.alt = `${product.name} - zdjęcie ${currentLightboxImageIndex + 1}`;
                resetProductLightboxZoom();
            }

            if (orderBtn) {
                const rawPhone = (product.phone || '+48608103119').replace(/\s+/g, '');
                orderBtn.href = 'tel:' + rawPhone;
                orderBtn.innerHTML = '<span class="material-symbols-outlined text-base">call</span><span>' + (product.is_available ? 'Zadzwoń i zamów' : 'Zapytaj o dostępność') + '</span>';
            }

            if (product.images.length <= 1) {
                if (prevBtn) prevBtn.classList.add('hidden');
                if (nextBtn) nextBtn.classList.add('hidden');
            } else {
                if (prevBtn) prevBtn.classList.remove('hidden');
                if (nextBtn) nextBtn.classList.remove('hidden');
            }

            // Render Thumbnails
            if (thumbsContainer) {
                thumbsContainer.innerHTML = '';
                if (product.images.length > 1) {
                    product.images.forEach((imgUrl, idx) => {
                        const thumb = document.createElement('button');
                        thumb.type = 'button';
                        thumb.className = `relative w-12 h-12 rounded-lg overflow-hidden border-2 transition-all shrink-0 ${idx === currentLightboxImageIndex ? 'border-emerald-400 ring-2 ring-emerald-400/40 opacity-100 scale-105' : 'border-white/20 opacity-60 hover:opacity-100'}`;
                        thumb.onclick = (e) => {
                            e.stopPropagation();
                            currentLightboxImageIndex = idx;
                            renderProductLightbox();
                        };
                        const thumbImg = document.createElement('img');
                        thumbImg.src = imgUrl;
                        thumbImg.alt = `${product.name} miniatura ${idx + 1}`;
                        thumbImg.className = 'w-full h-full object-cover';
                        thumb.appendChild(thumbImg);
                        thumbsContainer.appendChild(thumb);
                    });
                }
            }
        }

        function changeProductLightboxIndex(dir) {
            const product = farmProductsData[currentLightboxProductId];
            if (!product || !product.images || product.images.length <= 1) return;

            currentLightboxImageIndex = (currentLightboxImageIndex + dir + product.images.length) % product.images.length;
            renderProductLightbox();
        }

        function toggleProductLightboxZoom() {
            const mainImg = document.getElementById('product-lightbox-main-img');
            const icon = document.getElementById('product-lightbox-zoom-icon');
            if (!mainImg) return;

            isLightboxZoomed = !isLightboxZoomed;
            if (isLightboxZoomed) {
                mainImg.style.transform = 'scale(1.65)';
                mainImg.style.cursor = 'zoom-out';
                if (icon) icon.textContent = 'zoom_out';
            } else {
                resetProductLightboxZoom();
            }
        }

        function resetProductLightboxZoom() {
            const mainImg = document.getElementById('product-lightbox-main-img');
            const icon = document.getElementById('product-lightbox-zoom-icon');
            if (!mainImg) return;
            mainImg.style.transform = 'scale(1)';
            mainImg.style.cursor = 'zoom-in';
            isLightboxZoomed = false;
            if (icon) icon.textContent = 'zoom_in';
        }

        // Global keyboard navigation
        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('product-lightbox-modal');
            if (!modal || modal.classList.contains('hidden')) return;

            if (e.key === 'Escape') {
                closeProductLightbox();
            } else if (e.key === 'ArrowLeft') {
                changeProductLightboxIndex(-1);
            } else if (e.key === 'ArrowRight') {
                changeProductLightboxIndex(1);
            }
        });
    </script>
@endsection
