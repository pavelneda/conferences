<template>
    <div class="container">
        <h1 class="page-title">Найближчі конференції</h1>
        <div class="form-floating mb-lg-5 shadow-sm">
            <select class="form-select form-select-lg" id="floatingSelectGrid">
                <option selected>Всі галузі</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <label for="floatingSelectGrid">Галузь</label>
        </div>
        <div class="list-component__wrapper">
            <ListComponent></ListComponent>
        </div>
    </div>
</template>

<script>
import ListComponent from "../ListComponent.vue";

export default {
    name: "IndexComponent",
    components: {ListComponent},


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
