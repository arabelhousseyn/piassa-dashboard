import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
//component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
const routes = [
    {
        path : '/',
        component: () => import('../pages/LoginPage')
    },
    {
        path : '/home',
        component: () => import('../pages/DashboardPage'),
        children : [
            {
                path : '/',
                component : () => import('../components/MainComponent')
            }
        ]
    }

]

export default new VueRouter({
    mode: 'history',
    routes
})

