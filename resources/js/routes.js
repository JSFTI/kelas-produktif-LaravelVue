import { DasarKomponen, VueRouting, Welcome, VueRoutingNest } from '@/src/pages';

const routes = [
  {name: 'welcome', path: '/', component: Welcome},
  {name: 'dasar-komponen', path: '/dasar-komponen/:section?', component: DasarKomponen},
  {name: 'vue-router', path: '/vue-router', component: VueRouting, children: [
    {name: 'vue-router-nest', path: 'nest', component: VueRoutingNest}
  ]},
];

export default routes;