<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CmsContentResource\Pages;
use App\Models\CmsContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CmsContentResource extends Resource
{
    protected static ?string $model = CmsContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $navigationGroup = 'Aktualności & Strona Główna';
    protected static ?string $navigationLabel = 'Teksty i Grafiki CMS';
    protected static ?string $modelLabel = 'Treść CMS';
    protected static ?string $pluralModelLabel = 'Teksty i Grafiki CMS';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Edycja Elementu Strony')
                    ->description('Zmień tekst, podaj nowy numer telefonu, link lub wybierz plik graficzny.')
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->label('Opis pola w panelu')
                            ->placeholder('np. Telefon do rezerwacji')
                            ->required(),

                        Forms\Components\Select::make('group')
                            ->label('Sekcja / Dziedzina')
                            ->options([
                                'general' => '🌐 Ogólne & Social Media',
                                'resort' => '🏡 Ośrodek Wypoczynkowy',
                                'jarmark' => '☕ Jarmark Centrum Edukacyjno-Handlowe',
                                'farm' => '🥒 Gospodarstwo Ogrodniczo-Pszczelarskie',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('key')
                            ->label('Klucz identyfikacyjny (systemowy)')
                            ->disabled(fn ($record) => $record !== null)
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->validationMessages([
                                'unique' => 'Taki klucz już istnieje.',
                            ]),

                        Forms\Components\Select::make('type')
                            ->label('Typ zawartości')
                            ->options([
                                'text' => 'Krótki tekst (Tytuł, cena, telefon)',
                                'textarea' => 'Wielowierszowy opis',
                                'url' => 'Adres internetowy URL (FB, OLX, IG)',
                                'image' => 'Grafika / Zdjęcie',
                            ])
                            ->default('text')
                            ->reactive(),

                        Forms\Components\Textarea::make('value')
                            ->label('Wartość tekstu / Linku')
                            ->rows(4)
                            ->columnSpanFull()
                            ->visible(fn (Forms\Get $get) => $get('type') !== 'image'),

                        Forms\Components\FileUpload::make('value_file')
                            ->label('Wgraj grafikę')
                            ->image()
                            ->disk('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048)
                            ->directory('cms-graphics')
                            ->columnSpanFull()
                            ->visible(fn (Forms\Get $get) => $get('type') === 'image')
                            ->afterStateHydrated(function ($component, $record) {
                                if ($record && $record->type === 'image') {
                                    $component->state($record->value);
                                }
                            }),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label('Opis / Nazwa pola')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('group')
                    ->label('Sekcja')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'general' => '🌐 Ogólne',
                        'resort' => '🏡 Ośrodek',
                        'jarmark' => '☕ Jarmark',
                        'farm' => '🥒 Gospodarstwo',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'general' => 'info',
                        'resort' => 'success',
                        'jarmark' => 'warning',
                        'farm' => 'primary',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Aktualna treść')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('key')
                    ->label('Klucz systemowy')
                    ->fontFamily('mono')
                    ->size('xs')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Filtruj według sekcji')
                    ->options([
                        'general' => '🌐 Ogólne & Social Media',
                        'resort' => '🏡 Ośrodek Wypoczynkowy',
                        'jarmark' => '☕ Jarmark Centrum Edukacyjno-Handlowe',
                        'farm' => '🥒 Gospodarstwo Ogrodniczo-Pszczelarskie',
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
            'index' => Pages\ListCmsContents::route('/'),
            'create' => Pages\CreateCmsContent::route('/create'),
            'edit' => Pages\EditCmsContent::route('/{record}/edit'),
        ];
    }
}
