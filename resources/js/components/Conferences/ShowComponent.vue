<template>
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
            <p>Вартість участі - {{ conference.price }} грн. Дедлайн подачі заявок - {{ conference.application_deadline }}</p>
            <div class="application-form__wrapper">
                <form>
                    <div class="row mb-4">
                        <div class="form-floating col ">
                            <input v-model="name" type="text" class="form-control shadow-sm " id="name">
                            <label for="floatingInput">Ваше ФІО</label>
                        </div>
                        <div class="form-floating col">
                            <input v-model="topic" type="text" class="form-control shadow-sm " id="name">
                            <label for="floatingInput">Тема</label>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="form-floating col">
                            <input v-model="phone" type="tel" class="form-control shadow-sm " id="name">
                            <label for="floatingInput">Ваш телефон</label>
                        </div>
                        <div class="form-floating col">
                            <input v-model="email" type="email" class="form-control shadow-sm " id="name">
                            <label for="floatingInput">Ваш Email</label>
                        </div>
                    </div>
                    <div class="row mb-4 ">
                        <div class="form-floating col">
                            <select v-model="industry"
                                    class="form-select form-select-lg shadow-sm " id="floatingSelectGrid">
                                <option v-if="industries" v-for="industry in industries"
                                        :value="industry">{{
                                        industry
                                    }}
                                </option>
                            </select>
                            <label for="floatingSelectGrid">Галузь</label>
                        </div>
                        <div class="form-floating col">
                            <input v-model="university" type="text" class="form-control shadow-sm " id="name">
                            <label for="floatingInput">Університет</label>
                        </div>
                    </div>
                    <div class="row mb-4">
                        !!!!!!!!!!!!!
                    </div>

                    <p class="text-danger">{{ error }}</p>

                    <button @click.prevent="register" class="btn btn-primary py-2" type="submit">Надіслати на оплатити
                    </button>
                </form>
            </div>
        </div>
        <p class="mb-3">
            {{conference.description}}
        </p>
    </div>
</template>



<script>
export default {
    name: "ShowComponent",

    data() {
        return {
            conference: null,
            industries: null,
        }
    },

    mounted() {
        this.getConference();
        this.getIndustries();
    },

    methods: {
        getConference() {
            axios.get(`/api/conferences/${this.$route.params.id}`)
                .then(res => {
                    this.conference = res.data.data;
                })
        },

        getIndustries() {
            axios.get(`/api/industries`)
                .then(res => {
                    this.industries = [...new Set(res.data.data.map(industry => industry.title))]
                })
        },

        isVisibleFromDate(deadline_date) {
            const now = new Date()
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate())
            const date = deadline_date.split('.');
            const isVisible = new Date(date[2], date[1]-1 , date[0]) >= today;

            return isVisible;
        },

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


</style>
