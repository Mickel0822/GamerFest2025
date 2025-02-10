<div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6 col-span-full">

    <!-- Editar los nombres por los que corresponde -->

    <!-- Resumen Financiero -->
    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Resumen Financiero</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <!-- Ingreso Inicial -->
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 block mb-2">Ingreso Inicial</span>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($initialIncome ?? 1000, 2) }}</p>
        </div>

        <!-- Ingresos Varios -->
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 block mb-2">Ingresos Varios</span>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($variousIncome ?? 500, 2) }}</p>
        </div>

        <!-- Egresos -->
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 block mb-2">Egresos</span>
            <p class="text-2xl font-bold text-red-500 dark:text-red-400">${{ number_format($expenses ?? 800, 2) }}</p>
        </div>

        <!-- Saldo -->
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 block mb-2">Saldo</span>
            <p class="text-2xl font-bold text-green-500 dark:text-green-400">${{ number_format($balance ?? 700, 2) }}</p>
        </div>

        <!-- Importe Aprobado -->
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 block mb-2">Importe Aprobado</span>
            <p class="text-2xl font-bold text-blue-500 dark:text-blue-400">${{ number_format($approvedAmount ?? 900, 2) }}</p>
        </div>
    </div>
</div>