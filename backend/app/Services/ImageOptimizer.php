<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImageOptimizer
{
    /** Refuse to decode images that would blow the memory limit. See REVIEW.md H-4. */
    private const MAX_PIXELS = 40_000_000;

    /**
     * Compress an image and convert it to WebP format.
     * Uses TinyPNG API if key is provided, with fallback to PHP GD image processing.
     *
     * @param  string  $fullPath  Absolute path to the source image file
     * @param  int  $quality  Quality factor (1-100)
     * @return string Path to the optimized image (or WebP file)
     */
    public static function optimizeAndConvertToWebp(string $fullPath, int $quality = 82): string
    {
        if (! file_exists($fullPath)) {
            return $fullPath;
        }

        $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
        if (! in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
            return $fullPath;
        }

        [$width, $height] = @getimagesize($fullPath) ?: [0, 0];
        if ($width * $height > self::MAX_PIXELS) {
            Log::warning("Image exceeds pixel budget, skipping: {$fullPath}");

            return $fullPath;
        }

        // config() already resolves TINY_PNG_KEY; the old env() fallback returned
        // null once config:cache had run. See REVIEW.md M-5.
        $apiKey = config('services.tinypng.key');

        if ($apiKey) {
            self::compressWithTinyPng($fullPath, $apiKey);
        }

        if ($extension === 'webp' || ! function_exists('imagewebp')) {
            return $fullPath;
        }

        return self::convertToWebp($fullPath, $extension, $quality);
    }

    private static function compressWithTinyPng(string $fullPath, string $apiKey): void
    {
        try {
            $response = Http::withBasicAuth('api', $apiKey)
                ->timeout(15)
                ->withBody(file_get_contents($fullPath), mime_content_type($fullPath) ?: 'application/octet-stream')
                ->post('https://api.tinify.com/shrink');

            if (! $response->successful()) {
                return;
            }

            $location = $response->header('Location');
            if (! $location || ! str_starts_with($location, 'https://')) {
                return;
            }

            $compressed = Http::withBasicAuth('api', $apiKey)->timeout(15)->get($location);

            // The old code wrote any non-empty body straight over the original, so
            // an error page destroyed the user's image. See REVIEW.md H-5.
            if (! $compressed->successful()
                || ! str_starts_with($compressed->header('Content-Type') ?? '', 'image/')
                || strlen($compressed->body()) < 100) {
                Log::warning("TinyPNG returned a non-image body, keeping original: {$fullPath}");

                return;
            }

            $tmp = $fullPath.'.tmp';
            if (file_put_contents($tmp, $compressed->body()) !== false && @getimagesize($tmp)) {
                rename($tmp, $fullPath);
                Log::info("TinyPNG optimized image successfully: {$fullPath}");
            } else {
                @unlink($tmp);
            }
        } catch (\Throwable $e) {
            Log::warning('TinyPNG optimization skipped/failed: '.$e->getMessage());
        }
    }

    private static function convertToWebp(string $fullPath, string $extension, int $quality): string
    {
        // photo.jpg and photo.png both mapped to photo.webp, so the second upload
        // destroyed the first. Hash-suffix the name. See REVIEW.md M-8.
        $webpPath = sprintf(
            '%s/%s-%s.webp',
            pathinfo($fullPath, PATHINFO_DIRNAME),
            pathinfo($fullPath, PATHINFO_FILENAME),
            substr(md5_file($fullPath) ?: uniqid(), 0, 8)
        );

        try {
            $image = match ($extension) {
                'png' => function_exists('imagecreatefrompng') ? @imagecreatefrompng($fullPath) : false,
                'jpg', 'jpeg' => function_exists('imagecreatefromjpeg') ? @imagecreatefromjpeg($fullPath) : false,
                default => false,
            };

            if (! $image) {
                Log::warning("GD could not decode image, keeping original: {$fullPath}");

                return $fullPath;
            }

            if ($extension === 'png') {
                imagealphablending($image, true);
                imagesavealpha($image, true);
            }

            // imagewebp's return value was never checked, so a failed write was
            // reported as success and the caller got a path to nothing.
            $written = imagewebp($image, $webpPath, $quality);
            imagedestroy($image);

            if (! $written) {
                Log::error("WebP write failed: {$webpPath}");

                return $fullPath;
            }

            return $webpPath;
        } catch (\Throwable $e) {
            Log::warning('GD WebP conversion failed: '.$e->getMessage());

            return $fullPath;
        }
    }
}
