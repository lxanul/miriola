<?php

namespace App\Filament\Resources\CafeMenuItemResource\Pages;

use App\Filament\Resources\CafeMenuItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCafeMenuItems extends ListRecords
{
    protected static string $resource = CafeMenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Dodaj Pozycję do Menu'),
        ];
    }
}
