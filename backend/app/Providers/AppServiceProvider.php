<?php

namespace App\Providers;

use App\Models\GalleryImage;
use App\Models\Room;
use App\Models\News;
use App\Models\CafeMenuItem;
use App\Models\FarmProduct;
use App\Models\RestaurantHall;
use App\Models\Attraction;
use App\Observers\MediaOptimizeObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Automatyczne kompresowanie i konwersja obrazów po zapisaniu w panelu Admina.
        // CmsContent dropped (no media column); Attraction added (it has one and
        // was previously missed). See REVIEW.md H-10.
        GalleryImage::observe(MediaOptimizeObserver::class);
        Room::observe(MediaOptimizeObserver::class);
        News::observe(MediaOptimizeObserver::class);
        CafeMenuItem::observe(MediaOptimizeObserver::class);
        FarmProduct::observe(MediaOptimizeObserver::class);
        RestaurantHall::observe(MediaOptimizeObserver::class);
        Attraction::observe(MediaOptimizeObserver::class);
    }
}
