<template>
    <div class="footer-wrap">
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <p class="col-md-4 mb-0 text-muted">Copyright, 2024</p>
                <p class="col-md-4 mb-0 text-muted text-end">Developed by Pavlo Nedashkivskiy</p>
            </footer>
        </div>
    </div>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style scoped>
.footer-wrap {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 5rem; /* Footer height */
}
</style>
