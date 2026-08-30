<?php

namespace App\Filament\Pages;

use App\Models\CmsContent;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageCafeHours extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationGroup = 'Jarmark CEH';

    protected static ?string $navigationLabel = 'Godziny Otwarcia Kawiarni';

    protected static ?string $title = 'Godziny Otwarcia Kawiarni';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.manage-cafe-hours';

    public ?array $data = [];

    public function mount(): void
    {
        $cms = CmsContent::getData();

        $this->form->fill([
            'cafe_open_today' => !empty($cms['cafe_open_today']) && $cms['cafe_open_today'] !== '0' && $cms['cafe_open_today'] !== false,
            'cafe_today_hours' => $cms['cafe_today_hours'] ?? '',
            'cafe_today_notice' => $cms['cafe_today_notice'] ?? '',
            'cafe_hours_mon' => $cms['cafe_hours_mon'] ?? '15:00 – 20:00',
            'cafe_hours_tue' => $cms['cafe_hours_tue'] ?? '15:00 – 20:00',
            'cafe_hours_wed' => $cms['cafe_hours_wed'] ?? '15:00 – 20:00',
            'cafe_hours_thu' => $cms['cafe_hours_thu'] ?? '15:00 – 20:00',
            'cafe_hours_fri' => $cms['cafe_hours_fri'] ?? '15:00 – 20:00',
            'cafe_hours_sat' => $cms['cafe_hours_sat'] ?? '10:00 – 20:00',
            'cafe_hours_sun' => $cms['cafe_hours_sun'] ?? '10:00 – 20:00',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Dzisiaj Otwieramy (Wyróżniony Alert)')
                    ->description('Włącz, aby na stronie kawiarni natychmiast pojawił się wyróżniony komunikat i odznaka informująca, że kawiarnia jest dzisiaj czynna.')
                    ->icon('heroicon-o-sparkles')
                    ->schema([
                        Toggle::make('cafe_open_today')
                            ->label('Dzisiaj otwieramy!')
                            ->helperText('Gdy jest włączone, na stronie kawiarni oraz przy godzinach pojawi się efektowny, zielony status "Dzisiaj Otwieramy".')
                            ->live(),
                        Grid::make(['default' => 1, 'sm' => 2])
                            ->schema([
                                TextInput::make('cafe_today_hours')
                                    ->label('Dzisiejsze godziny otwarcia (opcjonalnie)')
                                    ->placeholder('np. 14:00 – 21:00 (zostaw puste dla standardowych)')
                                    ->maxLength(100),
                                TextInput::make('cafe_today_notice')
                                    ->label('Dodatkowy komunikat na dziś (opcjonalnie)')
                                    ->placeholder('np. Świeże jagodzianki prosto z pieca!')
                                    ->maxLength(150),
                            ]),
                    ]),

                Section::make('Harmonogram Tygodniowy (Od Poniedziałku do Niedzieli)')
                    ->description('Wpisz godziny otwarcia dla poszczególnych dni tygodnia lub wpisz "Zamknięte".')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                        Grid::make(['default' => 1, 'sm' => 2, 'md' => 3, 'lg' => 4])
                            ->schema([
                                TextInput::make('cafe_hours_mon')
                                    ->label('Poniedziałek')
                                    ->placeholder('np. 15:00 – 20:00 lub Zamknięte')
                                    ->required(),
                                TextInput::make('cafe_hours_tue')
                                    ->label('Wtorek')
                                    ->placeholder('np. 15:00 – 20:00 lub Zamknięte')
                                    ->required(),
                                TextInput::make('cafe_hours_wed')
                                    ->label('Środa')
                                    ->placeholder('np. 15:00 – 20:00 lub Zamknięte')
                                    ->required(),
                                TextInput::make('cafe_hours_thu')
                                    ->label('Czwartek')
                                    ->placeholder('np. 15:00 – 20:00 lub Zamknięte')
                                    ->required(),
                                TextInput::make('cafe_hours_fri')
                                    ->label('Piątek')
                                    ->placeholder('np. 15:00 – 20:00 lub Zamknięte')
                                    ->required(),
                                TextInput::make('cafe_hours_sat')
                                    ->label('Sobota')
                                    ->placeholder('np. 10:00 – 20:00 lub Zamknięte')
                                    ->required(),
                                TextInput::make('cafe_hours_sun')
                                    ->label('Niedziela')
                                    ->placeholder('np. 10:00 – 20:00 lub Zamknięte')
                                    ->required(),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $state = $this->form->getState();

        $fields = [
            'cafe_open_today' => ['label' => 'Kawiarnia - Dzisiaj otwieramy (Wyróżnienie)', 'type' => 'text'],
            'cafe_today_hours' => ['label' => 'Kawiarnia - Dzisiejsze godziny otwarcia', 'type' => 'text'],
            'cafe_today_notice' => ['label' => 'Kawiarnia - Dzisiejsza wiadomość specjalna', 'type' => 'text'],
            'cafe_hours_mon' => ['label' => 'Kawiarnia - Godziny: Poniedziałek', 'type' => 'text'],
            'cafe_hours_tue' => ['label' => 'Kawiarnia - Godziny: Wtorek', 'type' => 'text'],
            'cafe_hours_wed' => ['label' => 'Kawiarnia - Godziny: Środa', 'type' => 'text'],
            'cafe_hours_thu' => ['label' => 'Kawiarnia - Godziny: Czwartek', 'type' => 'text'],
            'cafe_hours_fri' => ['label' => 'Kawiarnia - Godziny: Piątek', 'type' => 'text'],
            'cafe_hours_sat' => ['label' => 'Kawiarnia - Godziny: Sobota', 'type' => 'text'],
            'cafe_hours_sun' => ['label' => 'Kawiarnia - Godziny: Niedziela', 'type' => 'text'],
        ];

        foreach ($fields as $key => $meta) {
            $val = isset($state[$key]) ? (is_bool($state[$key]) ? ($state[$key] ? '1' : '0') : (string) $state[$key]) : '';
            CmsContent::updateOrCreate(
                ['key' => $key],
                [
                    'label' => $meta['label'],
                    'type' => $meta['type'],
                    'group' => 'jarmark',
                    'value' => $val,
                ]
            );
        }

        Notification::make()
            ->title('Zapisano pomyślnie')
            ->body('Godziny otwarcia i status dnia zostały zaktualizowane na stronie.')
            ->success()
            ->send();
    }
}
