<?php

namespace App\Filament\Resources\CafeMenuItemResource\Pages;

use App\Filament\Resources\CafeMenuItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCafeMenuItem extends EditRecord
{
    protected static string $resource = CafeMenuItemResource::class;

    protected static ?string $title = 'Edytuj Pozycję Menu Kawiarni';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Usuń Pozycję z Menu'),
        ];
    }
}
