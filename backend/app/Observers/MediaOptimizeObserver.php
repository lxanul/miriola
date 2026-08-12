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

            $optimized = is_array($value)
                ? array_map(fn (string $p): string => $this->optimizePath($p), $value)
                : $this->optimizePath($value);

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

        @unlink($fullPath); // the original is no longer referenced

        return ltrim(str_replace($root, '', $new), DIRECTORY_SEPARATOR);
    }
}
