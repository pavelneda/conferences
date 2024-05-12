<template>
    <div class="application-form mb-5">
        <div class="application-form__wrapper">
            <form>
                <div class="row mb-4">
                    <div class="form-floating col ">
                        <input required v-model="title" type="text" class="form-control shadow-sm " id="name">
                        <label for="floatingInput">Назва</label>
                    </div>
                    <div class="form-floating col">
                        <input required v-model="date" type="text" class="form-control shadow-sm " id="name">
                        <label for="floatingInput">Дата проведення</label>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="form-floating col ">
                        <input required v-model="price" type="text" class="form-control shadow-sm " id="name">
                        <label for="floatingInput">Ціна</label>
                    </div>
                    <div class="form-floating col">
                        <input required v-model="application_deadline" type="text" class="form-control shadow-sm " id="name">
                        <label for="floatingInput">Дедлайн прийому заявок</label>
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
                        <input required v-model="place" type="text" class="form-control shadow-sm "
                               id="name">
                        <label for="floatingInput">Місце проведення</label>
                    </div>
                </div>


                <p class="text-danger">{{ error }}</p>

                <button @click.prevent="updateConference" class="btn btn-primary py-2 me-3" type="submit">Оновити</button>
                <button @click.prevent="deleteConference" class="btn btn-danger py-2" type="submit">Видалити</button>
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


            title: null,
            date: null,
            industry_id: null,
            place: null,
            price: null,
            application_deadline: null,


            error: null,

        }
    },

    mounted() {
        this.getConference();
        this.getIndustries();
    },

    methods: {

        getIndustries() {
            axios.get(`/api/industries`)
                .then(res => {
                    this.industries = res.data.data
                })
        },

        getConference() {
            axios.get(`/api/conferences/${this.$route.params.id}`)
                .then(res => {
                    this.title = res.data.data.title;
                    this.date = res.data.data.date;
                    this.industry_id = res.data.data.industry_id;
                    this.place = res.data.data.place;
                    this.price = res.data.data.price;
                    this.application_deadline = res.data.data.application_deadline;
                })
        },

        deleteConference() {
            axios.delete(`/api/admin/conferences/${this.$route.params.id}`)
                .then(res => {
                })
                .finally(() => {
                    router.push({name: 'admin.conferences'})
                })
        },


        updateConference() {
            const formData = new FormData()
            formData.append('title', this.title)
            formData.append('date', this.date)
            formData.append('industry_id', this.industry_id)
            formData.append('place', this.place)
            formData.append('price', this.price)
            formData.append('application_deadline', this.application_deadline)
            formData.append('_method', 'PATCH')

            axios.post(`/api/admin/conferences/${this.$route.params.id}`, formData)
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
