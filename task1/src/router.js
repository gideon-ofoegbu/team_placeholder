import Vue from 'vue'
import Router from 'vue-router'


Vue.use(Router)

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [{
            path: '/',
            name: 'login',
            meta: { layout: "auth" },
            component: () =>
                import ('@/views/Login.vue')
        },
        {
            path: '/signup',
            name: 'signup',
            meta: { layout: "auth" },
            component: () =>
                import ('@/views/Signup.vue')
        },
    ]
});

export default router;