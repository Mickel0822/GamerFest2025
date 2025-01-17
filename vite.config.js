import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/stylesDash.css'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            // Agregamos alias para evitar problemas con rutas de FullCalendar
            '@fullcalendar/core': 'node_modules/@fullcalendar/core',
            '@fullcalendar/daygrid': 'node_modules/@fullcalendar/daygrid',
        },
    },

    build: {
        outDir: 'public_html/build',  // Asegúrate de que la salida se dirige a public_html/build
        manifest: true,  // Asegura que se genere el manifest
    }
});

