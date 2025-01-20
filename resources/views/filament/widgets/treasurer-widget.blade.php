<div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-bold mb-4">Resumen de Inscripciones</h3>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium">Total de Inscripciones</span>
            <span class="text-xl font-bold">{{ $totalInscriptions }}</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium">Verificadas</span>
            <span class="text-xl font-bold text-green-600">{{ $verified }}</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium">Pendientes</span>
            <span class="text-xl font-bold text-yellow-500">{{ $pending }}</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium">Rechazadas</span>
            <span class="text-xl font-bold text-red-600">{{ $rejected }}</span>
        </div>
    </div>

    <div class="mb-6">
        <h4 class="text-sm font-medium mb-2">Ingresos Totales</h4>
        <p class="text-2xl font-bold">${{ number_format($totalRevenue, 2) }}</p>
    </div>

    <div>
        <h4 class="text-sm font-medium mb-2">Progreso hacia la Meta</h4>
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $progress }}%;"></div>
        </div>
        <p class="text-sm mt-2">{{ $progress }}% de ${{ number_format($goal, 2) }}</p>
    </div>
</div>
