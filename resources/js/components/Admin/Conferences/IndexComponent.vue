<template>
    <table class="table table-striped mt-2">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Назва</th>
            <th scope="col">Дата</th>
        </tr>
        </thead>
        <tbody v-if="conferences">
        <tr v-for="conference in conferences">
            <th scope="row">{{ conference.id }}</th>
            <td><span class="textWithDots">{{ conference.title }}</span></td>
            <td>{{ conference.date }}</td>
            <td>
                <router-link :to="{ name: 'conferences.show', params: { id: conference.id } }"
                             class="text-decoration-none">
                    <div class="btn btn-primary me-3">Переглянути</div>
                </router-link>
                <router-link :to="{ name: 'admin.conferences.edit', params: { id: conference.id } }" class="text-decoration-none">
                    <div class="btn btn-outline-primary">Редагувати</div>
                </router-link>
            </td>
        </tr>

        </tbody>
    </table>
</template>

<script>
export default {
    name: "IndexComponent",

    data() {
        return {
            conferences: null,
        }
    },

    mounted() {
        this.getConferences();
    },

    methods: {
        getConferences() {
            axios.get('/api/admin/conferences')
                .then(res => {
                    this.conferences = res.data.data;
                })
        },
    }
}
</script>

<style scoped>

.textWithDots {
    display: block;
    width: 350px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
</style>
