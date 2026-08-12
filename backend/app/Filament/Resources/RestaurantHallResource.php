<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RestaurantHallResource\Pages;
use App\Filament\Resources\RestaurantHallResource\RelationManagers;
use App\Models\RestaurantHall;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RestaurantHallResource extends Resource
{
    protected static ?string $model = RestaurantHall::class;

    protected static ?string $modelLabel = 'Sala Restauracyjna';
    protected static ?string $pluralModelLabel = 'Sale Restauracyjne';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Ośrodek Wypoczynkowy';
    protected static ?string $navigationLabel = 'Sale Restauracyjne';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nazwa Sali (np. Sala Myśliwska, Kominkowa)')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                Forms\Components\TextInput::make('slug')
                    ->label('Adres URL (Slug)')
                    ->required(),
                Forms\Components\TextInput::make('subtitle')
                    ->label('Podtytuł / Hasło (np. Przyjęcia okolicznościowe)'),
                Forms\Components\TextInput::make('capacity')
                    ->label('Liczba Miejsc (Pojemność)')
                    ->numeric()
                    ->suffix('osób'),
                Forms\Components\Textarea::make('description')
                    ->label('Opis Sali')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('main_image')
                    ->label('Zdjęcie Główne')
                    ->image()
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(2048)
                    ->directory('halls'),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Kolejność Wyświetlania')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image')
                    ->label('Zdjęcie'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nazwa Sali')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Podtytuł'),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Pojemność')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Kolejność')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListRestaurantHalls::route('/'),
            'create' => Pages\CreateRestaurantHall::route('/create'),
            'edit' => Pages\EditRestaurantHall::route('/{record}/edit'),
        ];
    }
}
