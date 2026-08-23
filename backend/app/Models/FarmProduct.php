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
        'is_available',
        'phone_contact',
        'sort_order',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        if (blank($this->image)) {
            return asset('assets/img/czosnek.jpg');
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'assets/') || str_starts_with($this->image, 'images/')) {
            return asset($this->image);
        }

        return asset('storage/' . $this->image);
    }
}
