<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $modelLabel = 'Artykuł';
    protected static ?string $pluralModelLabel = 'Aktualności';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Aktualności & Strona Główna';
    protected static ?string $navigationLabel = 'Wpisy Aktualności';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Tytuł Artykułu')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', \Illuminate\Support\Str::slug($state ?? ''))),
                Forms\Components\TextInput::make('slug')
                    ->label('Adres URL (Slug)')
                    ->required()
                    ->readOnly()
                    ->dehydrated()
                    ->helperText('Identyfikator przyjazny dla wyszukiwarek (generuje się automatycznie z tytułu). Nie musisz go edytować.'),
                Forms\Components\Select::make('branch')
                    ->label('Dział / Kategoria')
                    ->options([
                        'resort' => 'Ośrodek Wypoczynkowy',
                        'jarmark' => 'Jarmark & Kawiarnia',
                    ])
                    ->default('resort')
                    ->required(),
                Forms\Components\Textarea::make('excerpt')
                    ->label('Krótki Wstęp / Streszczenie')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('content')
                    ->label('Pełna Treść Aktualności')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->label('Zdjęcie Główne')
                    ->image()
                    ->disk('public')
                    ->directory('news-images')
                    ->visibility('public'),
                Forms\Components\Toggle::make('is_published')
                    ->label('Opublikowany na Stronie')
                    ->default(true)
                    ->required(),
                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Data Publikacji')
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Zdjęcie'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tytuł Artykułu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('branch')
                    ->label('Dział')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'resort' => 'Ośrodek Wypoczynkowy',
                        'jarmark' => 'Jarmark & Kawiarnia',
                        default => $state ?? 'Ogólne',
                    })
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'resort' => 'info',
                        'jarmark' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Data Publikacji')
                    ->dateTime('d.m.Y H:i')
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
