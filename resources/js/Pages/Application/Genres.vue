<template>
    <Navbar v-if="!auth" />
    <NavbarLogin v-if="auth" />
    <MainLayout>
        <template v-slot:main>
            <div class="col-12" style="margin-top: 100px;">
                <div class="row">

                    <div class="col-md-4 col-sm-6 popup genre">
                        <Link href="/genreaction" class="position-relative text-decoration-none">
                        <img src="@/Assets/Images/genre/bg-civil.webp" alt=""
                            class="img-fluid w-100 position-absolute rounded-3" style="height: 150px;">
                        <div class="card card-body border-0 rounded-3"
                            style="height: 150px; background-color: rgba(53, 53, 53, 0.425)">
                            <h1 class="text-light my-auto" style="z-index: 2;">Action</h1>
                            <img src="@/Assets/Images/genre/captain-maerica.webp" alt=""
                                class="hero-genre img-fluid position-absolute">
                        </div>
                        </Link>
                    </div>

                    <div class="col-md-4 col-sm-6 popup genre">
                        <Link href="/genrefantasy" class="position-relative text-decoration-none">
                        <img src="@/Assets/Images/genre/bg-guardian.webp" alt=""
                            class="img-fluid w-100 position-absolute rounded-3" style="height: 150px;">
                        <div class="card card-body border-0 rounded-3"
                            style="height: 150px; background-color: rgba(53, 53, 53, 0.425)">
                            <h1 class="text-light my-auto" style="z-index: 2;">Fantasy</h1>
                            <img src="@/Assets/Images/genre/rocket.webp" alt=""
                                class="hero-genre img-fluid position-absolute">
                        </div>
                        </Link>
                    </div>

                    <div class="col-md-4 col-sm-6 popup genre">
                        <Link href="/genreadventure" class="position-relative text-decoration-none">
                        <img src="@/Assets/Images/genre/bg-marvel.webp" alt=""
                            class="img-fluid w-100 position-absolute rounded-3" style="height: 150px;">
                        <div class="card card-body border-0 rounded-3"
                            style="height: 150px; background-color: rgba(53, 53, 53, 0.425)">
                            <h1 class="text-light my-auto" style="z-index: 2;">Adventure</h1>
                            <img src="@/Assets/Images/genre/hulk.webp" alt=""
                                class="hero-genre img-fluid position-absolute">
                        </div>
                        </Link>
                    </div>

                    <div class="col-md-4 col-sm-6 popup genre">
                        <Link href="/genremystery" class="position-relative text-decoration-none">
                        <img src="@/Assets/Images/genre/bg-moon.webp" alt=""
                            class="img-fluid w-100 position-absolute rounded-3" style="height: 150px;">
                        <div class="card card-body border-0 rounded-3"
                            style="height: 150px; background-color: rgba(53, 53, 53, 0.425)">
                            <h1 class="text-light my-auto" style="z-index: 2;">Mystery</h1>
                            <img src="@/Assets/Images/genre/moon.webp" alt=""
                                class="hero-genre img-fluid position-absolute">
                        </div>
                        </Link>
                    </div>

                    <div class="col-md-4 col-sm-6 popup genre">
                        <Link href="/genresuperhero" class="position-relative text-decoration-none">
                        <img src="@/Assets/Images/genre/bg-iron.webp" alt=""
                            class="img-fluid w-100 position-absolute rounded-3" style="height: 150px;">
                        <div class="card card-body border-0 rounded-3"
                            style="height: 150px; background-color: rgba(53, 53, 53, 0.425)">
                            <h1 class="text-light my-auto" style="z-index: 2;">Superhero</h1>
                            <img src="@/Assets/Images/genre/ironman.webp" alt=""
                                class="hero-genre img-fluid position-absolute">
                        </div>
                        </Link>
                    </div>

                    <div class="col-md-4 col-sm-6 popup genre">
                        <Link href="/genreromance" class="position-relative text-decoration-none">
                        <img src="@/Assets/Images/genre/bg-romance.webp" alt=""
                            class="img-fluid w-100 position-absolute rounded-3" style="height: 150px;">
                        <div class="card card-body border-0 rounded-3"
                            style="height: 150px; background-color: rgba(53, 53, 53, 0.425)">
                            <h1 class="text-light my-auto" style="z-index: 2;">Romance</h1>
                            <img src="@/Assets/Images/genre/gamora.webp" alt=""
                                class="hero-genre img-fluid position-absolute">
                        </div>
                        </Link>
                    </div>

                </div>
            </div>
        </template>
    </MainLayout>

    <Writer />
    <Footer />
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<script>
export default {
    props: {
        ComicList: Array
    },
    methods: {
        getCoverPath(cover) {
            return `/images/comic_cover/${cover}`;
        },
    },
    computed: {
        auth() {
            return this.$page.props.auth;
        },
    }
};

// Layout
import MainLayout from '@/Pages/Application/Layout/MainLayout.vue'

// Component
import Navbar from '@/Pages/Application/Component/Navbar.vue'
import NavbarLogin from '@/Pages/Application/Component/NavbarLogin.vue'
import Writer from '@/Pages/Application/Component/Writer.vue'
import Footer from '@/Pages/Application/Component/Footer.vue'
</script>