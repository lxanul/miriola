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
}
