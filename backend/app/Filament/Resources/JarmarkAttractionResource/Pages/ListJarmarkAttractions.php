<?php

namespace App\Filament\Resources\JarmarkAttractionResource\Pages;

use App\Filament\Resources\JarmarkAttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJarmarkAttractions extends ListRecords
{
    protected static string $resource = JarmarkAttractionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Dodaj Atrakcję Jarmarku'),
        ];
    }
}
