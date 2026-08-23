<?php

namespace App\Models;

use App\Observers\CmsContentObserver;
use Illuminate\Database\Eloquent\Model;

class CmsContent extends Model
{
    protected $fillable = [
        'key',
        'label',
        'value',
        'type',
        'group',
    ];

    protected static function booted(): void
    {
        static::observe(CmsContentObserver::class);
    }
}
