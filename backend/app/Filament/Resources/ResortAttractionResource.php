<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResortAttractionResource\Pages;
use App\Models\Attraction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ResortAttractionResource extends Resource
{
    protected static ?string $model = Attraction::class;

    protected static ?string $modelLabel = 'Atrakcja Ośrodka';

    protected static ?string $pluralModelLabel = 'Atrakcje Ośrodka (4 udogodnienia)';

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'Ośrodek Wypoczynkowy';

    protected static ?string $navigationLabel = 'Atrakcje Ośrodka (4 udogodnienia)';

    protected static ?int $navigationSort = 4;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('branch', 'resort');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('branch')
                    ->default('resort'),
                Forms\Components\TextInput::make('title')
                    ->label('Nazwa Atrakcji / Udogodnienia')
                    ->placeholder('np. Bliskość jeziora, Plac zabaw, Miejsce na grill, Wypożyczalnia')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label('Opis Atrakcji')
                    ->placeholder('np. Tylko 1 km od malowniczego Jeziora Mucharskiego.')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('icon')
                    ->label('Wybierz Ikonę Udogodnienia')
                    ->options([
                        'Popularne Udogodnienia' => [
                            'hot_tub' => '♨️ Jacuzzi / Strefa SPA (hot_tub)',
                            'deck' => '🛖 Wiata Biesiadna / Grill (deck)',
                            'outdoor_grill' => '🍖 Grill / Palenisko (outdoor_grill)',
                            'local_parking' => '🅿️ Bezpłatny Parking (local_parking)',
                            'child_care' => '🎡 Plac Zabaw / Dzieci (child_care)',
                            'toys' => '🧸 Strefa Malucha (toys)',
                            'cottage' => '🏡 Domki / Obiekt (cottage)',
                            'water' => '🌊 Jezioro / Woda (water)',
                            'pool' => '🏊 Basen (pool)',
                        ],
                        'Gastronomia & Kawiarnia' => [
                            'local_cafe' => '☕ Kawiarnia / Ciasta (local_cafe)',
                            'restaurant' => '🍽️ Restauracja / Obiady (restaurant)',
                            'wine_bar' => '🍷 Wino / Bar (wine_bar)',
                            'storefront' => '🛒 Jarmark / Sklep (storefront)',
                            'shopping_bag' => '🛍️ Produkty Lokalne (shopping_bag)',
                            'eco' => '🍃 Gospodarstwo / Natura (eco)',
                        ],
                        'Natura & Rekreacja' => [
                            'hiking' => '🥾 Szlaki Turystyczne (hiking)',
                            'pedal_bike' => '🚲 Trasy Rowerowe (pedal_bike)',
                            'forest' => '🌲 Las / Natura (forest)',
                            'park' => '🏞️ Park / Ogród (park)',
                            'sports_soccer' => '⚽ Boiski Sportowe (sports_soccer)',
                        ],
                        'Pokoje & Usługi' => [
                            'wifi' => '📶 Szybkie WiFi (wifi)',
                            'tv' => '📺 Telewizja / Smart TV (tv)',
                            'ac_unit' => '❄️ Klimatyzacja (ac_unit)',
                            'fireplace' => '🔥 Kominek (fireplace)',
                            'pets' => '🐾 Przyjazne Zwierzętom (pets)',
                            'star' => '⭐ Gwiazdka / Wyróżnienie (star)',
                        ],
                    ])
                    ->searchable()
                    ->default('star')
                    ->required(),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Kolejność Wyświetlania (1 - 4)')
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Kolejność')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Nazwa Atrakcji')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Opis')
                    ->limit(50),
                Tables\Columns\TextColumn::make('icon')
                    ->label('Ikona'),
            ])
            ->defaultSort('sort_order', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListResortAttractions::route('/'),
            'create' => Pages\CreateResortAttraction::route('/create'),
            'edit' => Pages\EditResortAttraction::route('/{record}/edit'),
        ];
    }
}
