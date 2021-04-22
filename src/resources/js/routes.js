import Home from './components/Home.vue';
import Example from './components/Example.vue';
import Proyecto from './components/pages/project/ProyectoComponent.vue'

export const routes = [
    { path: '/vue', component: Home, name: 'Home' },
    { path: '/vue/example', component: Example, name: 'Example' },
    { path: '/vue/proyecto/:id', componente: Proyecto, name:'Proyecto'}
];