// import './bootstrap';
// import '../css/app.css';
import '../css/dist/css/tabler.min.css';
// import '../css/dist/css/tabler-flags.min.css';
// import '../css/dist/css/tabler-payments.min.css';
import '../css/dist/css/tabler-vendors.min.css';
// import '../css/dist/css/tabler-social.css';
import '../css/dist/custom.css';
import '../css/dist/js/tabler.esm.min.js';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
// import FlashMessage from '../js/Components/FlashMessage.vue';

const appName = import.meta.env.VITE_APP_NAME;

createInertiaApp({
    title: (title) => `${appName} - ${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
        app.component('FlashMessage', FlashMessage);
    },
    progress: {
        color: '#4B5563',
    },
});
