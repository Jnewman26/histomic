<template>
    <Navbar />
    <div class="container-fluid my-5">

        <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible fade show" role="alert"
            id="success-alert" style="z-index: 999;">
            <i class="fa-duotone fa-circle-check"></i> {{ $page.props.flash.message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="d-flex justify-content-center">
            <div v-if="form.errors.USER_EMAIL" v-text="form.errors.USER_EMAIL"
                class="alert alert-danger alert-dismissible fade show w-25 position-absolute mt-4" role="alert">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-lg-6 d-flex align-items-center justify-content-center">
                <div class="w-75">
                    <h1 class="bangers">Login</h1><br>
                    <form @submit.prevent="submit">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input v-model="form.USER_EMAIL" class="form-control w-100 p-3" placeholder="Email"
                                name="USER_EMAIL" id="email" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input v-model="form.USER_PASSWORD" class="form-control w-100 p-3" placeholder="Password"
                                name="USER_PASSWORD" id="password" />
                            <div v-if="form.errors.USER_PASSWORD" v-text="form.errors.USER_PASSWORD"
                                class="text-danger text-xs mt-1"></div>
                            <div class="form-check my-3">
                                <input v-model="form.remember" class="form-check-input" type="checkbox" id="remember"
                                    name="remember" value="1">
                                <label for="remember">Remember Me</label>
                            </div>

                        </div>
                        <button @click.prevent="submit" type="submit" class="btn btn-dark w-100 mb-4 p-3">Login</button>
                    </form>
                    <!-- <button class="btn btn-outline-dark w-100 mb-4 p-3">
                        <img src="@/Assets/Images/google.webp" alt="" class="img-fluid" style="width: 20px;">  
                        &nbsp;Login with Google
                    </button> -->
                    <Link href="/signup" class="text-muted">Belum punya akun? Silahkan daftar</Link>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 d-none d-lg-block text-center">
                <img src="@/Assets/Images/blackpanther.jpg" alt="loginImg" class="img-fluid w-75 rounded-5 mx-auto">
            </div>
        </div>
    </div>

    <Footer />
</template>

<script setup>
import { onMounted, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import Navbar from './Component/Navbar.vue';
import Footer from './Component/Footer.vue';

let form = useForm({
    USER_EMAIL: '',
    USER_PASSWORD: '',
    remember: false,
});

let submit = async () => {
    if (form.remember) {
        localStorage.setItem('USER_EMAIL', form.USER_EMAIL);
        localStorage.setItem('USER_PASSWORD', form.USER_PASSWORD);
    } else {
        localStorage.removeItem('USER_EMAIL');
        localStorage.removeItem('USER_PASSWORD');
    }

    await form.post('/login', {
        remember: form.remember,
    });
};

onMounted(() => {
    if (localStorage.getItem('USER_EMAIL') && localStorage.getItem('USER_PASSWORD')) {
        form.USER_EMAIL = localStorage.getItem('USER_EMAIL');
        form.USER_PASSWORD = localStorage.getItem('USER_PASSWORD');
        form.remember = true;
    }
});

watch(() => form.remember, (newValue) => {
    if (!newValue) {
        localStorage.removeItem('USER_EMAIL');
        localStorage.removeItem('USER_PASSWORD');
    }
});
</script>

