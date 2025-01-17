<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Broadcasting
    |--------------------------------------------------------------------------
    |
    | Configuración para permitir la transmisión en tiempo real. Puedes
    | descomentar y configurar Laravel Echo aquí si necesitas websockets.
    |
    */

    'broadcasting' => [
        // 'echo' => [
        //     'broadcaster' => 'pusher',
        //     'key' => env('VITE_PUSHER_APP_KEY'),
        //     'cluster' => env('VITE_PUSHER_APP_CLUSTER'),
        //     'wsHost' => env('VITE_PUSHER_HOST'),
        //     'wsPort' => env('VITE_PUSHER_PORT'),
        //     'wssPort' => env('VITE_PUSHER_PORT'),
        //     'authEndpoint' => '/broadcasting/auth',
        //     'disableStats' => true,
        //     'encrypted' => true,
        //     'forceTLS' => true,
        // ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Este es el disco de almacenamiento predeterminado que Filament usará para
    | guardar archivos. Puedes configurarlo en el archivo `config/filesystems.php`.
    |
    */

    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Assets Path
    |--------------------------------------------------------------------------
    |
    | Directorio donde los recursos de Filament serán publicados. Es relativo
    | al directorio `public` de tu aplicación.
    |
    */

    'assets_path' => null,

    /*
    |--------------------------------------------------------------------------
    | Cache Path
    |--------------------------------------------------------------------------
    |
    | Directorio donde Filament almacenará archivos de caché para optimizar
    | el registro de componentes.
    |
    */

    'cache_path' => base_path('bootstrap/cache/filament'),

    /*
    |--------------------------------------------------------------------------
    | Livewire Loading Delay
    |--------------------------------------------------------------------------
    |
    | Configuración del tiempo de espera antes de mostrar indicadores de carga.
    | Puedes usar `none` para mostrarlos inmediatamente o `default` para aplicar
    | el retraso estándar de Livewire (200ms).
    |
    */

    'livewire_loading_delay' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Path
    |--------------------------------------------------------------------------
    |
    | Define el prefijo de las rutas de Filament. Si deseas que las páginas de
    | Filament estén disponibles directamente sin prefijo, usa una cadena vacía.
    |
    */

    'path' => 'admin', // Cambia a '' si no deseas un prefijo.

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Middleware que se aplicará a todas las rutas de Filament. Asegúrate de que
    | el middleware `auth` esté presente para restringir el acceso.
    |
    */

    'middleware' => [
        'web',
        'auth', // Requiere que los usuarios estén autenticados.
    ],

];
