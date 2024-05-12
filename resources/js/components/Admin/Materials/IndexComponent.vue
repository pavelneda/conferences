<template>
    <table class="table table-striped mt-2">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Тема</th>
            <th scope="col">Автор</th>
            <th scope="col">Прийнято</th>
        </tr>
        </thead>
        <tbody v-if="materials">
        <tr v-for="material in materials">
            <th scope="row">{{ material.id }}</th>
            <td><span class="textWithDots">{{ material.topic }}</span></td>
            <td>{{ material.author }}</td>
            <td>{{ material.confirmed ? 'Так' : 'Ні' }}</td>
            <td>
                <router-link :to="{ name: 'materials.show', params: { id: material.id } }"
                             class="text-decoration-none">
                    <div class="btn btn-primary me-3">Переглянути</div>
                </router-link>
                <router-link :to="{ name: 'admin.materials.edit', params: { id: material.id } }" class="text-decoration-none">
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
            materials: null,
        }
    },

    mounted() {
        this.getMaterials();
    },

    methods: {
        getMaterials() {
            axios.get('/api/admin/materials')
                .then(res => {
                    this.materials = res.data.data;
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
