<x-filament::widget>
    <x-filament::card class="w-full overflow-x-hidden"> <!-- Aseguramos el ancho completo -->
        <h2 class="text-lg font-semibold mb-4">Juegos</h2>

        <x-filament::table :data="$getTableData()" class="w-full">
            <x-filament::table-column label="Nombre del Juego" />
            <x-filament::table-column label="Estado" />
            <x-filament::table-column label="Coordinador" />
            <x-filament::table-column label="Participantes" />
            <x-filament::table-column label="Inicio" />
            <x-filament::table-column label="Finalización" />
        </x-filament::table>
    </x-filament::card>
</x-filament::widget>

