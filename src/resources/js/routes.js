import Home from './components/pages/home/HomeComponent.vue';
import Example from './components/Example.vue';
import Proyecto from './components/pages/project/ProyectoComponent.vue'
import Search from './components/pages/search/SearchComponent.vue'
import Main from './components/pages/main/MainComponent.vue'
import Diagrama from './components/DiagramaClaseComponente.vue'


export const routes = [
    { path: '/', component: Home, name: 'Home' },
    { path: '/test', component: Diagrama, name: 'diagrama' },
    { path: '/example', component: Example, name: 'Example' },
    { path: '/proyecto/:id', component: Proyecto, name: 'Proyecto', params: true,     
    children: [
        { path: "/diagrama", component: Diagrama },
      ]
    },
    { path: '/search', component: Search, name: 'Search', params: true },
    { path: '/home', component: Main, name: 'Main', params: true },
];