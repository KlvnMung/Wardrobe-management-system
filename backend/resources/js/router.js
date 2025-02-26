import { createRouter, createWebHistory } from 'vue-router';
import ClothingItemList from './components/ClothingItemList.vue';
import AddClothingItem from './components/AddClothingItem.vue';
import EditClothingItem from './components/EditClothingItem.vue';
import LandingPage from './components/LandingPage.vue';
import Login from './components/Auth/Login.vue';
import Register from './components/Auth/Register.vue';
import StylistList from './components/StylistList.vue';
import SharedWardrobeList from './components/SharedWardrobeList.vue';

const routes = [
  { path: '/', component: LandingPage },
  { path: '/login', component: Login },
  { path: '/register', component: Register },
  { path: '/clothing-items', component: ClothingItemList, meta: { requiresAuth: true } },
  { path: '/add', component: AddClothingItem, meta: { requiresAuth: true } },
  { path: '/edit/:id', component: EditClothingItem, meta: { requiresAuth: true } },
  { path: '/stylists', component: StylistList, meta: { requiresAuth: true } },
  { path: '/shared-wardrobes', component: SharedWardrobeList, meta: { requiresAuth: true } },
  { path: '/logout', beforeEnter: (to, from, next) => {
      localStorage.removeItem('auth');
      next('/login');
    }
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

// Navigation guard to protect routes that require authentication
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!localStorage.getItem('auth')) {
      next({ path: '/login' });
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router;