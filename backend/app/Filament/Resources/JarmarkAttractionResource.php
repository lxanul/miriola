<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JarmarkAttractionResource\Pages;
use App\Models\Attraction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JarmarkAttractionResource extends Resource
{
    protected static ?string $model = Attraction::class;

    protected static ?string $modelLabel = 'Atrakcja Jarmarku';

    protected static ?string $pluralModelLabel = 'Atrakcje Jarmarku';

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Jarmark CEH';

    protected static ?string $navigationLabel = 'Atrakcje Jarmarku';

    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('branch', 'jarmark');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('branch')
                    ->default('jarmark'),
                Forms\Components\TextInput::make('title')
                    ->label('Nazwa Atrakcji / Strefy')
                    ->placeholder('np. Dmuchany Plac Zabaw dla Dzieci, Sferyczny Namiot Plenerowy')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label('Opis Atrakcji')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('icon')
                    ->label('Wybierz Ikonę Atrakcji')
                    ->options([
                        'Popularne Udogodnienia' => [
                            'child_care' => '🎡 Plac Zabaw / Dzieci (child_care)',
                            'toys' => '🧸 Strefa Dmuchawców / Maluch (toys)',
                            'cottage' => '🏡 Domki / Obiekt (cottage)',
                            'hot_tub' => '♨️ Jacuzzi / Strefa SPA (hot_tub)',
                            'deck' => '🛖 Wiata Biesiadna / Grill (deck)',
                            'outdoor_grill' => '🍖 Grill / Palenisko (outdoor_grill)',
                            'local_parking' => '🅿️ Bezpłatny Parking (local_parking)',
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
                    ->default('child_care')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->label('Zdjęcie Atrakcji (opcjonalne)')
                    ->image()
                    ->disk('public')
                    ->directory('attractions')
                    ->visibility('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Zdjęcie'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Nazwa Atrakcji')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Opis')
                    ->limit(50),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Kolejność')
                    ->sortable(),
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
            'index' => Pages\ListJarmarkAttractions::route('/'),
            'create' => Pages\CreateJarmarkAttraction::route('/create'),
            'edit' => Pages\EditJarmarkAttraction::route('/{record}/edit'),
        ];
    }
}
