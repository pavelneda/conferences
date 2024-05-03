<template>
    <div class="container" v-if="material">
        <h1 class="page-title">{{ material.topic }}</h1>
        <div class="desc-block">
            <p>{{ material.preview_text }}</p>
            <div class="flex-column d-flex mb-2">
                <div class="flex-row d-flex align-items-baseline mb-4">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <h6 class="card-subtitle ms-1">{{ material.industry }}</h6>
                </div>
                <div class="flex-row d-flex align-items-baseline mb-4">
                    <i class="fa-regular fa-calendar-days"></i>
                    <h6 class="card-subtitle ms-2">{{ new Date(material.date).getFullYear() }}</h6>
                </div>
                <div class="flex-row d-flex align-items-baseline mb-3">
                    <i class="fa-solid fa-atom"></i>
                    <h6 class="card-subtitle ms-2">{{ material.university }}</h6>
                </div>
                <p class="fs-6 material__author fw-semibold">{{ material.author }}</p>
            </div>
        </div>
        <div class="fileAndLink">
            <a :href="material.url" class="d-flex align-items-center text-decoration-none fw-semibold">
                <div class="fileAndLink__file rounded-circle me-3">
                    <i class="fa-solid fa-file"></i>
                </div>
                Переглянути матеріал
            </a>
            <a @click.prevent="copyToClipboard" class="d-flex align-items-center text-decoration-none fw-semibold">
                <div class="fileAndLink__link rounded-circle me-3">
                    <i class="fa-regular fa-copy"></i>
                </div>
                Копіювати посилання
            </a>
        </div>
    </div>
</template>


<script>
import ListComponent from "../Materials/ListComponent.vue";

export default {
    name: "ShowComponent",
    components: {ListComponent},
    data() {
        return {
            material: null,
        }
    },

    mounted() {
        this.getMaterial();
    },

    methods: {
        getMaterial() {
            axios.get(`/api/materials/${this.$route.params.id}`)
                .then(res => {
                    this.material = res.data.data;
                })
        },

        copyToClipboard(){
            navigator.clipboard.writeText(this.material.url);
        }

    }


}
</script>


<style scoped lang="scss">
i {
    color: #6E41E2;
    font-size: 16px;
}

h6 {
    font-size: 16px;
}

p {
    font-size: 1rem;
}

.material {
    &__author {
        color: #6E41E2;
    }
}

.fileAndLink {
    a {
        color: #6E41E2 !important;
        font-size: 1rem;
        margin-bottom: 1rem;
        cursor: pointer;
    }

    &__file, &__link {
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
}


</style>
