<?php

namespace App\Filament\Resources\ResortAttractionResource\Pages;

use App\Filament\Resources\ResortAttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResortAttractions extends ListRecords
{
    protected static string $resource = ResortAttractionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Dodaj Atrakcję Ośrodka'),
        ];
    }
}
