<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CafeMenuItemResource\Pages;
use App\Filament\Resources\CafeMenuItemResource\RelationManagers;
use App\Models\CafeMenuItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    ->required(),
                Forms\Components\Select::make('category')
                    ->label('Kategoria Menu')
                    ->options([
                        'kawy' => '☕ Kawy i Napoje Gorące',
                        'desery' => '🍰 Serniki i Domowe Ciasta',
                        'przekaski' => '🥨 Przekąski i Rzemiosło',
                    ])
                    ->default('kawy')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Opis Pozycji')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->label('Zdjęcie Pozycji')
                    ->image()
                    ->disk('public')
                    ->directory('cafe-menu')
                    ->visibility('public'),
                Forms\Components\Toggle::make('is_available')
                    ->label('Dostępne w Kawiarni')
                    ->default(true)
                    ->required(),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Polecane / Hity Kawiarni')
                    ->default(false),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Kolejność Wyświetlania')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Zdjęcie'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nazwa Pozycji')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_available')
                    ->label('Dostępność')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Hit / Polecane')
                    ->boolean(),
            ])
            ->filters([
                //
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
