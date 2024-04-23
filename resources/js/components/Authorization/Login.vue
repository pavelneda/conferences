<template>

    <div class="form-signin w-25">
        <form>
            <h1 class="h3 mb-3 fw-bold text-center">Log in</h1>

            <div class="form-floating mb-3">
                <input v-model="email" type="email" class="form-control" id="floatingInput"
                       placeholder="name@example.com">
                <label for="floatingInput">E-mail</label>
            </div>
            <div class="form-floating mb-3">
                <input v-model="password" type="password" class="form-control" id="floatingPassword"
                       placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <p class="text-danger">{{ error }}</p>

            <button @click.prevent="login" class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "Login",

    data() {
        return {
            email: null,
            password: null,
            error: null,
        }
    },

    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {email: this.email, password: this.password})
                    .then(res => {
                        localStorage.setItem('x_xsrf_token', res.config.headers['X-XSRF-TOKEN'])
                        this.$router.push({name: 'main'})
                    })
                    .catch(err => {
                        this.error = err.response.data.message
                    });
            });
        }
    }
}
</script>


<style scoped lang="scss">
.form-signin {

    margin: auto;
    margin-top: 7%;

    button {
        background-color: #6E41E2;
    }

}

</style>
