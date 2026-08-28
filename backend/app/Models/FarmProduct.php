<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmProduct extends Model
{
    protected $fillable = [
        'name',
        'description',
        'unit_price',
        'unit_name',
        'image',
        'images',
        'is_available',
        'phone_contact',
        'sort_order',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'is_available' => 'boolean',
        'images' => 'array',
    ];

    protected $appends = [
        'image_url',
        'images_urls',
    ];

    public function getImageUrlAttribute(): ?string
    {
        if (blank($this->image)) {
            // Jeśli brak image, ale jest tablica images, weź pierwsze zdjęcie
            if (!empty($this->images) && is_array($this->images) && count($this->images) > 0) {
                return $this->formatImageUrl($this->images[0]);
            }
            return null;
        }

        return $this->formatImageUrl($this->image);
    }

    /**
     * Zwraca listę pełnych adresów URL do wszystkich zdjęć produktu.
     *
     * @return array<int, string>
     */
    public function getImagesUrlsAttribute(): array
    {
        if (!empty($this->images) && is_array($this->images) && count($this->images) > 0) {
            return array_values(array_filter(array_map(fn ($img) => $this->formatImageUrl($img), $this->images)));
        }

        if (!empty($this->image)) {
            $formatted = $this->formatImageUrl($this->image);
            return $formatted ? [$formatted] : [];
        }

        return [];
    }

    private function formatImageUrl(?string $img): ?string
    {
        if (blank($img)) {
            return null;
        }

        if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
            return $img;
        }

        if (str_starts_with($img, 'assets/') || str_starts_with($img, 'images/')) {
            return asset($img);
        }

        return asset('storage/' . ltrim($img, '/'));
    }
}
