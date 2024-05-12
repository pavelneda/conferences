<template>
    <div class="d-flex flex-column flex-shrink-0 bg-body-tertiary me-5" style="width: 200px;">
        <span class="fs-4 text-center">Адмін панель</span>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <router-link :to="{ name: 'admin.materials' }" class="text-decoration-none">
                    <div class="nav-link  link-body-emphasis">
                        <i class="fa-solid fa-book-open bi pe-none me-2"></i>
                        Матеріали
                    </div>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'admin.conferences' }" class="text-decoration-none">
                    <div class="nav-link  link-body-emphasis">
                        <i class="fa-solid fa-graduation-cap me-2"></i>
                        Конференції
                    </div>
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "NavBar"
}
</script>

<style scoped lang="scss">

.router-link-active{

    .nav-link{
        color: var(--bs-nav-pills-link-active-color) !important;
        background-color: var(--bs-nav-pills-link-active-bg);
    }
}
</style>
