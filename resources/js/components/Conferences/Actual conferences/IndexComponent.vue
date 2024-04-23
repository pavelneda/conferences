<template>
    <div class="container">
        <h1 class="page-title">Найближчі конференції</h1>
        <div class="form-floating mb-lg-5 shadow-sm">
            <select v-model="filterByIndustry" @click.prevent="chooseFilterConferences" class="form-select form-select-lg" id="floatingSelectGrid">
                <option selected value="all">Всі галузі</option>
                <option v-if="actualIndustries" v-for="industry in actualIndustries" :value="industry">{{
                        industry
                    }}
                </option>
            </select>
            <label for="floatingSelectGrid">Галузь</label>
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
            actualConferences: null,
            actualIndustries: null,

            filterConferences: null,
            filterByIndustry: 'all',
        }
    },

    mounted() {
        this.getConferences();
    },


    methods: {
        getConferences() {
            axios.get('/api/conferences')
                .then(res => {
                    this.actualConferences = res.data.data;
                    this.getActualIndustries();
                    this.chooseFilterConferences();
                })
        },

        getActualIndustries() {
            if (this.actualConferences)
                this.actualIndustries = [...new Set(this.actualConferences.map(conference => conference.industry))];
        },

        chooseFilterConferences() {
            if (this.filterByIndustry === 'all')
                this.filterConferences = this.actualConferences
            else
                this.filterConferences = this.actualConferences.filter(conference => conference.industry === this.filterByIndustry)
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
