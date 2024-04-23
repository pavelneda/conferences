<template>
    <div class="container">
        <h1 class="page-title">Конференції</h1>
        <div class="d-flex">
            <div class="shadow p-4 rounded flex-item">
                <h3 class="fw-bold mb-4">Найближчі</h3>
                <ListComponent :conferences="actualConferences"></ListComponent>
                <div class="btn btn-outline-primary d-table m-auto">Більше конференцій</div>
            </div>
            <div class="shadow p-4 rounded flex-item">
                <h3 class="fw-bold mb-4">Архівні</h3>
                <ListComponent :conferences="archiveConferences"></ListComponent>
                <div class="btn btn-outline-primary d-table m-auto">До архіву</div>

            </div>
        </div>

    </div>
</template>

<script>


import ListComponent from "../Conferences/ListComponent.vue";

export default {
    name: "IndexComponent",
    components: {ListComponent},

    data() {
        return {
            actualConferences: null,
            archiveConferences: null,
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
                })

            axios.get('/api/conferences/archive')
                .then(res => {
                    this.archiveConferences = res.data.data;
                })
        },
    }

}
</script>

<style scoped>
.d-flex {
    gap: 2rem;
    align-items: flex-start;
}

.flex-item{
    flex: 1 1 0px;
}
</style>
