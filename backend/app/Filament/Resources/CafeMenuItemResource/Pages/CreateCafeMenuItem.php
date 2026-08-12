<?php

namespace App\Filament\Resources\CafeMenuItemResource\Pages;

use App\Filament\Resources\CafeMenuItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCafeMenuItem extends CreateRecord
{
    protected static string $resource = CafeMenuItemResource::class;

    protected static ?string $title = 'Dodaj Pozycję Menu Kawiarni';
}
