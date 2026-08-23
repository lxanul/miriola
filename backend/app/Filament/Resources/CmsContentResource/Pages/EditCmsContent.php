<?php

namespace App\Filament\Resources\CmsContentResource\Pages;

use App\Filament\Resources\CmsContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCmsContent extends EditRecord
{
    protected static string $resource = CmsContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (($data['type'] ?? 'text') === 'image') {
            $data['image_path'] = $data['value'] ?? null;
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
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
