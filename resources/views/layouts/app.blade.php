<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/LOGO.png') }}" type="image/png">
    <!-- Opción adicional para iconos .ico -->
    <!-- <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"> -->

    <!-- Incluye estilos generados por Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Agrega también el archivo app.js -->
    @stack('styles') <!-- Para agregar estilos adicionales -->
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-500 text-white p-4">
        <h1 class="text-2xl font-bold">{{ config('app.name', 'Laravel') }}</h1>
    </header>

    <main class="container mx-auto py-6">
        @yield('content') <!-- Sección principal de contenido -->
    </main>

    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} - Todos los derechos reservados.</p>
    </footer>

    <!-- Cargar scripts adicionales -->
    @stack('scripts') <!-- Esto se asegura de cargar los scripts adicionales cuando se agregan -->
</body>
</html>
