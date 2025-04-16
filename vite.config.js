import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

const port = 5173;
const origin = `${process.env.DDEV_PRIMARY_URL}:${port}`;

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
                'app/Filament/**',
            ],
        }),
    ],
    server: {
        // respond to all network requests
        host: '0.0.0.0',
        port: port,
        strictPort: true,
        // Defines the origin of the generated asset URLs during development,
        // this will also be used for the public/hot file (Vite devserver URL)
        origin: origin,
        cors: {
            origin: /https?:\/\/([A-Za-z0-9\-\.]+)?(\.test\)(?::\d+)?$/,
        },
    }
});
