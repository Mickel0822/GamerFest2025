<x-filament-panels::page.simple>

<!-- Personaliza tu estilo aquí -->
    <!-- Carga el CDN de la fuente Adventure Request -->
    <link href="https://fonts.cdnfonts.com/css/adventure-request" rel="stylesheet">

    <!-- Carga el CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(9, 64, 82) !important; /* Fondo base */
            font-family: 'Adventure Request' !important; /* Fuente personalizada */
            background-repeat: no-repeat; /* Sin repetir */
            background-position: center; /* Centrar imagen */
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

        h1 {
            color: rgb(0, 35, 82) !important; /* Cambia el color del título */
            text-align: center !important;
            margin-bottom: 20px !important;
        }

        form{
            position: relative !important; /* Para que los elementos dentro no se vean afectados */
            background-color:rgb(189, 220, 250)!important; /* Fondo blanco con opacidad del 80% */
            padding: 10px!important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
            color: black !important;
        }

        form input{
            color: black !important;
            background-color: rgb(142, 199, 255) !important;
        }

        /* Estilos para los botones dentro del formulario */
        form button {
            background-color: #66b3ff !important; /* Azul claro */
            color: black !important;
            padding: 10px !important;
            border-radius: 4px !important;
            border: 2px solid #167FC6  !important; /* Borde inicial */
        }

        /* Hover sobre los botones */
        form button:hover {
            box-shadow: 0 0 15px 5px rgba(102, 179, 255, 0.8) !important; /* Haz de luz azul */
        }

        /* Haz de luz pulsante cuando el botón está enfocado */
        form button:focus {
            outline: none !important; /* Elimina el borde por defecto */
            box-shadow: 0 0 20px 10px rgba(102, 179, 255, 0.6),
                        0 0 40px 20px rgba(102, 179, 255, 0.3) !important; /* Haz más intenso */
        }

    </style>
    <x-filament-panels::form wire:submit="save">
        <span class="text-gray-500 text-sm">
            @lang('filament-email-2fa::filament-email-2fa.email_sent', ['email' => $this->getUser()->email])
        </span>
        @if (session()->has('resent-success'))
            <span class="alert text-green-500  text-sm">
                {{ session('resent-success') }}
            </span>
        @endif

        {{ $this->form }}

        <x-filament-panels::form.actions :actions="$this->getFormActions()" :full-width="$this->hasFullWidthFormActions()" />

    </x-filament-panels::form>
</x-filament-panels::page.simple>
