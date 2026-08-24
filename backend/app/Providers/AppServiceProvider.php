<?php

namespace App\Providers;

use App\Models\Attraction;
use App\Models\CafeMenuItem;
use App\Models\FarmProduct;
use App\Models\GalleryImage;
use App\Models\News;
use App\Models\RestaurantHall;
use App\Models\Room;
use App\Models\User;
use App\Observers\MediaOptimizeObserver;
use Illuminate\Support\Facades\Gate;
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

        // Żaden model nie ma klasy Policy, więc bez tego canEdit/canCreate/canDelete
        // w Filamencie domyślnie zwracają true dla każdego zalogowanego usera panelu —
        // canViewAny() na Resource chowa tylko nawigację i listę, nie blokuje
        // bezpośredniego wejścia pod /admin/{resource}/{id}/edit. Redaktor Aktualności
        // mógłby więc edytować pokoje, rezerwacje, konta itd. wpisując URL ręcznie.
        Gate::before(function (User $user, string $ability, array $arguments = []) {
            if ($user->isAdmin()) {
                return true;
            }

            if ($user->isNewsEditor()) {
                $subject = $arguments[0] ?? null;
                $model = is_object($subject) ? $subject::class : $subject;

                return $model === News::class;
            }

            return false;
        });
    }
}
