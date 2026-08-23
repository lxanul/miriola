<?php

use App\Models\Attraction;
use App\Models\CafeMenuItem;
use App\Models\CmsContent;
use App\Models\Faq;
use App\Models\FarmProduct;
use App\Models\GalleryImage;
use App\Models\News;
use App\Models\Room;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

// Helper to fetch database CMS values.
// Strażnik function_exists jest konieczny: pakiet testowy ładuje plik tras przy
// każdym starcie aplikacji, więc bez niego drugi test kończył się fatalnym
// błędem „Cannot redeclare getCmsData()" i cały pakiet nigdy nie przechodził.
// Cache 60 min — dane CMS rzadko się zmieniają. Obserwator CmsContentObserver
// wywołuje Cache::forget('cms_data') przy każdym save().
if (! function_exists('getCmsData')) {
    function getCmsData(): array
    {
        try {
            return Cache::remember('cms_data', 3600, function () {
                return CmsContent::pluck('value', 'key')->toArray();
            });
        } catch (Throwable $e) {
            return [];
        }
    }
}

// 1. Hub Landing Page (3 Squares Selection Hub + Latest News)
Route::get('/', function () {
    $cms = getCmsData();
    $latestNews = News::where('is_published', true)->latest('published_at')->take(3)->get();

    return view('hub', compact('cms', 'latestNews'));
});

// 2. Ośrodek Wypoczynkowy MIRiOLA
Route::get('/osrodek', function () {
    $dbCms = getCmsData();
    $cms = array_merge([
        'meta_title' => 'Ośrodek Wypoczynkowy MIRiOLA - Dolina Skawy, Noclegi blisko Wadowic',
        'meta_description' => 'Zapraszamy do Ośrodka Wypoczynkowego MIRiOLA w dolinie Skawy. Oferujemy komfortowe pokoje, apartamenty, 2 sale restauracyjne i domki letniskowe.',
        'hero_badge' => 'Komfortowe noclegi w dolinie Skawy',
        'hero_title' => $dbCms['osrodek_hero_title'] ?? 'Odkryj spokój w sercu doliny Skawy',
        'hero_description' => $dbCms['osrodek_hero_description'] ?? 'Komfortowe noclegi blisko Wadowic i Jeziora Mucharskiego',
        'rooms_section_title' => 'Pokoje i Domki',
    ], $dbCms);

    $news = News::where('branch', 'resort')->where('is_published', true)->latest()->get();
    // with('reservations'): akcesory is_available_now i booked_ranges liczą
    // z załadowanej relacji, więc lista pokoi to 2 zapytania zamiast ~30.
    $rooms = Room::with('reservations')->orderBy('sort_order')->get();
    $attractions = Attraction::where('branch', 'resort')->orderBy('sort_order')->get();
    // Bez filtra po dziale /osrodek pokazywał też pytania Jarmarku. REVIEW.md H-17.
    $faqs = Faq::where('is_published', true)
        ->whereIn('branch', ['resort', 'general'])
        ->orderBy('sort_order')
        ->get();
    $galleryImages = GalleryImage::where('branch', 'resort')->where('is_published', true)->orderBy('sort_order')->get();

    return view('home', compact('cms', 'news', 'rooms', 'attractions', 'faqs', 'galleryImages'));
});

// 3. Jarmark - CEH & Kawiarnia
Route::get('/jarmark', function () {
    $cms = getCmsData();
    $cafeMenuItems = CafeMenuItem::where('is_available', true)->orderBy('sort_order')->get();
    $attractions = Attraction::where('branch', 'jarmark')->orderBy('sort_order')->get();
    $news = News::where('branch', 'jarmark')->where('is_published', true)->latest()->get();
    $faqs = Faq::where('is_published', true)
        ->whereIn('branch', ['jarmark', 'general'])
        ->orderBy('sort_order')
        ->get();

    return view('jarmark', compact('cafeMenuItems', 'attractions', 'news', 'cms', 'faqs'));
});

// 4. Gospodarstwo Rolne MIRiOLA
Route::get('/gospodarstwo', function () {
    $cms = getCmsData();
    $farmProducts = FarmProduct::orderBy('sort_order')->get();

    return view('gospodarstwo', compact('farmProducts', 'cms'));
});

// 5. Dedykowana Podstrona Aktualności (Wszystkie wpisy na pełnym ekranie)
Route::get('/aktualnosci', function () {
    $cms = getCmsData();
    $currentBranch = request()->query('branch', 'all');

    $query = News::where('is_published', true);
    if ($currentBranch !== 'all' && in_array($currentBranch, ['resort', 'jarmark', 'farm'])) {
        $query->where('branch', $currentBranch);
    }

    $news = $query->latest('published_at')->paginate(12)->withQueryString();

    return view('aktualnosci', compact('news', 'currentBranch', 'cms'));
});

// 6. Dedykowana strona artykułu (SEO – indeksowalna przez Google)
Route::get('/aktualnosci/{slug}', function (string $slug) {
    $article = News::where('slug', $slug)->where('is_published', true)->firstOrFail();

    $related = News::where('is_published', true)
        ->where('id', '!=', $article->id)
        ->where('branch', $article->branch)
        ->latest('published_at')
        ->take(3)
        ->get();

    return view('artykul', compact('article', 'related'));
});

Route::get('/polityka-prywatnosci', function () {
    return view('polityka-prywatnosci');
});

Route::get('/robots.txt', function () {
    $content  = "User-agent: *\n";
    $content .= "Allow: /\n";
    $content .= "Allow: /osrodek\n";
    $content .= "Allow: /jarmark\n";
    $content .= "Allow: /gospodarstwo\n";
    $content .= "Allow: /polityka-prywatnosci\n";
    $content .= "Allow: /aktualnosci\n\n";
    $content .= "Disallow: /admin\n";
    $content .= "Disallow: /admin/\n";
    $content .= "Disallow: /livewire/\n\n";
    $content .= 'Sitemap: ' . url('/sitemap.xml') . "\n";

    return response($content, 200, ['Content-Type' => 'text/plain']);
});

Route::get('/sitemap.xml', function () {
    // Statyczne URL z priorytetami
    $staticUrls = [
        ['loc' => url('/'),              'priority' => '1.0', 'changefreq' => 'daily'],
        ['loc' => url('/osrodek'),       'priority' => '0.9', 'changefreq' => 'daily',   'image' => asset('assets/img/hero.webp'),          'imageTitle' => 'Ośrodek Wypoczynkowy MIRiOLA Dolina Skawy'],
        ['loc' => url('/jarmark'),       'priority' => '0.8', 'changefreq' => 'weekly',  'image' => asset('assets/img/jarmark-hero.webp'),   'imageTitle' => 'Jarmark Centrum Edukacyjno-Handlowe MIRiOLA'],
        ['loc' => url('/gospodarstwo'),  'priority' => '0.8', 'changefreq' => 'weekly',  'image' => asset('assets/img/gospodarstwo-hero.webp'), 'imageTitle' => 'Gospodarstwo Ogrodniczo-Pszczelarskie MIRiOLA'],
        ['loc' => url('/aktualnosci'),   'priority' => '0.7', 'changefreq' => 'daily'],
        ['loc' => url('/polityka-prywatnosci'), 'priority' => '0.3', 'changefreq' => 'monthly'],
    ];

    // Dynamiczne URL artykułów — każdy artykuł ma własną stronę
    $newsUrls = News::where('is_published', true)
        ->select(['slug', 'title', 'image', 'updated_at', 'published_at'])
        ->latest('published_at')
        ->get()
        ->map(fn (News $n) => [
            'loc'        => url('/aktualnosci/' . $n->slug),
            'priority'   => '0.6',
            'changefreq' => 'monthly',
            'lastmod'    => $n->updated_at->format('Y-m-d'),
            'image'      => $n->thumbnail_url,
            'imageTitle' => $n->title,
        ])
        ->toArray();

    $urls = array_merge($staticUrls, $newsUrls);

    $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

    foreach ($urls as $u) {
        $lastmod = $u['lastmod'] ?? date('Y-m-d');
        $xml .= "  <url>\n";
        $xml .= '    <loc>' . htmlspecialchars($u['loc']) . "</loc>\n";
        $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
        $xml .= '    <changefreq>' . $u['changefreq'] . "</changefreq>\n";
        $xml .= '    <priority>' . $u['priority'] . "</priority>\n";
        if (! empty($u['image'])) {
            $xml .= "    <image:image>\n";
            $xml .= '      <image:loc>' . htmlspecialchars($u['image']) . "</image:loc>\n";
            $xml .= '      <image:title>' . htmlspecialchars($u['imageTitle'] ?? '') . "</image:title>\n";
            $xml .= "    </image:image>\n";
        }
        $xml .= "  </url>\n";
    }
    $xml .= '</urlset>';

    return response($xml, 200, ['Content-Type' => 'text/xml']);
});
