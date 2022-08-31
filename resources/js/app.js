import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import { createRouter, createMemoryHistory } from 'vue-router';

import App from './App.vue';

// pages
import HomePage from './pages/HomePage.vue'
import AboutPage from './pages/AboutPage.vue'

const router = createRouter({
    history: createMemoryHistory(),
    routes: [
        {path: '/', 'name': 'Home', 'component': HomePage},
        {path: '/about', 'name': 'About', 'component': AboutPage},
    ]
})

createApp(App)
    .use(router)
    .mount('#app');

