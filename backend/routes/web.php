<?php

use Illuminate\Support\Facades\Route;
use App\Models\News;
use App\Models\RestaurantHall;
use App\Models\CafeMenuItem;
use App\Models\Attraction;
use App\Models\FarmProduct;
use App\Models\CmsContent;

use Illuminate\Support\Facades\Cache;

// Helper to fetch database CMS values.
// Strażnik function_exists jest konieczny: pakiet testowy ładuje plik tras przy
// każdym starcie aplikacji, więc bez niego drugi test kończył się fatalnym
// błędem „Cannot redeclare getCmsData()" i cały pakiet nigdy nie przechodził.
if (! function_exists('getCmsData')) {
    function getCmsData(): array
    {
        try {
            return CmsContent::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
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
    $rooms = \App\Models\Room::with('reservations')->orderBy('sort_order')->get();
    $attractions = Attraction::where('branch', 'resort')->orderBy('sort_order')->get();
    // Bez filtra po dziale /osrodek pokazywał też pytania Jarmarku. REVIEW.md H-17.
    $faqs = \App\Models\Faq::where('is_published', true)
        ->whereIn('branch', ['resort', 'general'])
        ->orderBy('sort_order')
        ->get();
    $galleryImages = \App\Models\GalleryImage::where('branch', 'resort')->where('is_published', true)->orderBy('sort_order')->get();

    return view('home', compact('cms', 'news', 'rooms', 'attractions', 'faqs', 'galleryImages'));
});

// 3. Jarmark - CEH & Kawiarnia
Route::get('/jarmark', function () {
    $cms = getCmsData();
    $cafeMenuItems = CafeMenuItem::where('is_available', true)->orderBy('sort_order')->get();
    $attractions = Attraction::where('branch', 'jarmark')->orderBy('sort_order')->get();
    $news = News::where('branch', 'jarmark')->where('is_published', true)->latest()->get();

    return view('jarmark', compact('cafeMenuItems', 'attractions', 'news', 'cms'));
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

Route::get('/polityka-prywatnosci', function () {
    return view('polityka-prywatnosci');
});

Route::get('/sitemap.xml', function () {
    $sitemapPath = public_path('sitemap.xml');
    return response()->file($sitemapPath, ['Content-Type' => 'text/xml']);
});
