<?php

namespace App\Filament\Resources\RestaurantHallResource\Pages;

use App\Filament\Resources\RestaurantHallResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRestaurantHalls extends ListRecords
{
    protected static string $resource = RestaurantHallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Dodaj Salę Restauracyjną'),
        ];
    }
}
