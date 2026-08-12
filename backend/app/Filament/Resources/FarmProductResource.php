<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FarmProductResource\Pages;
use App\Filament\Resources\FarmProductResource\RelationManagers;
use App\Models\FarmProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FarmProductResource extends Resource
{
    protected static ?string $model = FarmProduct::class;

    protected static ?string $modelLabel = 'Produkt Rolny';
    protected static ?string $pluralModelLabel = 'Oferta Produktów Rolnych';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Gospodarstwo Rolne';
    protected static ?string $navigationLabel = 'Oferta Produktów Rolnych';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nazwa Produktu (np. Ogórki Kiszone, Miód)')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Opis Produktu')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('unit_name')
                    ->label('Jednostka / Opakowanie (np. słoik 900ml, kg, skrzynka)')
                    ->default('słoik 900ml'),
                Forms\Components\FileUpload::make('image')
                    ->label('Zdjęcie Produktu')
                    ->image()
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(4096)
                    ->directory('farm-products'),
                Forms\Components\Toggle::make('is_available')
                    ->label('Dostępny do zakupu')
                    ->default(true)
                    ->required(),
                Forms\Components\TextInput::make('phone_contact')
                    ->label('Telefon do zamówienia')
                    ->default('+48608103119')
                    ->tel()
                    ->required(),
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
                Tables\Columns\ImageColumn::make('image')
                    ->label('Zdjęcie'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nazwa Produktu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit_name')
                    ->label('Jednostka'),
                Tables\Columns\IconColumn::make('is_available')
                    ->label('Dostępność')
                    ->boolean(),
                Tables\Columns\TextColumn::make('phone_contact')
                    ->label('Telefon'),
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
            'index' => Pages\ListFarmProducts::route('/'),
            'create' => Pages\CreateFarmProduct::route('/create'),
            'edit' => Pages\EditFarmProduct::route('/{record}/edit'),
        ];
    }
}
