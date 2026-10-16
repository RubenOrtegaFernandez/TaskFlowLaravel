import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/vidre.js', 'resources/js/registre.js'],
            refresh: true,
        }),
    ],
});