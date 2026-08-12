<?php

namespace App\Filament\Resources\CmsContentResource\Pages;

use App\Filament\Resources\CmsContentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCmsContent extends CreateRecord
{
    protected static string $resource = CmsContentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (($data['type'] ?? null) === 'image' && !empty($data['value_file'])) {
            $data['value'] = $data['value_file'];
        }
        unset($data['value_file']);

        return $data;
    }
}
