<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryImageResource\Pages;
use App\Models\GalleryImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryImageResource extends Resource
{
    protected static ?string $model = GalleryImage::class;

    protected static ?string $modelLabel = 'Zdjęcie Galerii';

    protected static ?string $pluralModelLabel = 'Galeria Zdjęć Ośrodka';

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Ośrodek Wypoczynkowy';

    protected static ?string $navigationLabel = 'Galeria Zdjęć Ośrodka';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                    ->label('Zdjęcie lub Okładka Wideo')
                    ->image()
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(2048)
                    ->directory('gallery'),
                Forms\Components\TextInput::make('video_url')
                    ->label('Link do Wideo (YouTube / TikTok / Vimeo / plik MP4)')
                    ->placeholder('np. https://www.youtube.com/watch?v=... lub https://www.tiktok.com/@user/video/123456789')
                    ->nullable()
                    ->maxLength(255)
                    // ->hidden() wyłącza walidację; ->visible() jej NIE wyłącza. BUG-1.
                    ->hidden(fn (Forms\Get $get): bool => $get('media_type') !== 'video')
                    ->rules([
                        'nullable',
                        'regex:/^https:\/\/(?:[\w-]+\.)*(?:youtube\.com|youtu\.be|vimeo\.com|tiktok\.com)\/\S+$|^https:\/\/\S+\.(?:mp4|webm)$/i',
                    ])
                    ->validationMessages([
                        'regex' => 'Dozwolone są tylko adresy https z YouTube, TikTok, Vimeo lub bezpośrednie pliki .mp4/.webm.',
                    ])
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('title')
                    ->label('Tytuł / Opis (opcjonalnie)')
                    ->maxLength(255),
                Forms\Components\Select::make('branch')
                    ->label('Sekcja Obiektu')
                    ->options([
                        'resort' => 'Ośrodek Wypoczynkowy',
                    ])
                    ->default('resort')
                    ->required(),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Kolejność wyświetlania')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_published')
                    ->label('Opublikowane na stronie')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Miniaturka')
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tytuł / Opis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('branch')
                    ->label('Sekcja')
                    ->formatStateUsing(fn ($state) => $state === 'resort' ? 'Ośrodek' : 'Jarmark'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Kolejność')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Widoczne')
                    ->boolean(),
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
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleryImages::route('/'),
            'create' => Pages\CreateGalleryImage::route('/create'),
            'edit' => Pages\EditGalleryImage::route('/{record}/edit'),
        ];
    }
}
