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
        path: "/account",
        name: 'account',
        component: () => import("./components/Authorization/Account.vue"),
    },
    {
        path: "/admin",
        name: 'admin',
        component: () => import("./components/Admin/IndexComponent.vue"),
        children: [
            {
                path: "materials",
                name: 'admin.materials',
                component: () => import("./components/Admin/Materials/IndexComponent.vue"),
            },
            {
                path: "materials/:id/edit",
                name: 'admin.materials.edit',
                component: () => import("./components/Admin/Materials/EditComponent.vue"),
            },
            {
                path: "conferences",
                name: 'admin.conferences',
                component: () => import("./components/Admin/Conferences/IndexComponent.vue"),
            },
            {
                path: "conferences/:id/edit",
                name: 'admin.conferences.edit',
                component: () => import("./components/Admin/Conferences/EditComponent.vue"),
            },
            {
                path: "users",
                name: 'admin.users',
                component: () => import("./components/Admin/Users/IndexComponent.vue"),
            },
        ]
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
        props: (route) => ({query: route.query})
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
