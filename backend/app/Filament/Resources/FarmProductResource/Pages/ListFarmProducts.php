<?php

namespace App\Filament\Resources\FarmProductResource\Pages;

use App\Filament\Resources\FarmProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFarmProducts extends ListRecords
{
    protected static string $resource = FarmProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Dodaj Produkt Rolny'),
        ];
    }
}
