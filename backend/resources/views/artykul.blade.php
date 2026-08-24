@extends('layouts.app')

@section('title', $article->title . ' | MIRiOLA ' . match($article->branch) { 'jarmark' => 'Jarmark', 'farm' => 'Gospodarstwo', default => 'Ośrodek Wypoczynkowy' })
@section('meta_description', $article->excerpt ?? Str::limit(strip_tags($article->content ?? ''), 155) ?: 'Przeczytaj artykuł z MIRiOLA Dolina Skawy.')
@section('og_type', 'article')
@section('og_image', $article->thumbnail_url)

@section('schema')
{{-- Canonical per artykuł (nadpisuje og:url w layoucie) --}}
<link rel="canonical" href="{{ url('/aktualnosci/' . $article->slug) }}">

{{-- Article Schema.org JSON-LD --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "NewsArticle",
  "headline": {{ Js::from($article->title) }},
  "description": {{ Js::from($article->excerpt ?? Str::limit(strip_tags($article->content ?? ''), 155)) }},
  "image": {{ Js::from($article->thumbnail_url) }},
  "datePublished": "{{ $article->published_at?->toIso8601String() ?? $article->created_at->toIso8601String() }}",
  "dateModified": "{{ $article->updated_at->toIso8601String() }}",
  "url": "{{ url('/aktualnosci/' . $article->slug) }}",
  "author": {
    "@@type": "Organization",
    "name": "MIRiOLA Dolina Skawy",
    "url": "{{ url('/') }}"
  },
  "publisher": {
    "@@type": "Organization",
    "name": "Ośrodek Wypoczynkowy MIRiOLA",
    "logo": {
      "@@type": "ImageObject",
      "url": "{{ asset('images/logo.webp') }}"
    }
  },
  "mainEntityOfPage": {
    "@@type": "WebPage",
    "@@id": "{{ url('/aktualnosci/' . $article->slug) }}"
  },
  "articleSection": "{{ match($article->branch) { 'jarmark' => 'Jarmark & Kawiarnia', 'farm' => 'Gospodarstwo', default => 'Ośrodek Wypoczynkowy' } }}"
}
</script>

{{-- Open Graph article:published_time --}}
<meta property="article:published_time" content="{{ $article->published_at?->toIso8601String() }}">
<meta property="article:section" content="{{ match($article->branch) { 'jarmark' => 'Jarmark & Kawiarnia', 'farm' => 'Gospodarstwo', default => 'Ośrodek Wypoczynkowy' } }}">
@endsection

@section('content')
<article itemscope itemtype="https://schema.org/NewsArticle" class="flex-grow w-full flex flex-col justify-between">

    {{-- Breadcrumb Navigation --}}
    <nav aria-label="Breadcrumb" class="bg-primary/5 border-b border-primary/10">
        <div class="max-w-4xl mx-auto px-gutter py-3.5">
            <ol class="flex items-center gap-2 text-xs text-on-surface-variant font-medium flex-wrap" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ url('/') }}" itemprop="item" class="hover:text-primary transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">home</span>
                        <span itemprop="name">MIRiOLA</span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li aria-hidden="true"><span class="material-symbols-outlined text-sm text-primary/30">chevron_right</span></li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ url('/aktualnosci') }}" itemprop="item" class="hover:text-primary transition-colors">
                        <span itemprop="name">Aktualności</span>
                    </a>
                    <meta itemprop="position" content="2">
                </li>
                <li aria-hidden="true"><span class="material-symbols-outlined text-sm text-primary/30">chevron_right</span></li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name" class="text-primary font-semibold line-clamp-1">{{ $article->title }}</span>
                    <meta itemprop="position" content="3">
                </li>
            </ol>
        </div>
    </nav>

    {{-- Main Article Container --}}
    <div class="max-w-4xl mx-auto px-gutter py-8 md:py-12 w-full [overflow-wrap:anywhere] break-words">

        {{-- Meta Badges & Info --}}
        <div class="flex items-center gap-3 text-xs mb-4 flex-wrap">
            <span class="font-bold text-[11px] uppercase tracking-wider px-3.5 py-1 rounded-full shadow-sm {{ $article->branch === 'resort' ? 'bg-primary text-white' : ($article->branch === 'jarmark' ? 'bg-amber-700 text-white' : 'bg-slate-800 text-white') }}">
                {{ match($article->branch) { 'jarmark' => '☕ Jarmark & Kawiarnia', 'farm' => '🌿 Gospodarstwo', default => '🏡 Ośrodek Wypoczynkowy' } }}
            </span>
            <time itemprop="datePublished" datetime="{{ $article->published_at?->toIso8601String() }}" class="font-semibold text-amber-700 flex items-center gap-1">
                <span class="material-symbols-outlined text-sm text-amber-600">calendar_month</span>
                {{ $article->published_at ? $article->published_at->format('d.m.Y') : $article->created_at->format('d.m.Y') }}
            </time>
            <span class="text-slate-300">•</span>
            <span class="font-medium text-slate-500 flex items-center gap-1">
                <span class="material-symbols-outlined text-sm text-slate-400">location_on</span>
                MIRiOLA Dolina Skawy
            </span>
        </div>

        {{-- Main Headline --}}
        <h1 itemprop="headline" class="font-display text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-primary leading-tight mb-8 [overflow-wrap:anywhere] break-words">
            {{ $article->title }}
        </h1>

        {{-- Video Player (jeśli artykuł posiada wideo) --}}
        @if($article->video_url)
        <div class="mb-10 rounded-2xl md:rounded-3xl overflow-hidden bg-slate-950 shadow-xl">
            @php
                $videoUrl = $article->video_url;
                $embedHtml = '';
                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^"&?\/ ]{11})/', $videoUrl, $m)) {
                    $embedHtml = '<div class="aspect-video w-full"><iframe src="https://www.youtube.com/embed/' . e($m[1]) . '?rel=0" class="w-full h-full border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen" title="' . e($article->title) . '"></iframe></div>';
                } elseif (str_contains($videoUrl, 'tiktok.com')) {
                    preg_match('/(?:video\/|\/v\/)(\d+)/', $videoUrl, $m);
                    $ttId = $m[1] ?? '';
                    if ($ttId) {
                        $embedHtml = '<div class="w-full bg-slate-950 flex flex-col items-center py-4 px-2">'
                            . '<iframe src="https://www.tiktok.com/player/v1/' . e($ttId) . '?music_info=1&description=1" class="w-full h-[540px] max-h-[65vh] border-0 rounded-2xl shadow-lg" style="max-width: 340px; width: 100%; height: 540px; margin: 0 auto; display: block;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen" title="' . e($article->title) . '"></iframe>'
                            . '<a href="' . e($videoUrl) . '" target="_blank" rel="noopener noreferrer" class="mt-3 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold shadow-md border border-slate-700/80 transition-all hover:scale-105 active:scale-95">'
                            . '<svg class="w-4 h-4 fill-current text-white" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>'
                            . '<span>Otwórz w aplikacji TikTok</span><span class="material-symbols-outlined text-sm">open_in_new</span>'
                            . '</a>'
                            . '</div>';
                    }
                } elseif (str_contains($videoUrl, 'vimeo.com') && preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $m)) {
                    $embedHtml = '<div class="aspect-video w-full"><iframe src="https://player.vimeo.com/video/' . e($m[1]) . '" class="w-full h-full border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen" title="' . e($article->title) . '"></iframe></div>';
                } elseif (preg_match('/\.(mp4|webm)$/i', $videoUrl) || str_starts_with($videoUrl, 'storage/') || str_starts_with($videoUrl, '/storage/')) {
                    $src = str_starts_with($videoUrl, 'http') ? $videoUrl : (str_starts_with($videoUrl, '/') ? $videoUrl : '/' . $videoUrl);
                    $embedHtml = '<video src="' . e($src) . '" controls playsinline webkit-playsinline preload="metadata" class="w-full max-h-[600px] object-contain bg-black"></video>';
                }
            @endphp
            {!! $embedHtml !!}
        </div>
        @endif

        {{-- Primary Image (Pełna widoczność zdjęcia bez ucinania kadrów) --}}
        @if($article->image && ! $article->video_url)
        <div class="mb-10 rounded-2xl md:rounded-3xl overflow-hidden bg-slate-950/5 border border-slate-200/80 shadow-lg flex items-center justify-center relative">
            <img
                src="{{ $article->thumbnail_url }}"
                alt="{{ $article->title }}"
                class="w-full max-h-[650px] md:max-h-[800px] object-contain rounded-2xl md:rounded-3xl"
                fetchpriority="high"
                decoding="async"
                width="1200"
                height="800"
                onerror="this.onerror=null; this.src='{{ asset('assets/img/' . ($article->branch === 'jarmark' ? 'jarmark-hero.webp' : ($article->branch === 'farm' ? 'gospodarstwo-hero.webp' : 'hero.webp'))) }}';"
                itemprop="image"
            >
        </div>
        @endif

        {{-- Main Article Content (Treść Aktualności ze stylową kreską na pierwszym akapicie bez duplikacji) --}}
        @php
            $rawText = !empty($article->content) ? $article->content : ($article->excerpt ?? '');
            $paragraphs = $rawText ? array_values(array_filter(array_map('trim', explode("\n", $rawText)))) : [];
        @endphp

        @if(count($paragraphs) > 0)
        <div itemprop="articleBody" class="prose prose-slate max-w-none text-slate-800 leading-relaxed space-y-4 [overflow-wrap:anywhere] break-words text-base md:text-lg">
            <div class="border-l-4 border-amber-500 bg-amber-50/60 pl-4 sm:pl-5 py-3 rounded-r-2xl text-slate-800 font-medium italic text-lg sm:text-xl leading-relaxed mb-6 not-prose shadow-sm">
                {{ $paragraphs[0] }}
            </div>
            @foreach(array_slice($paragraphs, 1) as $paragraph)
                <p class="leading-relaxed [overflow-wrap:anywhere] break-words">{{ $paragraph }}</p>
            @endforeach
        </div>
        @elseif(! $article->video_url)
        <p class="text-slate-500 text-base italic text-center py-8">
            Brak dodatkowego opisu dla tego wpisu.
        </p>
        @endif

        {{-- CTA Bottom --}}
        <div class="mt-12 pt-8 border-t border-primary/10 flex flex-col sm:flex-row items-center justify-between gap-4">
            <a href="{{ url('/aktualnosci') }}"
               class="inline-flex items-center gap-2 text-primary font-bold text-sm hover:text-amber-600 transition-colors">
                <span class="material-symbols-outlined text-base">arrow_back</span>
                Wróć do wszystkich aktualności
            </a>
            <a href="tel:+48608103119"
               class="bg-accent text-white font-bold px-6 py-3 rounded-xl hover:shadow-lg transition-all btn-animate flex items-center gap-2">
                <span class="material-symbols-outlined text-base">call</span>
                Zadzwoń: 608 103 119
            </a>
        </div>
    </div>

    {{-- Related articles --}}
    @if($related->count())
    <section class="bg-primary/[0.03] border-t border-primary/10 py-12" aria-label="Powiązane artykuły">
        <div class="max-w-container-max mx-auto px-gutter">
            <h2 class="font-display text-2xl font-bold text-primary mb-6">Inne aktualności MIRiOLA</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($related as $rel)
                <a href="{{ url('/aktualnosci/' . $rel->slug) }}"
                   class="group bg-white rounded-xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col">
                    <div class="h-36 bg-slate-100 overflow-hidden shrink-0">
                        <img src="{{ $rel->thumbnail_url }}"
                             alt="{{ $rel->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             loading="lazy"
                             onerror="this.onerror=null; this.src='{{ asset('assets/img/' . ($rel->branch === 'jarmark' ? 'jarmark-hero.webp' : ($rel->branch === 'farm' ? 'gospodarstwo-hero.webp' : 'hero.webp'))) }}';"
                             width="400" height="225">
                    </div>
                    <div class="p-4 flex-grow flex flex-col gap-2">
                        <time class="text-xs text-primary/50 font-semibold">
                            {{ $rel->published_at ? $rel->published_at->format('d.m.Y') : $rel->created_at->format('d.m.Y') }}
                        </time>
                        <h3 class="font-display font-bold text-primary text-sm leading-snug group-hover:text-accent transition-colors line-clamp-2 [overflow-wrap:anywhere] break-words">
                            {{ $rel->title }}
                        </h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</article>
@endsection
