<?php

namespace App\Filament\Resources\FarmProductResource\Pages;

use App\Filament\Resources\FarmProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFarmProduct extends EditRecord
{
    protected static string $resource = FarmProductResource::class;

    protected static ?string $title = 'Edytuj Produkt Rolny';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Usuń Produkt'),
        ];
    }
}
