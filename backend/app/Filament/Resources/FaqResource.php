<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $modelLabel = 'Pytanie i Odpowiedź (FAQ)';
    protected static ?string $pluralModelLabel = 'Często Zadawane Pytania (FAQ)';

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationGroup = 'Ośrodek Wypoczynkowy';
    protected static ?string $navigationLabel = 'Często Zadawane Pytania (FAQ)';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question')
                    ->label('Pytanie')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('answer')
                    ->label('Odpowiedź')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
                Forms\Components\Select::make('branch')
                    ->label('Sekcja / Dział')
                    ->options([
                        'resort' => 'Ośrodek Wypoczynkowy',
                        'jarmark' => 'Jarmark & Kawiarnia',
                        'general' => 'Ogólne',
                    ])
                    ->default('resort')
                    ->required(),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Kolejność Wyświetlania')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\Toggle::make('is_published')
                    ->label('Publikuj na Stronie')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->label('Pytanie')
                    ->searchable()
                    ->limit(60),
                Tables\Columns\TextColumn::make('branch')
                    ->label('Sekcja')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'resort' => 'Ośrodek Wypoczynkowy',
                        'jarmark' => 'Jarmark & Kawiarnia',
                        default => 'Ogólne',
                    })
                    ->badge(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Widoczne')
                    ->boolean(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
