<template>

    <div class="form-signup w-25">
        <form>
            <h1 class="h3 mb-3 fw-bold text-center">Sign-up</h1>

            <div class="form-floating mb-3">
                <input v-model="name" type="text" class="form-control" id="name"
                       placeholder="nam">
                <label for="floatingInput">Name</label>
            </div>
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
            <div class="form-floating mb-3">
                <input v-model="password_confirmation" type="password" class="form-control" id="floatingPasswordConfirmation"
                       placeholder="Password confirmation">
                <label for="floatingPasswordConfirmation">Password confirmation</label>
            </div>

            <p class="text-danger">{{ error }}</p>

            <button @click.prevent="register" class="btn btn-primary w-100 py-2" type="submit">Register</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "Login",

    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            error: null,
        }
    },

    methods: {
        register() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/register', {name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation})
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
.form-signup {

    margin: auto;
    margin-top: 7%;

    button {
        background-color: #6E41E2;
    }

}

</style>
