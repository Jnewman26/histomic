<template>
    <Navbar />

    <div class="container-fluid">
        <div class="col-12 my-5">
            <div class="row">
                <div class="col-sm-12 col-lg-6 d-none d-lg-block text-center"><img src="@/Assets/Images/hulk.jpg"
                        alt="registerImg" class="img-fluid w-75 rounded-5 mx-auto"></div>
                <div class="col-sm-12 col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="w-75">
                        <h1 class="bangers">Register</h1><br>
                        <form @submit.prevent="register">

                            <div class="col-12">
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input class="form-control w-100 p-3" placeholder="Full Name"
                                            v-model="user.USER_NAME">
                                        <p class="text-danger mt-1 mb-0" v-if="errors.USER_NAME">{{ errors.USER_NAME }}</p>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label class="form-label">Email</label>
                                        <input class="form-control w-100 p-3" placeholder="Email" v-model="user.USER_EMAIL">
                                        <p class="text-danger mt-1 mb-0" v-if="errors.USER_EMAIL">{{ errors.USER_EMAIL }}</p>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label class="form-label">Phone</label>
                                        <input class="form-control w-100 p-3" type="number" placeholder="Phone" v-model="user.USER_PHONE">
                                        <p class="text-danger mt-1 mb-0" v-if="errors.USER_PHONE">{{ errors.USER_PHONE }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control w-100 p-3" type="password" placeholder="Password"
                                            v-model="user.USER_PASSWORD">
                                        <p class="text-danger mt-1 mb-0" v-if="errors.USER_PASSWORD">{{ errors.USER_PASSWORD }}
                                        </p>
                                    </div>

                                    <label class="form-label">Gender</label>
                                    <div class="mb-3 col-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1" value="male" v-model="user.USER_GENDER">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault2" value="female" v-model="user.USER_GENDER">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark text-white w-100 my-4 p-3">Register</button>
                        </form>
                        <Link href="/login" class="text-muted">Kembali ke login</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <Footer />
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Navbar from './Component/Navbar.vue';
import Footer from './Component/Footer.vue';
</script>

<script>
export default {
    data() {
        return {
            user: {
                USER_NAME: '',
                USER_EMAIL: '',
                USER_PHONE: '',
                USER_GENDER: '',
                USER_PASSWORD: ''
            }
        }
    },
    props: {
        errors: Object
    },
    methods: {
        register() {
            this.$inertia.post('/signup', this.user)
        }
    }
}
</script>