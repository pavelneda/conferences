<template>
    <div v-for="conference in conferences" class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="flex-row d-flex mb-2">
                <div class="flex-row d-flex align-items-baseline me-3">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <h6 class="card-subtitle ms-1">{{ conference.industry }}</h6>
                </div>
                <div class="flex-row d-flex align-items-baseline me-3">
                    <i class="fa-regular fa-calendar-days"></i>
                    <h6 class="card-subtitle ms-1">{{conference.date }}</h6>
                </div>
                <div class="flex-row d-flex align-items-baseline me-3">
                    <i class="fa-solid fa-location-dot"></i>
                    <h6 class="card-subtitle ms-1">{{ conference.place }}</h6>
                </div>
            </div>
            <h4 class="card-title fw-semibold">{{ conference.title }}</h4>
            <span class="card-link text-muted">Дізнатися більше</span>
        </div>
    </div>

</template>

<script>
export default {
    name: "ListComponent",

    props: {
        conferences: Array,
    },

}
</script>

<style scoped>
    i{
        color: #6E41E2;
    }

    .card{
        padding: 0 1rem;
    }
</style>
