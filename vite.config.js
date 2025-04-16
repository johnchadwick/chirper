import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true, // Enables hot reload for Laravel files
        }),
    ],
    server: {
        host: '0.0.0.0', // Critical for Docker access
        port: 5175, // Hardcoded to match your .env/Docker setup
        strictPort: true, // Prevent Vite from trying other ports
        hmr: {
            host: 'chirper.test', // Matches your test domain
            protocol: 'ws', // WebSocket for HMR
        },
    },
});
