<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-6">
        @foreach (Filament\Facades\Filament::getWidgets() as $widget)
            @livewire($widget)
        @endforeach
    </div>
</x-filament-panels::page>


