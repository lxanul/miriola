<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantHall extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'subtitle',
        'capacity',
        'description',
        'main_image',
        'gallery_images',
        'features',
        'sort_order',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'features' => 'array',
    ];
}
