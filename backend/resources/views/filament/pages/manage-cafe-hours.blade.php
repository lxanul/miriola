<x-filament-panels::page>
    <form wire:submit="submit" class="space-y-6">
        {{ $this->form }}

        <div class="flex justify-end">
            <x-filament::button type="submit" size="lg" color="primary" icon="heroicon-m-check">
                Zapisz godziny i status
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
