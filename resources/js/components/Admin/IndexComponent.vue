<template>
    <div class="container d-flex">
        <NavBar></NavBar>
        <router-view ></router-view>
    </div>
</template>

<script>
import NavBar from "./NavBar.vue";

export default {
    name: "IndexComponent",
    components: {NavBar}

}
</script>

<style scoped>

</style>
