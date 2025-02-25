import { createRouter, createWebHistory } from 'vue-router';
import ClothingItemList from './components/ClothingItemList.vue';
import AddClothingItem from './components/AddClothingItem.vue';

const routes = [
  { path: '/', component: ClothingItemList },
  { path: '/add', component: AddClothingItem }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;