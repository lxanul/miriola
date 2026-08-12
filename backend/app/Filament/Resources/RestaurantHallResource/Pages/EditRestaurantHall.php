<?php

namespace App\Filament\Resources\RestaurantHallResource\Pages;

use App\Filament\Resources\RestaurantHallResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRestaurantHall extends EditRecord
{
    protected static string $resource = RestaurantHallResource::class;

    protected static ?string $title = 'Edytuj Salę Restauracyjną';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Usuń Salę'),
        ];
    }
}
