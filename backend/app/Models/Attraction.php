<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    protected $fillable = [
        'title',
        'branch',
        'description',
        'icon',
        'image',
        'sort_order',
    ];
}
