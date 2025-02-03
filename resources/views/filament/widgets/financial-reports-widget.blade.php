<x-filament::widget>
    <x-filament::card>
        {{-- Resumen General --}}
        <h2 class="text-lg font-semibold mb-4">Reportes Financieros</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            {{-- Ingresos Totales --}}
            <div class="p-4 bg-green-100 rounded-md shadow">
                <h3 class="text-sm font-medium text-green-700">Ingresos Totales</h3>
                <p class="text-2xl font-bold text-green-800">${{ number_format($totalIncomes, 2) }}</p>
            </div>

            {{-- Egresos Totales --}}
            <div class="p-4 bg-red-100 rounded-md shadow">
                <h3 class="text-sm font-medium text-red-700">Egresos Totales</h3>
                <p class="text-2xl font-bold text-red-800">${{ number_format($totalExpenses, 2) }}</p>
            </div>

            {{-- Balance General --}}
            <div class="p-4 bg-blue-100 rounded-md shadow">
                <h3 class="text-sm font-medium text-blue-700">Balance General</h3>
                <p class="text-2xl font-bold text-blue-800">${{ number_format($generalBalance, 2) }}</p>
            </div>
        </div>

        {{-- Detalles de Ingresos --}}
        <h3 class="text-lg font-semibold mt-6 mb-2">Detalles de Ingresos</h3>
        
        <div class="grid grid-cols-1 gap-6">
            {{-- Ingresos por Participante --}}
            <div>
                <h4 class="text-sm font-medium mt-6 mb-2 cursor-pointer" onclick="toggleVisibility('participant-info')">Ingresos por Participante</h4>
                <div id="participant-info" class="hidden">
                    <table class="min-w-full bg-white border border-gray-300 rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Participante</th>
                                <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Ingresos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomesByParticipant as $participant => $income)
                                <tr>
                                    <td class="px-4 py-2 border-t text-sm text-gray-700">{{ $participant }}</td>
                                    <td class="px-4 py-2 border-t text-right text-sm text-gray-700">${{ number_format($income, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Ingresos por Juegos --}}
            <div>
                <h4 class="text-sm font-medium mb-2 cursor-pointer" onclick="toggleVisibility('game-info')">Ingresos por Juegos</h4>
                <div id="game-info" class="hidden">
                    <table class="min-w-full bg-white border border-gray-300 rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Juego</th>
                                <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Ingresos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomesByGame as $game => $income)
                                <tr>
                                    <td class="px-4 py-2 border-t text-sm text-gray-700">{{ $game }}</td>
                                    <td class="px-4 py-2 border-t text-right text-sm text-gray-700">${{ number_format($income, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Ingresos por Métodos de Pago --}}
            <div>
                <h4 class="text-sm font-medium mb-2 cursor-pointer" onclick="toggleVisibility('payment-method-info')">Ingresos por Métodos de Pago</h4>
                <div id="payment-method-info" class="hidden">
                    <table class="min-w-full bg-white border border-gray-300 rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Método de Pago</th>
                                <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Ingresos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomesByPaymentMethod as $method => $income)
                                <tr>
                                    <td class="px-4 py-2 border-t text-sm text-gray-700">
                                        {{ $method === 'cash' ? 'Efectivo' : ucfirst($method) }}
                                    </td>
                                    <td class="px-4 py-2 border-t text-right text-sm text-gray-700">${{ number_format($income, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Ingresos por Fecha --}}
            <div>
                <h4 class="text-sm font-medium mb-2 cursor-pointer" onclick="toggleVisibility('date-info')">Ingresos por Fecha</h4>
                <div id="date-info" class="hidden">
                    <table class="min-w-full bg-white border border-gray-300 rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Fecha</th>
                                <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Ingresos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomesByDate as $date => $income)
                                <tr>
                                    <td class="px-4 py-2 border-t text-sm text-gray-700">{{ $date }}</td>
                                    <td class="px-4 py-2 border-t text-right text-sm text-gray-700">${{ number_format($income, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>

<script>
    // Función para alternar la visibilidad de las secciones
    function toggleVisibility(id) {
        const element = document.getElementById(id);
        if (element.classList.contains("hidden")) {
            element.classList.remove("hidden");
        } else {
            element.classList.add("hidden");
        }
    }
</script>


