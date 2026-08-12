<?php

namespace App\Filament\Resources\JarmarkAttractionResource\Pages;

use App\Filament\Resources\JarmarkAttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJarmarkAttraction extends EditRecord
{
    protected static string $resource = JarmarkAttractionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
