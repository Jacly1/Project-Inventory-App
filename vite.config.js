import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/tailwind.css', // Tambahkan ini untuk Tailwind CSS
                'resources/js/app.js',         // Biarkan input JS jika tetap dibutuhkan
            ],
            refresh: true,
        }),
    ],
});
