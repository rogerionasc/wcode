// Configuração default
// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import vue from '@vitejs/plugin-vue';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: 'resources/js/app.js',
//             ssr: 'resources/js/ssr.js',
//             refresh: true,
//         }),
//         vue({
//             template: {
//                 transformAssetUrls: {
//                     base: null,
//                     includeAbsolute: false,
//                 },
//             },
//         }),
//     ],
// });
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        sourcemap: true, // Ativa source maps
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        const parts = id.split('node_modules/');
                        const name = parts[1].split('/')[0];
                        return `vendor-${name}`;
                    }
                }
            },
        },
        chunkSizeWarningLimit: 1000,
    },
});
