import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import 'croppie/croppie.js';
import 'croppie/croppie.css';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js', 
                'croppie/croppie.css', 
                'croppie/croppie.js'
            ],
            refresh: true,
        }),
    ],
});
