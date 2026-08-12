<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Ośrodek Wypoczynkowy';
    protected static ?string $navigationLabel = 'Katalog Pokoi & Domków';
    protected static ?string $modelLabel = 'Pokój / Domek';
    protected static ?string $pluralModelLabel = 'Katalog Pokoi i Domków';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Dane Pokoju / Domku')
                    ->description('Określ nazwę, cenę, pojemność oraz zdjęcia obiektu. Wszystkie rezerwacje i daty zajętości są automatycznie pobierane z Kalendarza Rezerwacji.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nazwa Pokoju / Domku')
                            ->placeholder('np. Pokój 101 - Słoneczny')
                            ->required(),

                        Forms\Components\Select::make('room_type')
                            ->label('Kategoria obiektu')
                            ->options([
                                'Pokój 2-osobowy' => 'Pokój 2-osobowy',
                                'Apartament Rodzinny' => 'Apartament Rodzinny',
                                'Domek Letniskowy' => 'Domek Letniskowy',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('capacity')
                            ->label('Maksymalna liczba gości')
                            ->numeric()
                            ->default(2)
                            ->required(),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Kolejność wyświetlania')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TagsInput::make('amenities')
                            ->label('Udogodnienia (punkty opisu pokoju)')
                            ->placeholder('Wpisz np. Max 6 osób i naciśnij Enter')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('images')
                            ->label('Galeria zdjęć pokoju (możesz dodać dowolną ilość zdjęć)')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->directory('rooms')
                            ->columnSpanFull(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nazwa obiektu')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('room_type')
                    ->label('Kategoria')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pokój 2-osobowy' => 'info',
                        'Apartament Rodzinny' => 'warning',
                        'Domek Letniskowy' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('capacity')
                    ->label('Liczba osób')
                    ->formatStateUsing(fn ($state) => "Max. {$state} os.")
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('room_type')
                    ->label('Kategoria')
                    ->options([
                        'Pokój 2-osobowy' => 'Pokój 2-osobowy',
                        'Apartament Rodzinny' => 'Apartament Rodzinny',
                        'Domek Letniskowy' => 'Domek Letniskowy',
                    ]),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
