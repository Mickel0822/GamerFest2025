
@php
    $user = filament()->auth()->user();
@endphp

<x-filament-widgets::widget class="fi-account-widget">
    <link href="https://fonts.cdnfonts.com/css/adventure-request" rel="stylesheet">
    <style>
        body {
            background-color: rgb(9, 64, 82) !important; /* Fondo base */
            font-family: 'Adventure Request' !important; /* Fuente personalizada */
            background-repeat: no-repeat; /* Sin repetir */
            background-position: c  enter; /* Centrar imagen */
            background-size: contain; /* Ajusta la imagen dentro del contenedor */
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

        /* Estilo para las etiquetas de los campos */
        label {
            display: block;
            margin: 10px 0 5px;
            font-size: 14px;
            color: #555;
        }

        /* Estilo para los campos de entrada */
        input[type="text"], input[type="number"], input[type="email"], input[type="date"], select, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            color: #333;
        }

        /* Estilo para los botones */
        button {
            width: 100%;
            padding: 12px;
            background-color: rgb(31, 78, 94);
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: rgb(9, 64, 82);
        }

        /* Estilo para los mensajes de error */
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        /* Estilo para la tabla de datos */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color:rgb(9, 64, 82);
            font-weight: bold;
        }

        /* Estilo para las celdas de los botones de acción */
        button.action-button {
            width: auto;
            padding: 6px 12px;
            font-size: 14px;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
        }

        button.action-button:hover {
            background-color: #218838;
        }

        button.action-button.delete {
            background-color: #dc3545;
        }

        button.action-button.delete:hover {
            background-color: #c82333;
        }

        /* Estilo para el pie del formulario */
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }

    </style>

    <x-filament::section>
        <div class="flex items-center gap-x-3 mb-6">
            <div class="flex-1 mb-4">
                <h2 class="text-base font-semibold leading-6 text-gray-950 dark:text-white inline-flex items-center">
                    {{ __('filament-panels::widgets/account-widget.welcome', ['app' => config('app.name')]) }}:&nbsp&nbsp
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        {{ filament()->getUserName($user) }}
                    </span>
                </h2>
                
            </div>
        </div>

        {{-- Sección que solo aparece para el rol "participant" --}}

        @if ($user->role === 'participant')

        <h2 class="text-4xl font-extrabold text-gray-800 dark:text-gray-100 mt-6 text-center">
            Número de Juegos Registrados
        </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                {{-- Juegos Grupales Verificados --}}
                <div class="p-4 bg-purple-100 rounded-md shadow text-center">
                    <h3 class="text-sm font-medium text-yellow-700">Juegos Grupales</h3>
                    <p class="text-2xl font-bold text-yellow-800">
                        {{ number_format($verifiedGroupGames) }}
                    </p>
                </div>

                {{-- Juegos Individuales Verificados --}}
                <div class="p-4 bg-purple-100 rounded-md shadow text-center">
                    <h3 class="text-sm font-medium text-purple-700">Juegos Individuales</h3>
                    <p class="text-2xl font-bold text-purple-800">
                        {{ number_format($verifiedIndividualGames) }}
                    </p>
                </div>
            </div>
        @endif

    </x-filament::section>

</x-filament-widgets::widget>
