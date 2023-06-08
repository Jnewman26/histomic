<template>
    <Navbar v-if="!auth" />
    <NavbarLogin v-else />
    <MainLayout>
        <template v-slot:main>

            <!-- start content -->
            <section class="container" style="margin-top: 100px;">
                <h1 class="text-center font-bangers position-relative">
                    <span class="main-title">Mystery Comic</span>
                    <!-- <span class="subtitle">must read</span> -->
                </h1>

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                    <div v-for="comic in ComicListMystery" class="col mt-4 position-relative popup">
                        <img :src="getCoverPath(comic.COMIC_COVER)" alt="Comic Cover" class="card-img-top rounded-3"
                            style="z-index: 1;">
                        <div class="card-body">
                            <div class="row">
                                <a href="" class="col-10 text-decoration-none" data-bs-toggle="modal"
                                    v-bind:data-bs-target="'#exampleModal-' + comic.COMIC_ID" @click="openModal">
                                    <strong class="fs-5 text-danger">{{ comic.COMIC_GENRE }}</strong><br>
                                    <p class="text-dark text-truncate">{{ comic.COMIC_TITLE }}</p>
                                </a>
                                <div class="col-2 d-flex align-items-center justify-content-end">
                                    <button class="bg-transparent border-0 p-0" href=""
                                        @click="addToWishlist(comic, $event)">
                                        <i class="fa-duotone fa-heart fs-5 text-dark"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="col-12" style="margin-top: 100px;">
                <div class="row">

                    <h1 class="text-center font-bangers position-relative mb-5">
                        <span class="main-title">Genre</span>
                        <!-- <span class="subtitle">must read</span> -->
                    </h1>

                    <div class="col-md-4 col-sm-6 popup genre">
                        <Link href="/genreMystery" class="position-relative text-decoration-none">
                        <img src="@/Assets/Images/genre/bg-civil.webp" alt=""
                            class="img-fluid w-100 position-absolute rounded-3" style="height: 150px;">
                        <div class="card card-body border-0 rounded-3"
                            style="height: 150px; background-color: rgba(53, 53, 53, 0.425)">
                            <h1 class="text-light my-auto" style="z-index: 2;">Mystery</h1>
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

            <Writer />

        </template>
    </MainLayout>

    <Footer />

    <!-- Modal -->
    <div v-for="comic in CombinedData" class="modal fade darken-img" v-bind:id="'exampleModal-' + comic.COMIC_ID"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content pb-3">
                <div class="modal-header p-0">
                    <section class="position-relative crop">
                        <img class="rounded-top-3" :src="getCoverPath(comic.COMIC_COVER)" alt="">
                        <div class="container">
                            <div class="position-absolute top-50">
                                <!-- <h3 class="text-dark font-bangers"> Histomic</h3> -->
                                <h1 class="text-light font-bangers">{{ comic.COMIC_TITLE }}</h1>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="container">
                    <div class="col-12 p-3">
                        <div class="row">
                            <div class="col-8">
                                <h4>{{ Chapter.filter(ch => ch.COMIC_ID === comic.COMIC_ID).length }} Episode</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias quidem velit quis
                                    deleniti nobis, eius minus cumque repellat tenetur commodi recusandae dolores culpa
                                    odio voluptatibus voluptas nesciunt, officiis laborum maxime.</p>
                            </div>
                            <div class="col-4">
                                <h6>Genre : <span>{{ comic.COMIC_GENRE }}</span></h6>
                                <h6>Author : <span>{{ comic.USER_NAME }}</span></h6>

                                <!-- <div class="position-absolute label-own py-2 px-3">
                                    <strong class="mt-2">Owned</strong>
                                </div> -->

                                <!-- <div class="text-end mt-5">
                                <button class="btn btn-dark"><i class="fa-duotone fa-basket-shopping me-1"></i> Add to Cart</button>
                            </div> -->
                                <button class="btn btn-dark my-2" @click="addToCart(comic, $event)">
                                    <i class="fa-duotone fa-basket-shopping me-1"></i> Add to Cart
                                </button>
                                <button class="btn btn-dark">
                                    <i class="fa-duotone fa-scanner-gun fa-beat-fade me-1"></i> Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-5">
                    <div class="col-12">
                        <div class="d-lg-block">
                            <ul class="list-group list-group-flush mt-3">

                                <li v-for="(chapter, index) in Chapter.filter(ch => ch.COMIC_ID === comic.COMIC_ID)"
                                    :key="chapter.CHAPTER_ID" class="list-group-item chapter">
                                    <a href="comic-detail.php" class="col-12" style="text-decoration: none;">
                                        <div class="row">
                                            <div class="col-1 d-flex align-items-center justify-content-center">
                                                <h5 class="text-dark">{{ index + 1 }}</h5>
                                            </div>
                                            <div class="col-10">
                                                <h5 class="fw-bold mb-3 text-dark">{{ chapter.CHAPTER_NAME }}</h5>
                                                <p class="text-dark">{{ chapter.CHAPTER_DESC }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<script>
export default {
    props: {
        ComicListMystery: Array,
        CombinedData: Array,
        Chapter: Array
    },
    data() {
        return {
            selectedComicId: null
        }
    },
    methods: {
        getCoverPath(cover) {
            return `/images/comic_cover/${cover}`;
        },
        openModal(comicId) {
            this.selectedComicId = comicId
        },
        addToWishlist(comic, event) {
            event.preventDefault();
            this.$inertia.post('/add-to-wishlist', { comicId: comic.COMIC_ID });
            comic.isInWishlist = true;
        },
        addToCart(comic, event) {
            event.preventDefault();
            this.$inertia.post('/add-to-cart', { comicId: comic.COMIC_ID });
            comic.isInCart = true;
            this.redirectToCart();
        },
        redirectToCart() {
            // Lakukan pengalihan ke halaman cart.vue
            // Setelah pengalihan selesai, refresh halaman
            window.location.href = '/cart';
        },
    },
    computed: {
        auth() {
            return this.$page.props.auth;
        },
        USER_ID() {
            return this.auth ? this.auth.USER_ID : null;
        },
        CART_ID() {
            return this.auth ? this.auth.CART_ID : null;
        },
        LIBRARY_WRITER_ID() {
            return this.auth ? this.auth.LIBRARY_WRITER_ID : null;
        },
        WISHLIST_ID() {
            return this.auth ? this.auth.WISHLIST_ID : null;
        },
        LIBRARY_READER_ID() {
            return this.auth ? this.auth.LIBRARY_READER_ID : null;
        },
        USER_NAME() {
            return this.auth ? this.auth.USER_NAME : null;
        },
        USER_EMAIL() {
            return this.auth ? this.auth.USER_EMAIL : null;
        },
        USER_PHONE() {
            return this.auth ? this.auth.USER_PHONE : null;
        },
        USER_GENDER() {
            return this.auth ? this.auth.USER_GENDER : null;
        },
        USER_VERIFIED_AT() {
            return this.auth ? this.auth.USER_VERIFIED_AT : null;
        },
        USER_PASSWORD() {
            return this.auth ? this.auth.USER_PASSWORD : null;
        },
        USER_STATUS() {
            return this.auth ? this.auth.USER_STATUS : null;
        },
        USER_JOIN_DATE() {
            return this.auth ? this.auth.USER_JOIN_DATE : null;
        },
    }
};

// Layout
import MainLayout from '@/Pages/Application/Layout/MainLayout.vue'

// Component
import Navbar from '@/Pages/Application/Component/Navbar.vue'
import NavbarLogin from '@/Pages/Application/Component/NavbarLogin.vue'
import Card from '@/Pages/Application/Component/Card.vue'
import Writer from '@/Pages/Application/Component/Writer.vue'
import Footer from '@/Pages/Application/Component/Footer.vue'
</script>