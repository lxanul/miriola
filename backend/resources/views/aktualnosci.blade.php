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
    <section class="py-section-gap-mobile md:py-section-gap bg-background min-h-screen">
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
            </div>

            <!-- Articles Full-Screen Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($news ?? [] as $article)
                    <article class="group bg-surface rounded-2xl overflow-hidden border border-primary/10 ambient-shadow hover:shadow-xl hover:-translate-y-1.5 transition-all flex flex-col justify-between" data-aos="fade-up">
                        <div class="cursor-pointer" onclick="openNewsModal(@js($article->title), @js($article->published_at ? $article->published_at->format('d.m.Y') : now()->format('d.m.Y')), @js($article->content ?? $article->excerpt ?? ''), @js($article->image ? (str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image)) : ''), @js($article->video_url ?? ''))">
                            <!-- Article Card Media (Image or Video Thumbnail) -->
                            <div class="relative h-48 bg-surface-variant overflow-hidden">
                                @if($article->image)
                                    <img src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" 
                                         alt="{{ $article->title }}" 
                                         loading="lazy" decoding="async" width="400" height="250"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-primary/5 text-primary/30">
                                        <span class="material-symbols-outlined text-5xl">{{ $article->video_url ? 'play_circle' : 'newspaper' }}</span>
                                    </div>
                                @endif

                                @if($article->video_url)
                                    <div class="absolute inset-0 bg-slate-950/30 flex items-center justify-center group-hover:bg-slate-950/20 transition-colors">
                                        <div class="w-12 h-12 rounded-full bg-white/90 backdrop-blur-md flex items-center justify-center text-primary shadow-lg group-hover:scale-110 transition-transform">
                                            <span class="material-symbols-outlined text-3xl">play_arrow</span>
                                        </div>
                                    </div>
                                @endif

                                <!-- Category Badge -->
                                <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-md text-primary font-bold text-[10px] uppercase tracking-wider px-3 py-1 rounded-full shadow-sm border border-white/50 z-10">
                                    @if($article->branch === 'jarmark')
                                        Jarmark Centrum Edukacyjno-Handlowe
                                    @elseif($article->branch === 'resort')
                                        Ośrodek Wypoczynkowy
                                    @else
                                        MIRiOLA
                                    @endif
                                </span>
                            </div>

                            <!-- Article Content Excerpt -->
                            <div class="p-6 space-y-3">
                                <span class="text-xs text-primary/60 font-semibold block">
                                    {{ $article->published_at ? $article->published_at->format('d.m.Y') : now()->format('d.m.Y') }}
                                </span>
                                <h2 class="font-display font-bold text-primary text-xl leading-snug group-hover:text-accent transition-colors">
                                    {{ $article->title }}
                                </h2>
                                <p class="text-xs text-on-surface-variant leading-relaxed font-normal">
                                    {{ $article->excerpt ?? Str::limit($article->content, 140) }}
                                </p>
                            </div>
                        </div>

                        <!-- Read Full Article Trigger -->
                        <div class="p-6 pt-0">
                            <button onclick="openNewsModal(@js($article->title), @js($article->published_at ? $article->published_at->format('d.m.Y') : now()->format('d.m.Y')), @js($article->content ?? $article->excerpt ?? ''), @js($article->image ? (str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image)) : ''), @js($article->video_url ?? ''))"
                                    class="w-full bg-primary/5 hover:bg-primary hover:text-white text-primary font-bold text-xs py-3 rounded-xl transition-all btn-animate flex items-center justify-center gap-2">
                                <span>{{ $article->video_url ? 'Obejrzyj materiał wideo' : 'Przeczytaj pełny wpis' }}</span>
                                <span class="material-symbols-outlined text-base">{{ $article->video_url ? 'play_circle' : 'arrow_forward' }}</span>
                            </button>
                        </div>
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

    <!-- Full Article Modal (Pełny ekran wiadomości z obsługą Wideo) -->
    <div id="news-modal" onclick="closeNewsModal()" class="fixed inset-0 bg-primary/60 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div onclick="event.stopPropagation()" class="bg-surface border border-primary/15 rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl relative p-6 md:p-8 space-y-6">
            <button onclick="closeNewsModal()" aria-label="Zamknij" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-primary/5 hover:bg-primary hover:text-white flex items-center justify-center transition-colors z-20">
                <span class="material-symbols-outlined">close</span>
            </button>

            <!-- Modal Video / Media Container -->
            <div id="modal-video-container" class="hidden rounded-xl overflow-hidden bg-black"></div>

            <!-- Modal Header Image -->
            <div id="modal-image-container" class="relative h-64 bg-slate-100 hidden rounded-xl overflow-hidden">
                <img id="modal-news-image" src="" alt="Zdjęcie artykułu aktualności MIRiOLA" class="w-full h-full object-cover">
            </div>

            <div class="space-y-2">
                <span id="modal-date" class="text-xs text-primary/60 font-semibold block"></span>
                <h2 id="modal-title" class="font-display text-2xl md:text-3xl font-bold text-primary"></h2>
            </div>

            <div id="modal-content" class="text-sm text-on-surface-variant leading-relaxed space-y-4 pt-4 border-t border-primary/10"></div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function openNewsModal(title, date, content, image, videoUrl) {
        document.getElementById('modal-title').textContent = title || 'Aktualność MIRiOLA';
        document.getElementById('modal-date').textContent = date || '';
        
        const contentEl = document.getElementById('modal-content');
        if (content && content.trim() !== '') {
            // textContent + pre-line, not innerHTML: content is unsanitized admin
            // input and executed as markup here. See REVIEW.md H-1.
            contentEl.textContent = content;
            contentEl.style.whiteSpace = 'pre-line';
            contentEl.classList.remove('hidden');
        } else {
            contentEl.innerHTML = '';
            contentEl.classList.add('hidden');
        }

        const videoContainer = document.getElementById('modal-video-container');
        videoContainer.innerHTML = '';
        
        if (videoUrl && videoUrl.trim() !== '') {
            videoContainer.classList.remove('hidden');
            if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
                let embedUrl = videoUrl;
                if (videoUrl.includes('watch?v=')) {
                    embedUrl = videoUrl.replace('watch?v=', 'embed/');
                } else if (videoUrl.includes('youtu.be/')) {
                    embedUrl = videoUrl.replace('youtu.be/', 'youtube.com/embed/');
                }
                videoContainer.innerHTML = `<iframe src="${embedUrl}" class="w-full h-72 rounded-xl" frameborder="0" allowfullscreen></iframe>`;
            } else {
                const src = videoUrl.startsWith('http') ? videoUrl : `/storage/${videoUrl}`;
                videoContainer.innerHTML = `<video src="${src}" controls autoplay class="w-full h-72 rounded-xl object-cover bg-black"></video>`;
            }
        } else {
            videoContainer.classList.add('hidden');
        }

        const imgContainer = document.getElementById('modal-image-container');
        const img = document.getElementById('modal-news-image');
        if (image && image.trim() !== '' && (!videoUrl || videoUrl.trim() === '')) {
            img.src = image;
            imgContainer.classList.remove('hidden');
        } else {
            if (img) img.src = '';
            if (imgContainer) imgContainer.classList.add('hidden');
        }

        const modal = document.getElementById('news-modal');
        if (modal) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeNewsModal() {
        const modal = document.getElementById('news-modal');
        if (modal) {
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'auto';
        }
        // Stop video playback (YouTube iframe / HTML5 video) on close
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
