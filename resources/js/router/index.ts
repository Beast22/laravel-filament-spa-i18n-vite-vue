import { createRouter, createWebHistory } from 'vue-router'
import IndexView from '@/views/IndexView.vue'
import BuyRentView from '@/views/BuyRentView.vue'
import { getInitialLocale } from '@/utils/locale'


const routes = [
        {
            path: '/',
            redirect: `/${getInitialLocale()}`,
        },
        {
            name: 'Index',
            path: '/:locale',
            component: IndexView,
        },
        {
            name: 'Buy',
            path: '/:locale/buy-rent/:slug',
            component: BuyRentView,
        },
        {
            name: 'Sold',
            path: '/:locale/sold',
            component: () => import('@/views/SoldView.vue'),
        },
        {
            name: 'Blog',
            path: '/:locale/blog',
            component: () => import('@/views/BlogView.vue'),
        },
        {
            name: 'object',
            path: '/:locale/object/:slug',
            component: () => import('@/views/ObjectView.vue'),
        },
        {
            name: 'blogpost',
            path: '/:locale/blog/:slug',
            component: () => import('@/views/PostView.vue'),
        },
        {
            name: 'Private',
            path: '/:locale/pages/:slug',
            component: () => import('@/views/PrivacyView.vue'),
        },

    ]


const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition){
            return savedPosition
        }
        if (to.hash){
            return { 
                el: to.hash,
                behavior: 'smooth'
            }
        }
    }
  })

export default router