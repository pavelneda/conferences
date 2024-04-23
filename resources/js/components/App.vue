<template>
    <div class="page-container">
        <Header :key="$route.fullPath"></Header>

        <div class="content-wrap">
            <router-view ></router-view>
        </div>

        <Footer></Footer>
    </div>
</template>

<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";

export default {
    components: {Header, Footer},

}
</script>

<style scoped>
.page-container {
    position: relative;
    min-height: 100vh;
}

.content-wrap {
    padding-bottom: 5rem; /* Footer height */
}
</style>

