@extends('layouts.app')

@section('title', 'Aktualności i Wydarzenia | MIRiOLA Dolina Skawy')
@section('meta_description', 'Bądź na bieżąco z najnowszymi wydarzeniami i aktualnościami z Ośrodka Wypoczynkowego oraz Jarmarku MIRiOLA.')

@section('content')
    <!-- Hero Banner Aktualności (Clean Gradient & Ambient Glow) -->
    <section class="relative bg-gradient-to-br from-primary via-[#0f2d26] to-[#0a1e19] text-white py-16 md:py-24 px-gutter overflow-hidden border-b border-primary/20">
        <!-- Ambient Decorative Glowing Orbs -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-accent/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-primary/30 rounded-full blur-2xl pointer-events-none"></div>
        
        <div class="max-w-container-max mx-auto relative z-10">
            <div class="max-w-3xl space-y-4" data-aos="fade-right">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 text-xs text-amber-200 hover:text-white font-bold uppercase tracking-widest mb-2 transition-colors">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Powrót do wyboru działalności
                </a>
                
                <h1 class="font-display text-4xl md:text-5xl font-bold tracking-tight leading-tight text-white">
                    Aktualności & Wydarzenia MIRiOLA
                </h1>
                <p class="text-surface-dim/90 text-sm md:text-base leading-relaxed font-light">
                    Wszystkie najnowsze wiadomości, zapowiedzi wydarzeń kulturalnych oraz informacji z życia Ośrodka i Jarmarku w jednym miejscu.
                </p>
            </div>
        </div>
    </section>

    <!-- Branch Filter Tabs & Articles Section -->
    <section class="py-section-gap-mobile md:py-section-gap bg-background flex-grow">
        <div class="max-w-container-max mx-auto px-gutter">
            
            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap items-center justify-center gap-3 mb-16" data-aos="fade-up">
                <a href="{{ url('/aktualnosci?branch=all') }}" 
                   class="px-5 py-2.5 rounded-full text-xs font-bold transition-all border shadow-sm flex items-center gap-2 {{ $currentBranch === 'all' ? 'bg-primary text-white border-primary shadow-md' : 'bg-surface text-on-surface-variant hover:text-primary border-primary/10' }}">
                    <span class="material-symbols-outlined text-base">newspaper</span>
                    Wszystkie Aktualności
                </a>
                <a href="{{ url('/aktualnosci?branch=resort') }}" 
                   class="px-5 py-2.5 rounded-full text-xs font-bold transition-all border shadow-sm flex items-center gap-2 {{ $currentBranch === 'resort' ? 'bg-primary text-white border-primary shadow-md' : 'bg-surface text-on-surface-variant hover:text-primary border-primary/10' }}">
                    <span class="material-symbols-outlined text-base">cottage</span>
                    Ośrodek Wypoczynkowy
                </a>
                <a href="{{ url('/aktualnosci?branch=jarmark') }}" 
                   class="px-5 py-2.5 rounded-full text-xs font-bold transition-all border shadow-sm flex items-center gap-2 {{ $currentBranch === 'jarmark' ? 'bg-primary text-white border-primary shadow-md' : 'bg-surface text-on-surface-variant hover:text-primary border-primary/10' }}">
                    <span class="material-symbols-outlined text-base">storefront</span>
                    Jarmark Centrum Edukacyjno-Handlowe
                </a>
                <a href="{{ url('/aktualnosci?branch=farm') }}" 
                   class="px-5 py-2.5 rounded-full text-xs font-bold transition-all border shadow-sm flex items-center gap-2 {{ $currentBranch === 'farm' ? 'bg-primary text-white border-primary shadow-md' : 'bg-surface text-on-surface-variant hover:text-primary border-primary/10' }}">
                    <span class="material-symbols-outlined text-base">eco</span>
                    Gospodarstwo
                </a>
            </div>

            <!-- Articles Full-Screen Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($news ?? [] as $article)
                    <article class="bg-white rounded-3xl overflow-hidden border border-slate-200/70 shadow-[0_10px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_45px_rgba(0,30,64,0.12)] hover:-translate-y-2 hover:border-amber-400/40 transition-all duration-500 flex flex-col h-full group relative cursor-pointer" data-aos="fade-up" itemscope itemtype="https://schema.org/NewsArticle">
                        {{-- Karta jest linkiem do artykułu i otwiera modal po kliknięciu --}}
                        <a href="{{ url('/aktualnosci/' . $article->slug) }}"
                           class="flex flex-col flex-grow justify-between h-full text-left"
                           onclick="event.preventDefault(); openNewsModal({
                               title: @js($article->title),
                               date: @js($article->published_at ? $article->published_at->format('d.m.Y') : ($article->created_at ? $article->created_at->format('d.m.Y') : now()->format('d.m.Y'))),
                               excerpt: @js($article->excerpt ?? ''),
                               content: @js($article->content ?? ''),
                               image: @js($article->image_url ?? $article->thumbnail_url ?? ''),
                               videoUrl: @js($article->video_url ?? ''),
                               branch: @js($article->branch),
                               url: @js(url('/aktualnosci/' . $article->slug))
                           })"
                           itemprop="url">
                            <div>
                                <!-- Article Card Media (Image or Video Thumbnail) -->
                                <div class="aspect-[16/10] w-full bg-slate-950 relative overflow-hidden shrink-0" style="aspect-ratio: 16/10;">
                                    <img src="{{ $article->thumbnail_url }}"
                                         alt="{{ $article->title }}"
                                         loading="lazy" decoding="async" width="400" height="250"
                                         onerror="this.onerror=null; this.src='{{ asset('assets/img/' . ($article->branch === 'jarmark' ? 'jarmark-hero.webp' : ($article->branch === 'farm' ? 'gospodarstwo-hero.webp' : 'hero.webp'))) }}';"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                         itemprop="image">

                                    <!-- Gradient Overlay over image for contrast -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/15 to-transparent pointer-events-none"></div>

                                    @if($article->video_url)
                                        <!-- Video Label Badge in Top Right -->
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

                                    <!-- Category Badge in Top Left (High Contrast Solid Colors) -->
                                    <span class="absolute top-3.5 left-3.5 text-[11px] font-bold px-3 py-1 rounded-full shadow-md backdrop-blur-md text-white border border-white/20 z-10 {{ $article->branch === 'resort' ? 'badge-branch-resort' : ($article->branch === 'jarmark' ? 'badge-branch-jarmark' : ($article->branch === 'farm' ? 'badge-branch-farm' : 'bg-slate-800')) }}"
                                          style="background-color: {{ $article->branch === 'resort' ? '#001e40' : ($article->branch === 'jarmark' ? '#b45309' : ($article->branch === 'farm' ? '#047857' : '#1e293b')) }} !important; color: #ffffff !important;">
                                        @if($article->branch === 'jarmark')
                                            ☕ Jarmark
                                        @elseif($article->branch === 'resort')
                                            🏡 Ośrodek
                                        @elseif($article->branch === 'farm')
                                            🌿 Gospodarstwo
                                        @else
                                            🌐 MIRiOLA
                                        @endif
                                    </span>
                                </div>

                                <!-- Article Content Excerpt -->
                                <div class="p-6 md:p-7 space-y-3">
                                    <div class="flex items-center gap-1.5 text-[11px] text-amber-700 font-bold uppercase tracking-wider">
                                        <span class="material-symbols-outlined text-sm text-amber-600">calendar_month</span>
                                        <time itemprop="datePublished" datetime="{{ $article->published_at?->toIso8601String() }}">
                                            {{ $article->published_at ? $article->published_at->format('d.m.Y') : ($article->created_at ? $article->created_at->format('d.m.Y') : now()->format('d.m.Y')) }}
                                        </time>
                                    </div>
                                    <h2 class="font-display font-bold text-slate-900 text-lg md:text-xl leading-snug group-hover:text-amber-600 transition-colors line-clamp-2 [overflow-wrap:anywhere] break-words" itemprop="headline">
                                        {{ $article->title }}
                                    </h2>
                                    @if(!empty($article->excerpt) || !empty(strip_tags($article->content)))
                                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed font-normal line-clamp-3 [overflow-wrap:anywhere] break-words" itemprop="description">
                                            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
                                        </p>
                                    @elseif($article->video_url)
                                        <div class="inline-flex items-center gap-1.5 text-xs text-amber-900/90 font-medium bg-amber-50 px-3 py-2 rounded-xl border border-amber-200/60 mt-1">
                                            <span class="material-symbols-outlined text-base text-amber-600">play_circle</span>
                                            <span>Kliknij, aby obejrzeć materiał wideo</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Read Full Article Footer CTA -->
                            <div class="px-6 pb-6 pt-0 mt-auto">
                                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-amber-700 group-hover:text-amber-800 transition-colors">
                                    <span>{{ $article->video_url ? 'Obejrzyj wideo' : 'Przeczytaj pełny wpis' }}</span>
                                    <span class="w-8 h-8 rounded-full bg-amber-50 group-hover:bg-amber-500 group-hover:text-slate-950 flex items-center justify-center transition-all duration-300 shadow-sm">
                                        @if($article->video_url)
                                            <span class="material-symbols-outlined text-lg group-hover:scale-115 transition-transform duration-300 ml-0.5">play_arrow</span>
                                        @else
                                            <span class="material-symbols-outlined text-base group-hover:translate-x-1 transition-transform duration-300">arrow_forward</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </a>
                        {{-- Fallback: direct link for bots/no-JS --}}
                        <noscript>
                            <a href="{{ url('/aktualnosci/' . $article->slug) }}" class="sr-only">Czytaj: {{ $article->title }}</a>
                        </noscript>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-20 text-on-surface-variant">
                        <span class="material-symbols-outlined text-5xl text-primary/20 mb-3">newspaper</span>
                        <p class="text-base font-semibold text-primary">Brak artykułów w tej kategorii.</p>
                        <p class="text-xs mt-1">Sprawdź pozostałe kategorie lub wróc tu niebawem!</p>
                    </div>
                @endforelse
            </div>

            @if(method_exists($news, 'links') && $news->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Full Article Modal (Nowoczesne okno z eleganckim layoutem, pełną responsywnością i brakiem niepożądanych scrolli) -->
    <div id="news-modal" class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-6 bg-slate-950/75 backdrop-blur-md opacity-0 pointer-events-none invisible transition-all duration-300" onclick="closeNewsModal()">
        
        <div id="modal-wrapper" class="relative w-full max-w-2xl flex justify-center items-center my-auto transition-all duration-300 max-h-[92vh]">
            <!-- Modal Card Container (Płynne, jednolite okno bez sztucznego wewnętrznego paska przewijania) -->
            <div id="news-modal-card" class="bg-white rounded-3xl w-full max-h-[90vh] overflow-y-auto modal-scrollbar shadow-2xl border border-slate-200/80 relative transform scale-95 transition-all duration-300" onclick="event.stopPropagation()">
                
                <!-- Single Floating Close Button on Card -->
                <button onclick="closeNewsModal()" aria-label="Zamknij okno" class="absolute top-4 right-4 z-30 w-10 h-10 rounded-full bg-slate-900/65 hover:bg-slate-900 text-white backdrop-blur-md shadow-lg border border-white/20 flex items-center justify-center transition-all duration-200 hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-amber-400 cursor-pointer group">
                    <span class="material-symbols-outlined text-xl group-hover:rotate-90 transition-transform duration-200">close</span>
                </button>

                <!-- Media Header Wrapper (Image or Video) -->
                <div id="modal-media-wrapper" class="relative w-full bg-slate-950 overflow-hidden hidden">
                    <!-- Video Container -->
                    <div id="modal-video-container" class="hidden w-full"></div>
                    
                    <!-- Image Container -->
                    <div id="modal-image-container" class="hidden w-full max-h-[300px] sm:max-h-[360px] bg-slate-950 flex items-center justify-center relative overflow-hidden">
                        <img id="modal-news-image" 
                             src="" 
                             alt="Zdjęcie artykułu MIRiOLA" 
                             onerror="this.onerror=null; this.parentElement.classList.add('hidden'); document.getElementById('modal-media-wrapper').classList.add('hidden');"
                             class="w-full h-full max-h-[300px] sm:max-h-[360px] object-cover sm:object-contain bg-slate-950">
                    </div>
                </div>

                <!-- Modal Body (Naturalny przepływ treści bez wewnętrznego ucinania) -->
                <div id="modal-scroll-body" class="p-6 sm:p-7 space-y-4 [overflow-wrap:anywhere] break-words text-left">
                    <!-- Category Badge & Date Row -->
                    <div class="flex items-center gap-2.5 flex-wrap pr-10">
                        <span id="modal-badge" class="text-[11px] font-bold px-3 py-1 rounded-full text-white bg-primary shadow-sm"></span>
                        <div id="modal-date-wrapper" class="flex items-center gap-1 text-xs text-amber-700 font-bold uppercase tracking-wider">
                            <span class="material-symbols-outlined text-sm text-amber-600">calendar_month</span>
                            <span id="modal-date-text"></span>
                        </div>
                    </div>

                    <!-- Headline Title (Safe from overflow) -->
                    <h2 id="modal-title" class="font-display text-xl sm:text-2xl font-bold text-slate-900 leading-snug [overflow-wrap:anywhere] break-words"></h2>

                    <!-- Article Body Content (Safe from overflow, multi-line support) -->
                    <div id="modal-content" class="text-sm sm:text-base text-slate-700 leading-relaxed space-y-3 pt-3 border-t border-slate-100 hidden [overflow-wrap:anywhere] break-words"></div>

                    <!-- Footer Action Bar -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-3 text-xs">
                        <a id="modal-full-link" href="#" class="inline-flex items-center gap-1.5 font-bold text-amber-700 hover:text-amber-800 transition-colors">
                            <span>Otwórz dedykowaną stronę wpisu</span>
                            <span class="material-symbols-outlined text-sm">open_in_new</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function openNewsModal(data) {
        // Fallback for direct params (backward compatibility)
        if (typeof data === 'string') {
            data = {
                title: arguments[0] || '',
                date: arguments[1] || '',
                content: arguments[2] || '',
                image: arguments[3] || '',
                videoUrl: arguments[4] || '',
                url: arguments[5] || '#'
            };
        }

        const modalWrapper = document.getElementById('modal-wrapper');
        const modalCard = document.getElementById('news-modal-card');
        const mediaWrapper = document.getElementById('modal-media-wrapper');
        const videoContainer = document.getElementById('modal-video-container');
        const imgContainer = document.getElementById('modal-image-container');
        const img = document.getElementById('modal-news-image');
        const titleEl = document.getElementById('modal-title');
        const dateEl = document.getElementById('modal-date-text');
        const dateWrapper = document.getElementById('modal-date-wrapper');
        const badgeEl = document.getElementById('modal-badge');
        const contentEl = document.getElementById('modal-content');
        const fullLink = document.getElementById('modal-full-link');

        // Set Title
        titleEl.textContent = data.title || 'Aktualność MIRiOLA';

        // Set Date
        if (data.date && data.date.trim() !== '') {
            dateEl.textContent = data.date;
            dateWrapper.classList.remove('hidden');
        } else {
            dateEl.textContent = '';
            dateWrapper.classList.add('hidden');
        }

        // Set Category Badge
        const branch = data.branch || '';
        if (branch === 'resort') {
            badgeEl.textContent = '🏡 Ośrodek Wypoczynkowy';
            badgeEl.className = 'text-[11px] font-bold px-3 py-1 rounded-full text-white bg-primary shadow-sm';
            badgeEl.classList.remove('hidden');
        } else if (branch === 'jarmark') {
            badgeEl.textContent = '☕ Jarmark & Kawiarnia';
            badgeEl.className = 'text-[11px] font-bold px-3 py-1 rounded-full text-white bg-amber-700 shadow-sm';
            badgeEl.classList.remove('hidden');
        } else if (branch === 'farm') {
            badgeEl.textContent = '🌿 Gospodarstwo';
            badgeEl.className = 'text-[11px] font-bold px-3 py-1 rounded-full text-white bg-emerald-700 shadow-sm';
            badgeEl.style.backgroundColor = '#047857';
            badgeEl.style.color = '#ffffff';
            badgeEl.classList.remove('hidden');
        } else {
            badgeEl.textContent = '🌐 MIRiOLA';
            badgeEl.className = 'text-[11px] font-bold px-3 py-1 rounded-full text-white bg-slate-800 shadow-sm';
            badgeEl.classList.remove('hidden');
        }

        // Set Link
        if (data.url && data.url !== '#') {
            fullLink.href = data.url;
            fullLink.classList.remove('hidden');
        } else {
            fullLink.classList.add('hidden');
        }

        // Set Content with safe lead accent line without duplicate excerpt
        contentEl.innerHTML = '';
        const textToUse = (data.content && data.content.trim() !== '') ? data.content.trim() : ((data.excerpt && data.excerpt.trim() !== '') ? data.excerpt.trim() : '');

        if (textToUse) {
            const paragraphs = textToUse.split('\n').filter(p => p.trim() !== '');
            if (paragraphs.length > 0) {
                const leadBox = document.createElement('div');
                leadBox.className = 'border-l-4 border-amber-500 bg-amber-50/60 pl-4 py-2.5 rounded-r-xl text-slate-800 font-medium text-sm sm:text-base leading-relaxed';
                leadBox.textContent = paragraphs[0];
                contentEl.appendChild(leadBox);

                if (paragraphs.length > 1) {
                    const restWrapper = document.createElement('div');
                    restWrapper.className = 'space-y-3 pt-2 text-slate-700 leading-relaxed';
                    paragraphs.slice(1).forEach(text => {
                        const p = document.createElement('p');
                        p.className = 'leading-relaxed [overflow-wrap:anywhere] break-words';
                        p.textContent = text;
                        restWrapper.appendChild(p);
                    });
                    contentEl.appendChild(restWrapper);
                }
            }
            contentEl.classList.remove('hidden');
        } else {
            contentEl.classList.add('hidden');
        }

        // Handle Media (Video or Image)
        videoContainer.innerHTML = '';
        videoContainer.classList.add('hidden');
        imgContainer.classList.add('hidden');
        mediaWrapper.classList.add('hidden');

        const videoUrl = data.videoUrl ? data.videoUrl.trim() : '';
        const rawImage = data.image ? data.image.trim() : '';

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
                                    title="${data.title ? encodeURIComponent(data.title) : 'Wideo TikTok'}">
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
            imgContainer.classList.remove('hidden');
            mediaWrapper.classList.remove('hidden');
        } else {
            modalWrapper.style.maxWidth = '680px';
        }

        // Show Modal with Animation
        const modal = document.getElementById('news-modal');
        if (modal) {
            modal.classList.remove('opacity-0', 'pointer-events-none', 'invisible');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            if (modalCard) {
                modalCard.classList.remove('scale-95');
                modalCard.classList.add('scale-100');
            }
            document.body.style.overflow = 'hidden';
        }
    }

    function closeNewsModal() {
        const modal = document.getElementById('news-modal');
        const modalCard = document.getElementById('news-modal-card');
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
        const vc = document.getElementById('modal-video-container');
        if (vc) vc.innerHTML = '';
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeNewsModal();
        }
    });
</script>
@endsection
