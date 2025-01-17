<div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6 col-span-full">
    <h3 class="text-xl font-semibold mb-6 text-gray-900 dark:text-white">Resumen de Inscripciones</h3>

    <div class="grid grid-cols-2 gap-6 mb-12">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Total de Inscripciones</span>
            <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalInscriptions }}</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Verificadas</span>
            <span class="text-2xl font-bold text-green-500 dark:text-green-400">{{ $verified }}</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Pendientes</span>
            <span class="text-2xl font-bold text-yellow-500 dark:text-yellow-400">{{ $pending }}</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Rechazadas</span>
            <span class="text-2xl font-bold text-red-500 dark:text-red-400">{{ $rejected }}</span>
        </div>
    </div>
    <div class="mb-8">
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="px-3 bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-400 text-sm">
                    <i>.</i>
                </span>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <h4 class="text-sm font-medium mb-3 text-gray-700 dark:text-gray-300">Ingresos Totales</h4>
        <p class="text-3xl font-extrabold text-gray-900 dark:text-white">${{ number_format($totalRevenue, 2) }}</p>
    </div>

    <div class="mb-6">
        <h4 class="text-sm font-medium mb-4 text-gray-700 dark:text-gray-300">Progreso hacia la Meta</h4>
        <div class="relative w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 overflow-hidden">
            <!-- Contenedor de la barra -->
            <div
                class="absolute top-0 left-0 h-4 bg-blue-600 dark:bg-blue-400 rounded-full transition-all duration-500"
                style="width: calc({{ $progress }}%); !important"
            ></div>
        </div>
        <p class="text-sm mt-4 text-gray-600 dark:text-gray-400">
            {{ $progress }}% de ${{ number_format($goal, 2) }}
        </p>
    </div>


</div>
