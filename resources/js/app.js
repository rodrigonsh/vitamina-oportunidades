import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import { createRouter, createMemoryHistory } from 'vue-router';

import App from './App.vue';

// pages
import HomePage from './pages/HomePage.vue'
import AboutPage from './pages/AboutPage.vue'
import VendedorPage from './pages/VendedorPage.vue'
import ProdutosPage from './pages/ProdutosPage.vue'
import ClientesPage from './pages/ClientesPage.vue'
import NovaOportunidadePage from './pages/NovaOportunidadePage.vue'
import OportunidadePage from './pages/OportunidadePage.vue'

const router = createRouter({
    history: createMemoryHistory(),
    routes: [
        {path: '/', 'name': 'Home', 'component': HomePage},
        {path: '/about', 'name': 'About', 'component': AboutPage},
        {path: '/user', 'name': 'User', 'component': VendedorPage},
        {path: '/produtos', 'name': 'Produtos', 'component': ProdutosPage},
        {path: '/clientes', 'name': 'Clientes', 'component': ClientesPage},
        {path: '/nova_oportunidade', 'name': 'Nova Oportunidade', 'component': NovaOportunidadePage},
        {path: '/oportunidade/:id', 'name': 'Oportunidade', 'component': OportunidadePage},
    ]
})

createApp(App)
    .use(router)
    .mount('#app');

