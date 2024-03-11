import HomePage from '../pages/HomePage.vue';

const routes = [
    {
        path: '/',
        component: HomePage,
    }
];


const router = createRouter({
    history: createWebHistory(),
    routes
  });

  export default router;
