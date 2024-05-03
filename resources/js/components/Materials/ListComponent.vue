<template>
    <div v-for="material in materials" class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="mb-3 d-grid">
                <div class="flex-row d-flex align-items-center card__author rounded-5">
                    <h6 class="card-subtitle fw-bold">{{ material.author }}</h6>
                </div>
                <div class="flex-row d-flex align-items-baseline card__university">
                    <i class="fa-solid fa-atom"></i>
                    <h6 class="card-subtitle ms-1">{{ material.university }}</h6>
                </div>
            </div>
            <router-link :to="{ name: 'materials.show', params: { id: material.id } }" class="text-decoration-none">
                <h4 class="card-title text-white">{{ material.topic }}</h4>
            </router-link>
            <p class="card__industry mb-2">{{ material.industry }}</p>
            <a :href="material.url" class="d-inline-block">
                <div class="card__file rounded-circle">
                    <i class="fa-solid fa-file"></i>
                </div>
            </a>
            <div class="background-circle rounded-circle"></div>
        </div>
    </div>

</template>

<script>
export default {
    name: "ListComponent",

    props: {
        materials: Array,
    },

}
</script>

<style scoped lang="scss">


.card {
    padding: 0.5rem;
    color: white;
    background-color: #6E41E2;
    overflow: hidden;

    &-body {
        padding-right: 4rem;

        .d-grid {
            grid-template-columns: repeat(2, 1fr);
            justify-items: start;
            align-items: center;
            column-gap: 5rem;
        }
    }

    &__author {
        color: #6E41E2;
        background-color: white;
        padding: 0.4rem 0.5rem;

        .card-subtitle {
            margin-bottom: -0.2rem;
        }
    }

    &__industry {
        font-size: 1rem;
    }

    &__file {
        background-color: #F1F1F1;
        width: 3.5rem;
        height: 3.5rem;

        display: flex;
        align-items: center;
        justify-content: center;

        i {
            color: #6E41E2;
            font-size: 1.4rem;
        }
    }

    .background-circle {
        width: 10rem;
        height: 10rem;
        background-color: #916fe9;

        position: absolute;
        right: 0;
        top: 0;
        transform: translate(50%, -50%);
    }
}
</style>
