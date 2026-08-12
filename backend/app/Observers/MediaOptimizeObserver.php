<?php

namespace App\Observers;

use App\Services\ImageOptimizer;

class MediaOptimizeObserver
{
    /**
     * Handle the saved event for models with media uploads.
     * Automatically compresses uploaded images and converts them to WebP.
     */
    public function saved($model): void
    {
        $mediaFields = ['image', 'images', 'hero_image', 'cover_image'];

        foreach ($mediaFields as $field) {
            if (isset($model->{$field}) && !empty($model->{$field})) {
                $val = $model->{$field};
                if (is_array($val)) {
                    foreach ($val as $path) {
                        $this->optimizePath($path);
                    }
                } else {
                    $this->optimizePath($val);
                }
            }
        }
    }

    private function optimizePath(?string $path): void
    {
        if (!$path || str_starts_with($path, 'http')) {
            return;
        }

        $fullPath = storage_path('app/public/' . $path);
        if (file_exists($fullPath)) {
            ImageOptimizer::optimizeAndConvertToWebp($fullPath);
        }
    }
}
