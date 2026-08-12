<?php

namespace App\Observers;

use App\Services\ImageOptimizer;
use Illuminate\Database\Eloquent\Model;

class MediaOptimizeObserver
{
    /**
     * Media columns per model. The old global list named hero_image/cover_image
     * (which exist nowhere) and missed main_image, so RestaurantHall was
     * observed but never optimized. See REVIEW.md H-10.
     */
    private const FIELDS = [
        \App\Models\GalleryImage::class => ['image'],
        \App\Models\Room::class => ['images'],
        \App\Models\News::class => ['image'],
        \App\Models\CafeMenuItem::class => ['image'],
        \App\Models\FarmProduct::class => ['image'],
        \App\Models\Attraction::class => ['image'],
        \App\Models\RestaurantHall::class => ['main_image'],
    ];

    public function saved(Model $model): void
    {
        foreach (self::FIELDS[$model::class] ?? [] as $field) {
            // Without this guard every unrelated edit (toggling is_published)
            // re-uploaded to TinyPNG and re-encoded, compounding artifacts and
            // burning paid API quota. See REVIEW.md H-9.
            if (! $model->wasChanged($field) && ! $model->wasRecentlyCreated) {
                continue;
            }

            $value = $model->{$field};
            if (empty($value)) {
                continue;
            }

            // Guard non-strings: a null inside Room::images would otherwise be a
            // TypeError that 500s the whole save.
            $optimized = is_array($value)
                ? array_map(fn ($p) => is_string($p) ? $this->optimizePath($p) : $p, $value)
                : (is_string($value) ? $this->optimizePath($value) : $value);

            // The old code discarded the return value, so the DB kept pointing at
            // the original and the .webp was dead weight. See REVIEW.md H-8.
            // saveQuietly: applies the model's casts (Room::images is an array)
            // and does not re-fire this observer.
            if ($optimized !== $value) {
                $model->setAttribute($field, $optimized);
                $model->saveQuietly();
            }
        }
    }

    /** @return string the storage-relative path to serve (new .webp, or the original) */
    private function optimizePath(string $path): string
    {
        if (str_starts_with($path, 'http')) {
            return $path;
        }

        $root = realpath(storage_path('app/public'));
        $fullPath = realpath(storage_path('app/public/'.$path));

        // A DB value of ../../.. resolved outside the storage root and was then
        // overwritten by the optimizer. See REVIEW.md H-6.
        if (! $root || ! $fullPath || ! str_starts_with($fullPath, $root.DIRECTORY_SEPARATOR)) {
            return $path;
        }

        $new = ImageOptimizer::optimizeAndConvertToWebp($fullPath);
        if ($new === $fullPath) {
            return $path;
        }

        // Deliberately NOT unlinking the original: Filament's edit form still
        // holds the pre-optimization path after save, and a second save would
        // write it back — leaving the DB pointing at a file we had deleted.
        // Orphan cleanup belongs in a scheduled command, not here.

        // substr, not str_replace: containment is already proven above, and
        // str_replace would strip every occurrence rather than the prefix.
        return substr($new, strlen($root) + 1);
    }
}
