import Home from './components/Home.vue';
import Example from './components/Example.vue';
import Proyecto from './components/pages/project/ProyectoComponent.vue'

export const routes = [
    { path: '/vue/:id', component: Proyecto, name: 'Home' },
    { path: '/vue/example', component: Example, name: 'Example' },
    { path: '/vue/proyecto/:id', component: Proyecto, name: 'Proyecto', params: true}
];