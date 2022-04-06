require('./bootstrap');
import App from '@/src/App';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes';

const app = createApp(App);

const router = createRouter({
  history: createWebHistory(),
  routes
});

app.use(router);

app.mount('#vue-app');