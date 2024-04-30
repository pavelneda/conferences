<template>
    <div class="container">
        <div class="application-confirmation text-center shadow rounded p-3">
            <div class="icon rounded-circle">
                <i class="fa-solid fa-check"></i>
            </div>
            <h2 class="fw-semibold">Заявка прийнята</h2>
            <p>Очікуйте на лист організатора з підтвердженням вашої участі у конференції. Обробка може займати до 3х
                робочих днів.</p>
            <router-link :to="{ name: 'main' }" class="text-decoration-none">
                <button class="btn btn-primary py-2" type="submit">На головну</button>
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "ApplicationConfirmationComponent",

}
</script>

<style scoped lang="scss">
.application-confirmation {
    width: 27rem;
    margin: 8rem auto;

    .icon {
        background-color: #dff1e9;
        width: 6rem;
        height: 6rem;
        margin: 1rem auto;
        position: relative;

    }

    .fa-check {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font-size: 3rem;
        color: #27AE60;
    }
}

button {
    background-color: #6E41E2;
    padding: 0.5rem 1rem;
}

</style>
