<?php

namespace App\Models;

use App\Observers\CmsContentObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Throwable;

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

    public static function getData(): array
    {
        try {
            return Cache::remember('cms_data', 3600, function () {
                return static::pluck('value', 'key')->toArray();
            });
        } catch (Throwable $e) {
            return [];
        }
    }
}

if (! function_exists('getCmsData')) {
    function getCmsData(): array
    {
        return CmsContent::getData();
    }
}

