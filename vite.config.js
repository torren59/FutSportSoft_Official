import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/layouts/home.css'],
            refresh: true,
        }),
    ],
    server: {
        https: true,
        host: 'localhost',
    },
});
