require('./bootstrap');
import App from '@/src/App';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes';
import { Skeletor } from 'vue-skeletor';
import VueToast from 'vue-toast-notification';
import { ObserveVisibility } from 'vue-observe-visibility'
import { createPinia } from 'pinia';

const app = createApp(App);

const router = createRouter({
  history: createWebHistory(),
  routes
});

app.use(router);
app.use(VueToast);
app.use(createPinia());

app.directive('observe-visibility', {
  beforeMount: (el, binding, vnode) => {
    vnode.context = binding.instance;
    ObserveVisibility.bind(el, binding, vnode);
  },
  update: ObserveVisibility.update,
  unmounted: ObserveVisibility.unbind,
});

app.mount('#vue-app');
app.component(Skeletor.name, Skeletor);