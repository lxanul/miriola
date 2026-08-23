<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Ustawienia';

    protected static ?string $navigationLabel = 'Konta administratorów';

    protected static ?string $modelLabel = 'Konto';

    protected static ?string $pluralModelLabel = 'Konta administratorów';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Imię i nazwisko')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Adres e-mail (login)')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('password')
                    ->label('Hasło')
                    ->password()
                    ->revealable()
                    ->minLength(12)
                    ->maxLength(255)
                    // Wymagane tylko przy zakładaniu konta; przy edycji puste pole
                    // oznacza „zostaw obecne hasło".
                    ->required(fn (string $operation) => $operation === 'create')
                    ->dehydrated(fn (?string $state) => filled($state))
                    ->helperText('Minimum 12 znaków. Przy edycji zostaw puste, aby nie zmieniać hasła.'),

                Forms\Components\Select::make('role')
                    ->label('Rola i zakres uprawnień')
                    ->options([
                        'admin' => '👑 Główny Administrator (Pełny dostęp do panelu)',
                        'news_editor' => '📰 Edytor Aktualności (Dostęp tylko do Aktualności)',
                    ])
                    ->default('admin')
                    ->required()
                    // ->dehydrated(false) gdy disabled: pole wyłączone nie może
                    // nadpisać roli samemu sobie. BUG-5.
                    ->disabled(fn (?User $record) => $record?->is(auth()->user()) ?? false)
                    ->dehydrated(fn (?User $record) => ! ($record?->is(auth()->user()) ?? false))
                    ->helperText('Edytor Aktualności widzi wyłącznie sekcję Wpisów Aktualności.'),

                Forms\Components\Toggle::make('is_admin')
                    ->label('Dostęp do panelu /admin')
                    ->default(true)
                    // Nie da się odebrać uprawnień samemu sobie.
                    ->disabled(fn (?User $record) => $record?->is(auth()->user()) ?? false)
                    // ->dehydrated(false) gdy disabled: persist() obsługuje is_admin ręcznie.
                    ->dehydrated(fn (?User $record) => ! ($record?->is(auth()->user()) ?? false))
                    ->helperText('Bez tego przełącznika konto nie zaloguje się do panelu.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Imię i nazwisko')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail (login)')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('role')
                    ->label('Rola')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'news_editor' => 'Edytor Aktualności',
                        default => 'Główny Admin',
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'news_editor' => 'warning',
                        default => 'success',
                    })
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_admin')
                    ->label('Panel /admin')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Utworzono')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->using(fn (User $record, array $data) => static::persist($record, $data)),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn (User $record) => ! $record->is(auth()->user())),
            ])
            ->bulkActions([]);
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    /**
     * `is_admin` jest celowo poza $fillable modelu User, żeby flaga uprawnień
     * nigdy nie dała się ustawić przez mass assignment. Zapisujemy ją osobno
     * przez forceFill. Brak klucza w $data (pole wyłączone dla własnego konta)
     * oznacza „nie ruszaj" — inaczej administrator odebrałby uprawnienia sobie.
     */
    public static function persist(User $record, array $data): User
    {
        $isAdmin = $data['is_admin'] ?? null;
        unset($data['is_admin']);

        $record->fill($data)->save();

        if ($isAdmin !== null) {
            $record->forceFill(['is_admin' => (bool) $isAdmin])->save();
        }

        return $record;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
