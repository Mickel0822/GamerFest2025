<x-filament::page>
    <link href="https://fonts.cdnfonts.com/css/adventure-request" rel="stylesheet">
    <style>
        body {
            background-color: rgb(9, 64, 82) !important; /* Fondo base */
            font-family: 'Adventure Request' !important; /* Fuente personalizada */
            background-repeat: no-repeat; /* Sin repetir */
            background-position: c  enter; /* Centrar imagen */
            background-size: contain; /* Ajusta la imagen dentro del contenedor */
            /*opacity: 0.2; /* Suaviza el efecto de marca de agua */
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/images/logoGamerFest1.png'); /* Imagen de fondo */
            background-repeat: no-repeat; /* Evitar repetición de la imagen */
            background-position: center; /* Centrar la imagen */
            background-size: contain; /* Ajusta la imagen dentro del contenedor */
            opacity: 0.05; /* Controla la visibilidad de la marca de agua */
            z-index: -1; /* Asegura que la imagen esté detrás del contenido */
        }
    </style>
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
