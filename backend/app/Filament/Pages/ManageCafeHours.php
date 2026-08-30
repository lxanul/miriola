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
            'cafe_hours_mon' => ['label' => 'Kawiarnia - Godziny: Poniedziałek', 'type' => 'text'],
            'cafe_hours_tue' => ['label' => 'Kawiarnia - Godziny: Wtorek', 'type' => 'text'],
            'cafe_hours_wed' => ['label' => 'Kawiarnia - Godziny: Środa', 'type' => 'text'],
            'cafe_hours_thu' => ['label' => 'Kawiarnia - Godziny: Czwartek', 'type' => 'text'],
            'cafe_hours_fri' => ['label' => 'Kawiarnia - Godziny: Piątek', 'type' => 'text'],
            'cafe_hours_sat' => ['label' => 'Kawiarnia - Godziny: Sobota', 'type' => 'text'],
            'cafe_hours_sun' => ['label' => 'Kawiarnia - Godziny: Niedziela', 'type' => 'text'],
        ];

        foreach ($fields as $key => $meta) {
            CmsContent::updateOrCreate(
                ['key' => $key],
                [
                    'label' => $meta['label'],
                    'type' => $meta['type'],
                    'group' => 'jarmark',
                    'value' => (string) ($state[$key] ?? ''),
                ]
            );
        }

        // Ensure legacy alert keys are deactivated
        CmsContent::where('key', 'cafe_open_today')->update(['value' => '0']);

        Notification::make()
            ->title('Zapisano pomyślnie')
            ->body('Harmonogram tygodniowy kawiarni został zaktualizowany.')
            ->success()
            ->send();
    }
}
