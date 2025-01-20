<x-filament::widget>
    <x-filament::card>
        <!-- Título directamente especificado aquí -->
        <h2 class="text-lg font-semibold mb-4">Reporte de Actividades de los Participantes</h2>

        {{-- Tabla de Participantes --}}
        <div class="overflow-x-auto">
            <x-filament::table :data="$table">
                <x-filament::table-column :label="'Participante'" />
                <x-filament::table-column :label="'Juego'" />
                <x-filament::table-column :label="'Método de Pago'" />
                <x-filament::table-column :label="'Fecha de Inscripción'" />
                <x-filament::table-column :label="'Estado del Pago'" />
                <x-filament::table-column :label="'Costo de Inscripción'" />
            </x-filament::table>
        </div>
    </x-filament::card>
</x-filament::widget>



