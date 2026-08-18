<?php

namespace App\Filament\Resources\FarmProductResource\Pages;

use App\Filament\Resources\FarmProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFarmProduct extends CreateRecord
{
    protected static string $resource = FarmProductResource::class;

    protected static ?string $title = 'Dodaj Nowy Produkt Rolny';
}
