<?php

namespace App\Filament\Resources\ResortAttractionResource\Pages;

use App\Filament\Resources\ResortAttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResortAttraction extends EditRecord
{
    protected static string $resource = ResortAttractionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
