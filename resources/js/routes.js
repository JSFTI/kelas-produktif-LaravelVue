import { DasarKomponen, VueRouting, Welcome, VueRoutingNest, Posts, Post, PostCreate } from '@/src/pages';

const routes = [
  {name: 'welcome', path: '/', component: Welcome},
  {name: 'dasar-komponen', path: '/dasar-komponen/:section?', component: DasarKomponen},
  {name: 'vue-router', path: '/vue-router', component: VueRouting, children: [
    {name: 'vue-router-nest', path: 'nest', component: VueRoutingNest}
  ]},
  {name: 'posts', path: '/posts', component: Posts},
  {name: 'post', path: '/posts/:post', component: Post},
  {name: 'post-create', path: '/post/create', component: PostCreate }
];

export default routes;