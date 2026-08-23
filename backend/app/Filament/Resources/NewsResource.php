<?php

namespace App\Filament\Resources;

use App\Enums\Branch;
use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

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
                    ->maxLength(255)
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state ?? ''))),
                Forms\Components\TextInput::make('slug')
                    ->label('Adres URL (Slug)')
                    ->required()
                    ->maxLength(255)
                    // Slug powstaje z tytułu, więc dwa artykuły o tej samej
                    // nazwie kończyły się błędem 500 na kolizji UNIQUE. H-21.
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Artykuł o takim adresie już istnieje — zmień tytuł.',
                    ])
                    ->readOnly()
                    ->dehydrated()
                    ->helperText('Identyfikator przyjazny dla wyszukiwarek (generuje się automatycznie z tytułu). Nie musisz go edytować.'),
                Forms\Components\Select::make('branch')
                    ->label('Dział / Kategoria')
                    // Lista pochodzi z enuma — wcześniej brakowało działu „farm",
                    // choć baza zawiera aktualności gospodarstwa. H-11.
                    ->options(Branch::options())
                    ->default(Branch::Resort->value)
                    ->required(),
                Forms\Components\Textarea::make('content')
                    ->label('Treść Aktualności')
                    ->placeholder('Wpisz treść artykułu lub wiadomości...')
                    ->nullable()
                    ->rows(6)
                    ->columnSpanFull(),
                Forms\Components\Select::make('media_type')
                    ->label('Typ multimediów')
                    ->options([
                        'image' => '🖼️ Zdjęcie',
                        'video' => '🎥 Wideo / Filmik',
                    ])
                    ->default('image')
                    ->required()
                    ->live(),
                Forms\Components\FileUpload::make('image')
                    ->label('Zdjęcie Główne lub Okładka Wideo')
                    ->image()
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                    ->maxSize(5120)
                    ->directory('news-images')
                    ->visibility('public')
                    ->helperText('Wymagane dla Zdjęcia. Dla Wideo — prześlij okładkę (miniaturkę).'),
                Forms\Components\TextInput::make('video_url')
                    ->label('Link do Wideo (YouTube / TikTok / Vimeo / plik MP4)')
                    ->placeholder('np. https://www.youtube.com/watch?v=... lub https://www.tiktok.com/@user/video/123456789')
                    ->nullable()
                    ->maxLength(255)
                    // Walidacja regex tylko gdy pole widoczne — ->hidden() wyłącza
                    // walidację, ->visible() jej NIE wyłącza. H-BUG-01.
                    ->hidden(fn (Forms\Get $get): bool => $get('media_type') !== 'video')
                    ->rules([
                        'nullable',
                        'regex:/^https:\/\/(?:[\w-]+\.)*(?:youtube\.com|youtu\.be|vimeo\.com|tiktok\.com)\/\S+$|^https:\/\/\S+\.(?:mp4|webm)$/i',
                    ])
                    ->validationMessages([
                        'regex' => 'Dozwolone są tylko adresy https z YouTube, TikTok, Vimeo lub bezpośrednie pliki .mp4/.webm.',
                    ])
                    ->columnSpanFull(),
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

    public static function canViewAny(): bool
    {
        return auth()->user()?->isAdmin() || auth()->user()?->isNewsEditor();
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
