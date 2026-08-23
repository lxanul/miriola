<?php

namespace App\Filament\Resources;

use App\Enums\RoomType;
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
                    ->description('Określ nazwę, kategoria, pojemność oraz zdjęcia obiektu. Zaimplementowane daty zajętości są automatycznie pobierane z Kalendarza Rezerwacji.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nazwa Pokoju / Domku')
                            ->placeholder('np. Pokój 101 - Słoneczny')
                            ->maxLength(255)
                            ->required(),

                        Forms\Components\Select::make('room_type')
                            ->label('Kategoria obiektu')
                            ->options(RoomType::options())
                            ->required(),

                        Forms\Components\TextInput::make('capacity')
                            ->label('Maksymalna liczba gości')
                            ->numeric()
                            ->minValue(1)
                            ->default(2)
                            ->required(),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Kolejność wyświetlania')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TagsInput::make('amenities')
                            ->label('Udogodnienia (punkty opisu pokoju)')
                            ->placeholder('Wpisz np. Łazienka z prysznicem i naciśnij Enter')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('images')
                            ->label('Galeria zdjęć pokoju (możesz dodać dowolną ilość zdjęć)')
                            ->image()
                            ->disk('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048)
                            ->maxFiles(20)
                            ->multiple()
                            ->reorderable()
                            ->directory('rooms')
                            ->columnSpanFull(),
                    ])->columns(2),
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
                    ->color(fn (string $state): string => RoomType::tryFrom($state)?->color() ?? 'gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('capacity')
                    ->label('Liczba osób')
                    ->formatStateUsing(fn ($state) => "Max. {$state} os.")
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('room_type')
                    ->label('Kategoria')
                    ->options(RoomType::options()),
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

    public static function canViewAny(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
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
