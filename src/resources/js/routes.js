import Home from './components/Home.vue';
import Example from './components/Example.vue';
import Proyecto from './components/pages/project/ProyectoComponent.vue'
import Search from './components/pages/search/SearchComponent.vue'

export const routes = [
    { path: '/', component: Home, name: 'Home' },
    { path: '/example', component: Example, name: 'Example' },
    { path: '/proyecto/:id', component: Proyecto, name: 'Proyecto', params: true },
    { path: '/search', component: Search, name: 'Search', params: true },
];