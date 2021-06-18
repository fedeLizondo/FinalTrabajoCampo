
export const routes = [
    { path: '/', component: () => import(/* webpackChunkName: "Root" */ './components/pages/home/HomeComponent.vue'), name: 'Home' },
    { path: '/example', component: () => import(/* webpackChunkName: "Example" */ './components/Example.vue'), name: 'Example' },
    { path: '/proyecto/:id/diagrama/:id_diagrama', component: () => import(/* webpackChunkName: "Diagrama" */ './components/pages/diagram/DiagramaComponente.vue'), name: 'diagrama', params: true },
    { path: '/proyecto/:id', component: () => import(/* webpackChunkName: "Proyecto" */ './components/pages/project/ProyectoComponent.vue'), name: 'Proyecto', params: true },
    { path: '/search',  component: () => import(/* webpackChunkName: "Search" */ './components/pages/search/SearchComponent.vue'), name: 'Search', params: true },
    { path: '/home',  component: () => import(/* webpackChunkName: "Home" */ './components/pages/main/MainComponent.vue'), name: 'Main', params: true },
];