import { DasarKomponen, VueRouting, Welcome } from '@/src/pages';

const routes = [
  {name: 'welcome', path: '/', component: Welcome},
  {name: 'dasar-komponen', path: '/dasar-komponen/:section?', component: DasarKomponen},
  {name: 'vue-router', path: '/vue-router', component: VueRouting},
];

export default routes;