import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import(/* webpackChunkName: "home" */ '../views/Home.vue'),
  },
  {
    path: '/events',
    name: 'Events',
    component: () => import(/* webpackChunkName: "events" */ '../views/Events.vue'),
  },
  {
    path: '/category/:category_slug',
    name: 'Category',
    component: () => import(/* webpackChunkName: "category" */ '../views/example/Category.vue'),
  },
  {
    path: '/single/:single_slug',
    name: 'Single',
    component: () => import(/* webpackChunkName: "single" */ '../views/example/Single.vue'),
  },
  {
    path: '*',
    component: () => import(/* webpackChunkName: "error404" */'../views/404.vue'),
    name: '404',
  },
];

const router = new VueRouter({
  mode: 'history',
  base: '/',
  routes,
});

export default router;
