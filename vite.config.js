import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        // SECURITY FIX: Paksa bind ke IPv4 (127.0.0.1) bukan IPv6 (::1).
        // IPv6 bracket notation [::1] tidak valid di CSP source list,
        // sehingga browser menolak semua script/style dari Vite dev server.
        host: '127.0.0.1',
        port: 5173,
        hmr: {
            host: '127.0.0.1',
        },
    },
});