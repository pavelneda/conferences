<template>
    <div class="application-form mb-5">
        <div class="application-form__wrapper">
            <form>
                <div class="row mb-4">
                    <div class="form-floating col ">
                        <input required v-model="author" type="text" class="form-control shadow-sm " id="name">
                        <label for="floatingInput">ФІО</label>
                    </div>
                    <div class="form-floating col">
                        <input required v-model="topic" type="text" class="form-control shadow-sm " id="name">
                        <label for="floatingInput">Тема</label>
                    </div>
                </div>
                <div class="row mb-4 ">
                    <div class="form-floating col">
                        <select v-model="industry_id"
                                class="form-select form-select-lg shadow-sm " id="floatingSelectGrid">
                            <option v-if="industries" v-for="industry in industries"
                                    :value="industry.id">{{
                                    industry.title
                                }}
                            </option>
                        </select>
                        <label for="floatingSelectGrid">Галузь</label>
                    </div>
                    <div class="form-floating col">
                        <input required v-model="university" type="text" class="form-control shadow-sm "
                               id="name">
                        <label for="floatingInput">Університет</label>
                    </div>
                </div>
                <div class="row mb-4 ">
                    <div class="col">
                        <div class="p-0 file-form form-floating form-control">
                            <input required type="file" ref="material" v-on:change="handleFileUpload()"
                                   class="form-control shadow-sm hidden"/>
                            <label v-if="!material" for="floatingInput">Розмір файлу має бути до 10МБ</label>
                            <label v-if="!material" class="file-form__title">Оберіть файл з вашою темою або
                                перетягніть в це поле, щоб замінити актуальний файл</label>

                            <p v-if="material" class="file-form__filename">
                                Ім'я файлу: {{ material.name }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 fileAndLink">
                    <a :href="url" class="d-flex align-items-center text-decoration-none fw-semibold">
                        <div class="fileAndLink__file rounded-circle me-3">
                            <i class="fa-solid fa-file"></i>
                        </div>
                        Переглянути матеріал
                    </a>
                </div>

                <p class="text-danger">{{ error }}</p>

                <button @click.prevent="updateMaterial" class="btn btn-primary py-2 me-3" type="submit">Оновити</button>
                <button @click.prevent="deleteMaterial" class="btn btn-danger py-2" type="submit">Видалити</button>
            </form>
        </div>
    </div>
</template>

<script>
import router from "../../../router.js";

export default {
    name: "EditComponent",

    data() {
        return {
            industries: null,


            material: null,
            author: null,
            topic: null,
            industry_id: null,
            university: null,
            confirmed: null,
            url: null,
            path: null,


            error: null,

        }
    },

    mounted() {
        this.getMaterial();
        this.getIndustries();
    },

    methods: {

        getIndustries() {
            axios.get(`/api/industries`)
                .then(res => {
                    this.industries = res.data.data
                })
        },

        getMaterial() {
            axios.get(`/api/materials/${this.$route.params.id}`)
                .then(res => {
                    this.author = res.data.data.author;
                    this.confirmed = res.data.data.confirmed;
                    this.industry_id = res.data.data.industry_id;
                    this.topic = res.data.data.topic;
                    this.university = res.data.data.university;
                    this.url = res.data.data.url;
                })
        },

        deleteMaterial() {
            axios.delete(`/api/admin/materials/${this.$route.params.id}`)
                .then(res => {
                })
                .finally(() => {
                    router.push({name: 'admin.materials'})
                })
        },

        handleFileUpload() {
            this.material = this.$refs.material.files[0]
        },

        updateMaterial() {
            const formData = new FormData()
            if (this.material) formData.append('file', this.material)
            formData.append('author', this.author)
            formData.append('topic', this.topic)
            formData.append('industry_id', this.industry_id)
            formData.append('university', this.university)
            formData.append('path', this.path)
            formData.append('_method', 'PATCH')

            axios.post(`/api/admin/materials/${this.$route.params.id}`, formData)
                .then(res => {
                })
                .catch(err => {
                    this.error = err.response.data.message
                })

        },

    }
}
</script>

<style scoped lang="scss">
.application-form {
    width: 100%;

    label {
        left: auto;
    }


    input {
        font-size: 1.125rem;
    }

}

.file-form {
    input {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
        opacity: 0;
        position: relative;
        z-index: 100;
    }

    label {
        top: 50%;
    }

    &__title {
        top: 20% !important;
        font-size: 1.2rem;
        color: #6E41E2 !important;
    }


    &__filename {
        position: absolute;
        top: 40%;
        left: 2%;
    }


}

.fileAndLink {
    a {
        color: #6E41E2 !important;
        font-size: 1rem;
        margin-bottom: 1rem;
        cursor: pointer;
    }

    &__file, &__link {
        background-color: #F1F1F1;
        width: 3.5rem;
        height: 3.5rem;

        display: flex;
        align-items: center;
        justify-content: center;

        i {
            color: #6E41E2;
            font-size: 1.4rem;
        }
    }
}
</style>
