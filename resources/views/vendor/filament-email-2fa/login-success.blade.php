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
            color:rgb(0, 0, 0) !important; /* Cambia el color del texto a blanco */
            background-repeat: no-repeat; /* Sin repetir */
            background-position: center; /* Centrar imagen */
            background-size: contain; /* Ajusta la imagen dentro del contenedor */
            /*opacity: 0.2; / Suaviza el efecto de marca de agua */
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

        h3 {
            color: rgb(0, 35, 82) !important; /* Cambia el color del título */
            text-align: center !important;
            margin-bottom: 5px !important;
        }

        #form{
            position: relative; /* Para que los elementos dentro no se vean afectados */
            background-color:rgb(189, 220, 250)!important; /* Fondo blanco con opacidad del 80% */
            padding: 20px!important;
            border-radius: 8px!important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para el formulario */
        #form input {
            background-color:#dff2f9 !important;
            padding: 20px !important;
            
            border-radius: 8px !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
        }


        /* Estilos para el checkbox */
        #form input[type="checkbox"] {
            border: 2px solid #167FC6  !important; /* Borde inicial */
            border-radius: 10px !important;
            padding: 8px!important;
            background-color: #66b3ff !important; /* Fondo del checkbox */
            cursor: pointer; /* Cambia el cursor al pasar */
            margin-right: -6px !important; /* Espacio entre el checkbox y el texto */
        }

        /* Estilos para los botones dentro del formulario */
        #form button {
            background-color: #66b3ff !important; /* Azul claro */
            color: white !important;
            padding: 10px !important;
            color: black !important; /* Cambia el color del texto a blanco */
            border-radius: 4px !important;
            border: 2px solid #167FC6  !important; /* Borde inicial */
        }

        /* Hover sobre los botones */
        .form button:hover {
            box-shadow: 0 0 15px 5px rgba(102, 179, 255, 0.8) !important; /* Haz de luz azul */
        }

        /* Haz de luz pulsante cuando el botón está enfocado */
        #form button:focus {
            outline: none; /* Elimina el borde por defecto */
            box-shadow: 0 0 20px 10px rgba(102, 179, 255, 0.6),
                        0 0 40px 20px rgba(102, 179, 255, 0.3) !important; /* Haz más intenso */
        }

        /* Agregar icono sobre el título */
        #form img.icon {
            display: block;
            margin: 0 auto 5px; /* Centrado horizontal y margen debajo */
            width: 50%; /* Reducir el tamaño del icono a la mitad */
            height: auto; /* Mantener la proporción de la imagen */
        }
    </style>  
    <x-filament::button class="bg-blue-500 text-white px-6 py-2 rounded" href="{{ \Filament\Facades\Filament::getUrl() }}" tag="a">
        @lang('filament-email-2fa::filament-email-2fa.continue')
    </x-filament::button>
</x-filament-panels::page.simple>
