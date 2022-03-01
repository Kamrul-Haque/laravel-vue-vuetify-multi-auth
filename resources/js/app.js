require('./bootstrap');

import Vue from 'vue';
import {createInertiaApp} from '@inertiajs/inertia-vue';
import {InertiaProgress} from '@inertiajs/progress';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({el, app, props, plugin}) {
        Vue.use(plugin)
            .mixin({methods: {route}})
            .use(Vuetify);

        new Vue({
            vuetify: new Vuetify({
                theme: {
                    themes: {
                        light: {
                            primary: '#41b883',
                            secondary: '#34495E',
                            accent: '#1976D2',
                            error: '#dc143c',
                        },
                    },
                },
            }),
            render: h => h(app, props),
        }).$mount(el)
    },
});

InertiaProgress.init({color: '#4B5563'});
