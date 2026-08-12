<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImageOptimizer
{
    /**
     * Compress an image and convert it to WebP format.
     * Uses TinyPNG API if key is provided, with fallback to PHP GD image processing.
     *
     * @param string $fullPath Absolute path to the source image file
     * @param int $quality Quality factor (1-100)
     * @return string Path to the optimized image (or WebP file)
     */
    public static function optimizeAndConvertToWebp(string $fullPath, int $quality = 82): string
    {
        if (!file_exists($fullPath)) {
            return $fullPath;
        }

        $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
            return $fullPath;
        }

        $apiKey = config('services.tinypng.key', env('TINY_PNG_KEY'));

        // 1. Try TinyPNG API if key exists
        if ($apiKey) {
            try {
                $response = Http::withBasicAuth('api', $apiKey)
                    ->withBody(file_get_contents($fullPath), mime_content_type($fullPath))
                    ->post('https://api.tinify.com/shrink');

                if ($response->successful()) {
                    $location = $response->header('Location');
                    if ($location) {
                        $compressedData = Http::withBasicAuth('api', $apiKey)->get($location)->body();
                        if ($compressedData) {
                            file_put_contents($fullPath, $compressedData);
                            Log::info("TinyPNG optimized image successfully: {$fullPath}");
                        }
                    }
                }
            } catch (\Throwable $e) {
                Log::warning("TinyPNG optimization skipped/failed: " . $e->getMessage());
            }
        }

        // 2. Convert to WebP using GD if not already webp
        if ($extension !== 'webp' && function_exists('imagewebp')) {
            $webpPath = pathinfo($fullPath, PATHINFO_DIRNAME) . '/' . pathinfo($fullPath, PATHINFO_FILENAME) . '.webp';
            try {
                $image = null;
                if ($extension === 'png') {
                    $image = @imagecreatefrompng($fullPath);
                    if ($image) {
                        imagealphablending($image, true);
                        imagesavealpha($image, true);
                    }
                } elseif (in_array($extension, ['jpg', 'jpeg'])) {
                    $image = @imagecreatefromjpeg($fullPath);
                }

                if ($image) {
                    imagewebp($image, $webpPath, $quality);
                    imagedestroy($image);
                    return $webpPath;
                }
            } catch (\Throwable $e) {
                Log::warning("GD WebP conversion failed: " . $e->getMessage());
            }
        }

        return $fullPath;
    }
}
