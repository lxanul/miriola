<?php

namespace App\Observers;

use App\Models\CmsContent;
use Illuminate\Support\Facades\Cache;

class CmsContentObserver
{
    /**
     * Wyczyść cache CMS po każdym zapisie lub usunięciu.
     * getCmsData() w routes/web.php używa Cache::remember('cms_data', 3600).
     * Bez tego invalidation edycja CMS w panelu nie byłaby widoczna przez godzinę.
     */
    public function saved(CmsContent $cmsContent): void
    {
        Cache::forget('cms_data');
    }

    public function deleted(CmsContent $cmsContent): void
    {
        Cache::forget('cms_data');
    }
}
