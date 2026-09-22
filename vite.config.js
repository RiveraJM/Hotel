import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: 'localhost',
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost',
            port: 5173,
        },
    },
    preview: {
        host: 'localhost',
        port: 4173,
        strictPort: true,
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/dashboard.css',
                'resources/css/habitaciones.css',
                'resources/css/huespedes.css',
                'resources/css/reservas.css',
                'resources/css/checkin.css',
                'resources/css/checkout.css',
                'resources/css/limpieza.css',
                'resources/css/mantenimiento.css',
                'resources/css/caja.css',
                'resources/css/reportes.css',
                'resources/css/habitacion-show.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
