<x-filament::page>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <div class="p-6 shadow rounded-lg bg-white dark:bg-gray-800">
            <h3 class="text-lg font-bold dark:text-gray-200">Ingresos Totales</h3>
            <p class="text-3xl font-bold text-green-600 dark:text-green-400">
                ${{ number_format($this->getData()['ingresos'], 2) }}
            </p>
        </div>

        <div class="p-6 shadow rounded-lg bg-white dark:bg-gray-800">
            <h3 class="text-lg font-bold dark:text-gray-200">Egresos Totales</h3>
            <p class="text-3xl font-bold text-red-600 dark:text-red-400">
                ${{ number_format($this->getData()['egresos'], 2) }}
            </p>
        </div>

        <div class="p-6 shadow rounded-lg bg-white dark:bg-gray-800">
            <h3 class="text-lg font-bold dark:text-gray-200">Saldo Total</h3>
            <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                ${{ number_format($this->getData()['saldo'], 2) }}
            </p>
        </div>
    </div>

    <div class="mt-6">
        <x-filament::button wire:click="exportToPdf" color="primary">
            Exportar a PDF
        </x-filament::button>
    </div>
</x-filament::page>
