import Home from './components/pages/home/HomeComponent.vue';
import Example from './components/Example.vue';
import Proyecto from './components/pages/project/ProyectoComponent.vue'
import Search from './components/pages/search/SearchComponent.vue'
import Main from './components/pages/main/MainComponent.vue'
import Diagrama from './components/pages/diagram/DiagramaComponente.vue'


export const routes = [
    { path: '/', component: Home, name: 'Home' },
    { path: '/test', component: Diagrama, name: 'test' },
    { path: '/example', component: Example, name: 'Example' },
    { path: '/proyecto/:id/diagrama/:id_diagrama', component: Diagrama, name: 'diagrama', params: true },
    { path: '/proyecto/:id', component: Proyecto, name: 'Proyecto', params: true},
    { path: '/search', component: Search, name: 'Search', params: true },
    { path: '/home', component: Main, name: 'Main', params: true },
];