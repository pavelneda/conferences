import {createRouter, createWebHistory} from "vue-router";

const routes = [
    {
        path: "/",
        name: 'main',
        component: () => import("./components/Main/IndexComponent.vue"),
    },
    {
        path: "/sign-in",
        name: 'sign-in',
        component: () => import("./components/Authorization/Login.vue"),
    },
    {
        path: "/sign-up",
        name: 'sign-up',
        component: () => import("./components/Authorization/Registration.vue"),
    },
    {
        path: "/conferences",
        name: 'conferences',
        component: () => import("./components/Conferences/Actual conferences/IndexComponent.vue"),
    },
    {
        path: "/archive-conferences",
        name: 'archive-conferences',
        component: () => import("./components/Conferences/Archive conferences/IndexComponent.vue"),
    },
    {
        path: "/conferences/:id",
        name: 'conferences.show',
        component: () => import("./components/Conferences/ShowComponent.vue"),
    },
    {
        path: "/materials",
        name: 'materials',
        component: () => import("./components/Materials/IndexComponent.vue"),
        props: (route) => ({ query: route.query })
    },
    {
        path: "/materials/:id",
        name: 'materials.show',
        component: () => import("./components/Materials/ShowComponent.vue"),
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token')

    if (!token) {
        if (to.name === 'sign-in' || to.name === 'sign-up') {
            return next()
        } else {
            return next({
                name: 'sign-in'
            })
        }
    } else {
        if (to.name === 'sign-in' || to.name === 'sign-up') {
            return next({
                name: 'main'
            })
        }
    }

    next()
})



export default router;
