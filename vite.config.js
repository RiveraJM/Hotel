import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
           
            input: ['resources/css/app.css',
                    'resources/css/dashboard.css', 
                    'resources/css/habitaciones.css', 
                    'resources/css/reservas.css',
                    'resources/css/checkin.css',
                    'resources/css/checkout.css',
                    'resources/css/limpieza.css',
                    'resources/css/mantenimiento.css',
                    'resources/css/caja.css',
                    'resources/css/reportes.css',
                    'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
