<template>
    <div class="container">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3  logo-wrapper">
                <router-link :to="{ name: 'main' }">
                    <a href="#" class="d-inline-flex link-body-emphasis text-decoration-none">
                        <img src="/storage/images/logo.png" alt="Conference" class="img-fluid">
                    </a>
                </router-link>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <router-link :to="{ name: 'conferences' }" class="nav-link px-2">
                    <li>Найближчі конференції</li>
                </router-link>
                <router-link :to="{ name: 'archive-conferences' }" class="nav-link px-2">
                    <li>Архів конференцій</li>
                </router-link>
                <li><a href="#" class="nav-link px-2">Матеріали</a></li>
            </ul>

            <div class="col-md-3 text-end">
                <router-link :to="{ name: 'sign-in' }" v-if="!token">
                    <button type="button" class="btn btn-outline-primary me-2">Log in</button>
                </router-link>
                <router-link :to="{ name: 'sign-up' }" v-if="!token">
                    <button type="button" class="btn btn-primary">Sign-up</button>
                </router-link>
                <button @click.prevent="logout" v-if="token" type="button" class="btn btn-primary">Logout</button>
            </div>
        </header>
    </div>
</template>

<script>
export default {
    name: "Header",

    data() {
        return {
            token: null
        }
    },

    mounted() {
        this.getToken();
    },


    methods: {
        logout() {
            axios.post('/logout')
                .then(res => {
                    localStorage.removeItem('x_xsrf_token')
                    this.$router.push({name: 'sign-in'})
                });
        },

        getToken() {
            this.token = localStorage.getItem('x_xsrf_token')
        }
    }
}
</script>


<style scoped lang="scss">

.logo-wrapper {
    margin-bottom: -3rem;
    margin-top: -3rem;
    margin-left: -5rem;
}

</style>
