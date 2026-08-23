<?php

namespace App\Filament\Resources\CmsContentResource\Pages;

use App\Filament\Resources\CmsContentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCmsContent extends CreateRecord
{
    protected static string $resource = CmsContentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (($data['type'] ?? 'text') === 'image') {
            if (isset($data['image_path']) && !empty($data['image_path'])) {
                $data['value'] = $data['image_path'];
            }
        }
        unset($data['image_path']);

        return $data;
    }
}
