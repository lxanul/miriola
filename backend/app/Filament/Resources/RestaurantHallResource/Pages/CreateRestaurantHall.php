<?php

namespace App\Filament\Resources\RestaurantHallResource\Pages;

use App\Filament\Resources\RestaurantHallResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRestaurantHall extends CreateRecord
{
    protected static string $resource = RestaurantHallResource::class;

    protected static ?string $title = 'Dodaj Nową Salę Restauracyjną';
}
