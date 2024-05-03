<template>
    <template v-if="!confirmed">
        <div class="container" v-if="conference">
            <h1 class="page-title">{{ conference.title }}</h1>
            <div class="playerAndDesc d-flex flex-row mb-4">
                <div class="player">
                    <img src="/storage/images/player.png" alt="player">
                    <p v-if="isVisibleFromDate(conference.date)" class="mt-2">*трансляція відбудеться згодом</p>
                </div>
                <div class="desc-block p-4">
                    <p>{{ conference.preview_text }}</p>
                    <div class="flex-column d-flex mb-2">
                        <div class="flex-row d-flex align-items-baseline mb-3">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <h6 class="card-subtitle ms-1">{{ conference.industry }}</h6>
                        </div>
                        <div class="flex-row d-flex align-items-baseline mb-3">
                            <i class="fa-regular fa-calendar-days"></i>
                            <h6 class="card-subtitle ms-2">{{ conference.date }}</h6>
                        </div>
                        <div class="flex-row d-flex align-items-baseline mb-3">
                            <i class="fa-solid fa-location-dot"></i>
                            <h6 class="card-subtitle ms-2">{{ conference.place }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="application-form mb-5" v-if="isVisibleFromDate(conference.application_deadline)">
                <h3 class="fw-semibold">
                    Заявка на участь
                </h3>
                <p>Вартість участі - {{ conference.price }} грн. Дедлайн подачі заявок - {{
                        conference.application_deadline
                    }}</p>
                <div class="application-form__wrapper">
                    <p class="text-danger fw-bold" v-if="!token">Щоб подати заяву на участь ви маєте залогінитись</p>
                    <form v-if="token">
                        <div class="row mb-4">
                            <div class="form-floating col ">
                                <input required v-model="author" type="text" class="form-control shadow-sm " id="name">
                                <label for="floatingInput">Ваше ФІО</label>
                            </div>
                            <div class="form-floating col">
                                <input required v-model="topic" type="text" class="form-control shadow-sm " id="name">
                                <label for="floatingInput">Тема</label>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="form-floating col">
                                <input required v-model="phone" type="tel" class="form-control shadow-sm " id="name">
                                <label for="floatingInput">Ваш телефон</label>
                            </div>
                            <div class="form-floating col">
                                <input required v-model="email" type="email" class="form-control shadow-sm " id="name">
                                <label for="floatingInput">Ваш Email</label>
                            </div>
                        </div>
                        <div class="row mb-4 ">
                            <div class="form-floating col">
                                <select v-model="industry"
                                        class="form-select form-select-lg shadow-sm " id="floatingSelectGrid">
                                    <option v-if="industries" v-for="industry in industries"
                                            :value="industry">{{
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
                                        перетягніть в це поле</label>

                                    <p v-if="material" class="file-form__filename">
                                        Ім'я файлу: {{ material.name }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <p class="text-danger">{{ error }}</p>

                        <button @click.prevent="store" class="btn btn-primary py-2" type="submit">Надіслати на оплатити
                        </button>
                    </form>
                </div>
            </div>
            <div class="materials mb-5" v-if="!isVisibleFromDate(conference.application_deadline)">
                <h3 class="fw-semibold mb-3">
                    Матеріали
                </h3>
                <div class="list-component__wrapper">
                    <list-component :materials="materials" v-if="materials"></list-component>
                </div>
            </div>
            <p class="mb-3">
                {{ conference.description }}
            </p>
        </div>
    </template>
    <template v-if="confirmed">
        <application-confirmation-component></application-confirmation-component>
    </template>
</template>


<script>
import ApplicationConfirmationComponent from "./ApplicationConfirmationComponent.vue";
import ListComponent from "../Materials/ListComponent.vue";

export default {
    name: "ShowComponent",
    components: {ApplicationConfirmationComponent, ListComponent},
    data() {
        return {
            conference: null,
            industries: null,
            material: null,
            author: null,
            topic: null,
            phone: null,
            email: null,
            industry: null,
            university: null,

            materials: null,

            error: null,
            confirmed: null,
            token: null,
        }
    },

    mounted() {
        this.getToken();
        this.getConference();
        this.getIndustries();
    },

    methods: {
        getConference() {
            axios.get(`/api/conferences/${this.$route.params.id}`)
                .then(res => {
                    this.conference = res.data.data;
                    if (!this.isVisibleFromDate(this.conference.application_deadline))
                        this.getMaterials();
                })
        },

        getIndustries() {
            axios.get(`/api/industries`)
                .then(res => {
                    this.industries = res.data.data
                })
        },

        getMaterials() {
            axios.get(`/api/conferences/${this.conference.id}/materials`)
                .then(res => {
                    this.materials = res.data.data;
                })
        },

        handleFileUpload() {
            this.material = this.$refs.material.files[0]
        },

        store() {
            const formData = new FormData()
            formData.append('file', this.material)
            formData.append('author', this.author)
            formData.append('topic', this.topic)
            formData.append('phone', this.phone)
            formData.append('email', this.email)
            formData.append('industry_id', this.industry.id)
            formData.append('conference_id', this.conference.id)
            formData.append('university', this.university)

            axios.post('/api/materials', formData)
                .then(res => {
                    if (res.data.message === 'ok') this.confirmed = true;
                })
                .catch(err => {
                    this.error = err.response.data.message
                })

        },


        isVisibleFromDate(deadline_date) {
            const now = new Date()
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate())
            const date = deadline_date.split('.');

            return new Date(date[2], date[1] - 1, date[0]) >= today;
        },

        getToken() {
            this.token = localStorage.getItem('x_xsrf_token')
        }

    }


}
</script>


<style scoped lang="scss">
i {
    color: #6E41E2;
    font-size: 16px;
}

h6 {
    font-size: 16px;
}

p {
    font-size: 1rem;
}

.playerAndDesc {
    gap: 1rem;
}

.application-form {
    button {
        background-color: #6E41E2;
        padding: 0.5rem 1rem;
    }

    label {
        left: auto;
    }

    &__wrapper {
        width: 65%;
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

.list-component__wrapper {
    width: 65%;
}


</style>
