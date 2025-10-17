import { createRouter, createWebHistory } from 'vue-router';
import Register from '@/components/Register.vue';
import Login from '@/components/Login.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/register',
      name: 'Register',
      component: Register
    },

    {
      path: '/login',
      name: 'Login',
      component: Login
    },

  ]
});

export default router;
