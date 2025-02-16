<div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6 col-span-full">

    <!-- Editar los nombres por los que corresponde -->

    <!-- Resumen Financiero -->
    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Resumen Financiero</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <!-- Ingreso Inscripción -->
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
            <span class="text-sm font-medium block mb-2" style="color: #9ca3af;">Ingreso Inscripción</span>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">
            ${{ number_format($totalRevenue, 2) }}
            </p>
        </div>

        <!-- Ingresos Varios -->
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
            <span class="text-sm font-medium block mb-2" style="color: #9ca3af;">Ingresos Varios</span>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">
            ${{ number_format($totalIncome, 2) }}
            </p>
        </div>

        <!-- Egresos -->
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
            <span class="text-sm font-medium block mb-2" style="color: #9ca3af;">Egresos</span>
            <p class="text-2xl font-bold text-red-500 dark:text-red-400">
            ${{ number_format($totalExpenses, 2) }} <!-- Muestra el total de egresos -->
            </p>
        </div>

        <!-- Saldo -->
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
            <span class="text-sm font-medium block mb-2" style="color: #9ca3af;">Saldo</span>
            <p class="text-2xl font-bold text-green-500 dark:text-green-400">
            ${{ number_format($saldo ?? 0, 2) }}
            </p>
        </div>

        <!-- Inscripciones por aprobar -->
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
            <span class="text-sm font-medium block mb-2" style="color: #9ca3af;">Inscripciones por Aprobar</span>
            <p class="text-2xl font-bold text-blue-500 dark:text-blue-400">${{ number_format($pendingAmount ?? 0, 2) }}</p>
        </div>
    </div>
</div>