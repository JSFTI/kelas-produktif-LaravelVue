const Welcome = () => import('@/src/pages/Welcome');
const Posts = () => import('@/src/pages/Posts');
const Post = () => import('@/src/pages/Post');
const PostCreate = () => import('@/src/pages/PostCreate');
const PostEdit = () => import('@/src/pages/PostEdit');
const Register = () => import('@/src/pages/Register');
const Login = () => import('@/src/pages/Login');
const Profile = () => import('@/src/pages/Profile');

const routes = [
  {name: 'welcome', path: '/', component: Welcome},
  {name: 'posts', path: '/posts', component: Posts},
  {name: 'post', path: '/post/:post/:slug', component: Post},
  {name: 'post-create', path: '/post/create', component: PostCreate },
  {name: 'post-edit', path: '/post/edit/:post', component: PostEdit},
  {name: 'profil', path: '/profil', component: Profile},
  {name: 'register', path: '/register', component: Register },
  {name: 'login', path: '/login', component: Login}
];

export default routes;