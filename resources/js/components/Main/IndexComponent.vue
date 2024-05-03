<template>
    <div class="container">
        <div class="conferences mb-5">
            <h1 class="page-title">Конференції</h1>
            <div class="d-flex">
                <div class="shadow p-4 rounded flex-item">
                    <h3 class="fw-bold mb-4">Найближчі</h3>
                    <ListConferencesComponent :conferences="actualConferences"></ListConferencesComponent>
                    <div class="d-table m-auto">
                        <router-link :to="{ name: 'conferences' }" class="text-decoration-none">
                            <div class="btn btn-outline-primary">Більше конференцій</div>
                        </router-link>
                    </div>
                </div>
                <div class="shadow p-4 rounded flex-item">
                    <h3 class="fw-bold mb-4">Архівні</h3>
                    <ListConferencesComponent :conferences="archiveConferences"></ListConferencesComponent>
                    <div class="d-table m-auto">
                        <router-link :to="{ name: 'archive-conferences' }" class="text-decoration-none">
                            <div class="btn btn-outline-primary">До архіву</div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="materials">
            <h1 class="page-title">Матеріали</h1>
            <div class="d-grid materials__filter mb-5">
                <div class="materials__filter--inner">
                    <h3 class="fw-bold mb-3">Галузь</h3>
                    <ul class="nav flex-column" v-if="industries">
                        <li class="nav-item mb-2" v-for="industry in industries">
                            <router-link :to="{ name: 'materials', query: { industry: industry } }" class="text-muted text-decoration-none">
                                {{ industry }}
                            </router-link>
                        </li>
                    </ul>
                </div>
                <div class="materials__filter--inner">
                    <h3 class="fw-bold mb-3">Університет</h3>
                    <ul class="nav flex-column" v-if="universities">
                        <li class="nav-item mb-2" v-for="university in universities">
                            <router-link :to="{ name: 'materials', query: { university: university } }" class="text-muted text-decoration-none">
                                {{ university }}
                            </router-link>
                        </li>
                    </ul>
                </div>
                <div class="materials__filter--inner">
                    <h3 class="fw-bold mb-3">За роком</h3>
                    <ul class="nav flex-column" v-if="years">
                        <li class="nav-item mb-2" v-for="year in years">
                            <router-link :to="{ name: 'materials', query: { year: year }}" class="text-muted text-decoration-none">
                                {{ year }}
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="materials__list">
                <h3 class="fw-bold mb-3">Найновіші матеріали</h3>
                <div class="materials__list--inner">
                    <ListMaterialsComponent :materials="materials" v-if="materials"></ListMaterialsComponent>
                </div>
                <router-link :to="{ name: 'materials' }" class="text-decoration-none">
                    <div class="btn btn-outline-primary">Всі матеріали</div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>


import ListConferencesComponent from "../Conferences/ListComponent.vue";
import ListMaterialsComponent from "../Materials/ListComponent.vue";

export default {
    name: "IndexComponent",
    components: {ListConferencesComponent, ListMaterialsComponent},

    data() {
        return {
            actualConferences: null,
            archiveConferences: null,

            materials: null,
            industries: null,
            universities: null,
            years: null,
        }
    },

    mounted() {
        this.getConferences();
        this.getMaterials();
    },

    methods: {
        getConferences() {
            axios.get('/api/conferences', {params: {count: 4}})
                .then(res => {
                    this.actualConferences = res.data.data;
                })

            axios.get('/api/conferences/archive', {params: {count: 4}})
                .then(res => {
                    this.archiveConferences = res.data.data;
                })
        },

        getMaterials() {
            axios.get('/api/materials', {params: {count: 4}})
                .then(res => {
                    this.materials = res.data.data;
                    this.getDataForNav();
                })
        },

        getDataForNav() {
            if (this.materials) {
                this.industries = [...new Set(this.materials.map(material => material.industry))];
                this.universities = [...new Set(this.materials.map(material => material.university))];
                this.years = [...new Set(this.materials.map(material => new Date(material.date).getFullYear()))];
            }
        },
    }

}
</script>

<style scoped lang="scss">
.d-flex {
    gap: 2rem;
    align-items: flex-start;
}

.flex-item {
    flex: 1 1 0;
}

.materials {
    &__filter {
        grid-template-columns: repeat(2, 1fr) 2fr;
        justify-items: start;
        column-gap: 5rem;

        .nav {
            font-size: 1.1rem;
        }
    }

    &__list--inner{
        width: 65%;
    }

}
</style>
