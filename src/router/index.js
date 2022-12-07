import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AddNewCar from '@/components/Cars/AddNewCar.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomeView
  },
  {
    path: '/getters',
    name: 'GettersPage',
    component: () => import('@/views/GettersPage.vue')
  },
  {
    path: '/mutations',
    name: 'MutationsPage',
    component: () => import('@/views/MutationsPage.vue')
  },
  {
    path: '/actions',
    name: 'ActionsPage',
    component: () => import('@/views/ActionsPage.vue')
  },
  {
    path: '/About',
    name: 'AboutView',
    component: () => import('@/views/About.vue')
  },
  {
    path: '/add/new-car',
    name: 'AddNewCar',
    component: AddNewCar
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
