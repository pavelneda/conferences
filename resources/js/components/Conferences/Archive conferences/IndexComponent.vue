<template>
    <div class="container">
        <h1 class="page-title">Архів конференцій</h1>
        <div class="d-flex flex-row">
            <div class="form-floating mb-lg-5 me-3 shadow-sm">
                <select v-model="filterByIndustry" @click.prevent="chooseFilterConferences"
                        class="form-select form-select-lg" id="floatingSelectGrid">
                    <option selected value="all">Всі галузі</option>
                    <option v-if="archiveIndustries" v-for="industry in archiveIndustries" :value="industry">{{
                            industry
                        }}
                    </option>
                </select>
                <label for="floatingSelectGrid">Галузь</label>
            </div>
            <div class="form-floating mb-lg-5 shadow-sm">
                <select v-model="filterByYear" @click.prevent="chooseFilterConferences"
                        class="form-select form-select-lg" id="floatingSelectGrid">
                    <option selected value="all">Всі роки</option>
                    <option v-if="archiveYears" v-for="year in archiveYears" :value="year">{{
                            year
                        }}
                    </option>
                </select>
                <label for="floatingSelectGrid">Рік</label>
            </div>
        </div>
        <div class="list-component__wrapper">
            <ListComponent :conferences="filterConferences"></ListComponent>
        </div>
    </div>
</template>

<script>
import ListComponent from "../ListComponent.vue";

export default {
    name: "IndexComponent",
    components: {ListComponent},

    data() {
        return {
            archiveConferences: null,
            archiveIndustries: null,
            archiveYears: null,

            filterConferences: null,
            filterByIndustry: 'all',
            filterByYear: 'all',
        }
    },

    mounted() {
        this.getConferences();

        if (this.$route.query.industry) this.filterByIndustry = this.$route.query.industry;
        if (this.$route.query.year) this.filterByYear = this.$route.query.year;

    },

    methods: {
        getConferences() {
            axios.get('/api/conferences/archive')
                .then(res => {
                    this.archiveConferences = res.data.data;
                    this.getActualIndustriesAndYears();
                    this.chooseFilterConferences();
                })
        },

        getActualIndustriesAndYears() {
            if (this.archiveConferences) {
                this.archiveIndustries = [...new Set(this.archiveConferences.map(conference => conference.industry))];
                this.archiveYears = [...new Set(this.archiveConferences.map(conference => conference.date.slice(-4)))];
            }
        },

        chooseFilterConferences() {
            this.editQuery();

            if (this.filterByIndustry === 'all' && this.filterByYear === 'all')
                this.filterConferences = this.archiveConferences
            else {
                this.filterConferences = this.archiveConferences
                    .filter(({
                                 date,
                                 industry
                             }) => ['all', industry].includes(this.filterByIndustry) && ['all', date.slice(-4)].includes(this.filterByYear))
            }
        },

        editQuery(){
            const query = Object.assign({}, this.$route.query);

            if (this.filterByIndustry === 'all') delete query.industry;
            else query.industry = this.filterByIndustry;

            if (this.filterByYear === 'all') delete query.year;
            else query.year = this.filterByYear;

            this.$router.replace({query})
        }
    }
}

</script>

<style scoped>


.form-floating {
    width: 30%;
}

.list-component__wrapper {
    width: 80%;
}
</style>
