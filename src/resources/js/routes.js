import Home from './components/Home.vue';
import Example from './components/Example.vue';
import Proyecto from './components/pages/project/ProyectoComponent.vue'
import Search from './components/pages/search/SearchComponent.vue'

export const routes = [
    { path: '/vue', component: Home, name: 'Home' },
    { path: '/vue/example', component: Example, name: 'Example' },
    { path: '/vue/proyecto/:id', component: Proyecto, name: 'Proyecto', params: true },
    { path: '/vue/search', component: Search, name: 'Search', params: true },
];