import { createWebHistory,createRouter } from "vue-router";
import Signup from '../views/Signup.vue'
import LoginV from '../views/Login.vue'
import HomeV from '../views/HomeV.vue'
import AddRdv from '../views/AppointmentV.vue'
import ErrorPage from '../views/ErrorPage.vue'
const routes=[
    {
        path: '/',
        name: 'HomeV',
        component: HomeV
    },
    {
        path: '/appointment',
        name: 'AppointmentV',
        component: AddRdv
    },
    {
        path: '/sign-up',
        name: 'SignUp',
        component: Signup
    },
    {
        path: '/login',
        name: 'Login',
        component: LoginV
    },
    {
        path: '/:catchAll(.*)',
        name: 'ErrorPage',
        component: ErrorPage
    }
]


const router=createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});
export default router