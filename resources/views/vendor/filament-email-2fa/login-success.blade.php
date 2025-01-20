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
            color: blue;
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
            color: blue;
            /*opacity: 0.05; /* Controla la visibilidad de la marca de agua */
            z-index: -1; /* Asegura que la imagen esté detrás del contenido */
            
        }

        form button {
            color: black !important;
            padding: 10px !important;
            border-radius: 4px !important;
            border: 2px solid #167FC6  !important; /* Borde inicial */
        }

        h1 {
            color: rgb(0, 35, 82) !important; /* Cambia el color del título */
            text-align: center !important;
            margin-bottom: 20px !important;
        }

        .h3{
            color: blue !important;
        }
    </style>  
    <x-filament::button class="bg-blue-500 text-white px-6 py-2 rounded" href="{{ \Filament\Facades\Filament::getUrl() }}" tag="a">
        @lang('filament-email-2fa::filament-email-2fa.continue')
    </x-filament::button>
</x-filament-panels::page.simple>
