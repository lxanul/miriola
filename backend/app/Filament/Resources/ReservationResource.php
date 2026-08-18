<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Models\Reservation;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Ośrodek Wypoczynkowy';
    protected static ?string $navigationLabel = 'Grafik & Kalendarz Rezerwacji';
    protected static ?string $modelLabel = 'Rezerwacja';
    protected static ?string $pluralModelLabel = 'Kalendarz Rezerwacji';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Szczegóły Rezerwacji Pokoju / Domku')
                    ->description('Wprowadź dane gościa, wybierz obiekt z listy 10 pokoi oraz określ termin przyjazdu i wyjazdu.')
                    ->schema([
                        Forms\Components\Select::make('room_id')
                            ->label('Wybierz Pokój / Domek (z 10 obiektów)')
                            ->options(Room::orderBy('sort_order')->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->label('Status rezerwacji')
                            ->options([
                                'confirmed' => '🟢 Potwierdzona (Zarezerwowany)',
                                'pending' => '🟡 Oczekująca (Wstępna)',
                                'cancelled' => '🔴 Anulowana (Zwolniony termin)',
                            ])
                            ->default('confirmed')
                            ->required(),

                        Forms\Components\TextInput::make('guest_name')
                            ->label('Imię i nazwisko gościa')
                            ->placeholder('np. Jan Kowalski')
                            ->required(),

                        Forms\Components\TextInput::make('guest_phone')
                            ->label('Telefon kontaktowy gościa')
                            ->placeholder('np. 600 100 200')
                            ->required(),

                        Forms\Components\TextInput::make('guest_email')
                            ->label('Adres e-mail (opcjonalny)')
                            ->email(),

                        Forms\Components\TextInput::make('total_price')
                            ->label('Łączny koszt pobytu (zł)')
                            ->numeric()
                            ->prefix('zł'),

                        Forms\Components\DatePicker::make('check_in_date')
                            ->label('Data przyjazdu (Check-in)')
                            ->native(false)
                            ->displayFormat('d.m.Y')
                            // live(), żeby reguła after() na dacie wyjazdu
                            // przeliczyła się od razu po zmianie przyjazdu.
                            ->live()
                            ->required(),

                        Forms\Components\DatePicker::make('check_out_date')
                            ->label('Data wyjazdu (Check-out)')
                            ->native(false)
                            ->displayFormat('d.m.Y')
                            ->after('check_in_date')
                            ->validationMessages([
                                'after' => 'Data wyjazdu musi być późniejsza niż data przyjazdu.',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('notes')
                            ->label('Notatki i uwagi (np. wpłacona zaliczka 200zł, godzina przyjazdu, łóżeczko)')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('room.name')
                    ->label('Pokój / Domek')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('guest_name')
                    ->label('Imię i nazwisko gościa')
                    ->description(fn (Reservation $record) => "Tel: {$record->guest_phone}")
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('check_in_date')
                    ->label('Termin pobytu')
                    ->formatStateUsing(fn (Reservation $record) => $record->check_in_date->format('d.m.Y') . ' → ' . $record->check_out_date->format('d.m.Y'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'confirmed' => '🟢 Potwierdzona',
                        'pending' => '🟡 Oczekująca',
                        'cancelled' => '🔴 Anulowana',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Kwota')
                    ->money('PLN')
                    ->sortable(),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Uwagi / Notatki')
                    ->limit(40)
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('room_id')
                    ->label('Filtruj wg pokoju')
                    ->options(Room::orderBy('sort_order')->pluck('name', 'id')),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status rezerwacji')
                    ->options([
                        'confirmed' => '🟢 Potwierdzone',
                        'pending' => '🟡 Oczekujące',
                        'cancelled' => '🔴 Anulowane',
                    ]),
            ])
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
