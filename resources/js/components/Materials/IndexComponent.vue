<template>
    <div class="container">
        <h1 class="page-title">Матеріали</h1>
        <div class="d-flex flex-row justify-content-between">
            <div class="filters">
                <div class="form-floating mb-4 shadow-sm">
                    <select v-model="filterByIndustry" @click.prevent="chooseFilter"
                            class="form-select form-select-lg" id="floatingSelectGrid">
                        <option selected value="all">Всі галузі</option>
                        <option v-if="materialsIndustries" v-for="industry in materialsIndustries" :value="industry">{{
                                industry
                            }}
                        </option>
                    </select>
                    <label for="floatingSelectGrid">Галузь</label>
                </div>
                <div class="form-floating mb-4 shadow-sm">
                    <select v-model="filterByYear" @click.prevent="chooseFilter"
                            class="form-select form-select-lg" id="floatingSelectGrid">
                        <option selected value="all">Всі роки</option>
                        <option v-if="materialsYears" v-for="year in materialsYears" :value="year">{{
                                year
                            }}
                        </option>
                    </select>
                    <label for="floatingSelectGrid">Рік</label>
                </div>
                <div class="form-floating mb-4 shadow-sm">
                    <select v-model="filterByUniversity" @click.prevent="chooseFilter"
                            class="form-select form-select-lg" id="floatingSelectGrid">
                        <option selected value="all">Всі університети</option>
                        <option v-if="materialsUniversities" v-for="university in materialsUniversities"
                                :value="university">{{
                                university
                            }}
                        </option>
                    </select>
                    <label for="floatingSelectGrid">Університет</label>
                </div>
            </div>


            <div class="list-component__wrapper">
                <ListComponent :materials="filterMaterials"></ListComponent>
            </div>

        </div>
    </div>
</template>

<script>
import ListComponent from "./ListComponent.vue";

export default {
    name: "IndexComponent",
    components: {ListComponent},

    data() {
        return {
            materials: null,

            materialsIndustries: null,
            materialsYears: null,
            materialsUniversities: null,

            filterMaterials: null,
            filterByIndustry: 'all',
            filterByYear: 'all',
            filterByUniversity: 'all',
        }
    },

    mounted() {
        this.getMaterials();

        if (this.$attrs.query.year) this.filterByYear = parseInt(this.$attrs.query.year);
        if (this.$attrs.query.industry) this.filterByIndustry = this.$attrs.query.industry;
        if (this.$attrs.query.university) this.filterByUniversity = this.$attrs.query.university;

    },


    methods: {
        getMaterials() {
            axios.get('/api/materials')
                .then(res => {
                    this.materials = res.data.data;
                    this.getDataForFilters();
                    this.chooseFilter();
                })
        },

        getDataForFilters() {
            if (this.materials) {
                this.materialsIndustries = [...new Set(this.materials.map(material => material.industry))];
                this.materialsYears = [...new Set(this.materials.map(material => new Date(material.date).getFullYear()))];
                this.materialsUniversities = [...new Set(this.materials.map(material => material.university))];
            }
        },

        chooseFilter() {
            this.editQuery();

            if (this.filterByIndustry === 'all' && this.filterByYear === 'all' && this.filterByUniversity === 'all')
                this.filterMaterials = this.materials;
            else {
                this.filterMaterials = this.materials
                    .filter(({
                                 date,
                                 industry,
                                 university
                             }) => ['all', industry].includes(this.filterByIndustry)
                        && ['all', new Date(date).getFullYear()].includes(this.filterByYear)
                        && ['all', university].includes(this.filterByUniversity));
            }
        },

        editQuery(){
            const query = Object.assign({}, this.$route.query);

            if (this.filterByYear === 'all') delete query.year;
            else query.year = this.filterByYear;

            if (this.filterByIndustry === 'all') delete query.industry;
            else query.industry = this.filterByIndustry;

            if (this.filterByUniversity === 'all') delete query.university;
            else query.university = this.filterByUniversity;

            this.$router.replace({query})
        }

    }
}

</script>

<style scoped>

.list-component__wrapper {
    width: 60%;
}

.filters {
    width: 35%;
}
</style>
