<?php

namespace App\Filament\Resources;

use App\Enums\CafeCategory;
use App\Filament\Resources\CafeMenuItemResource\Pages;
use App\Models\CafeMenuItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CafeMenuItemResource extends Resource
{
    protected static ?string $model = CafeMenuItem::class;

    protected static ?string $modelLabel = 'Pozycja Menu';

    protected static ?string $pluralModelLabel = 'Menu Kawiarni';

    protected static ?string $navigationIcon = 'heroicon-o-cake';

    protected static ?string $navigationGroup = 'Jarmark CEH';

    protected static ?string $navigationLabel = 'Menu Kawiarni';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nazwa Napoju / Ciasta / Dania')
                    ->placeholder('np. Sernik Domowy, Kawa Espresso')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\Select::make('category')
                    ->label('Kategoria Menu')
                    ->options(CafeCategory::options())
                    ->default(CafeCategory::KawyNapoje->value)
                    ->required(),
                Forms\Components\Toggle::make('is_available')
                    ->label('Dostępne w Kawiarni')
                    ->default(true)
                    ->required(),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Polecane / Hit Kawiarni')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nazwa Pozycji')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategoria')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => CafeCategory::tryFrom($state ?? '')?->label() ?? ($state ?? 'Inne'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_available')
                    ->label('Dostępność')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Hit / Polecane')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Filtruj wg Kategorii')
                    ->options(CafeCategory::options()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCafeMenuItems::route('/'),
            'create' => Pages\CreateCafeMenuItem::route('/create'),
            'edit' => Pages\EditCafeMenuItem::route('/{record}/edit'),
        ];
    }
}
