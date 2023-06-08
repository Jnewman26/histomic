<template>
    <Navbar v-if="!auth" />
    <NavbarLogin v-if="auth" />
    <MainLayout>
        <template v-slot:main>
            <!-- banner -->
            <section class="position-relative" style="margin-top: 100px;">
                <img src="@/Assets/Images/banner.webp" class="img-fluid rounded-4" style="width: 100%;">
                <img src="@/Assets/Images/drstrange.webp" class="img-fluid position-absolute banner me-3"
                    style="right: 0; top: -45px;">
            </section>
            <!-- end banner -->

            <!-- start content -->
            <section class="container" style="margin-top: 100px;">
                <h1 class="text-center font-bangers position-relative">
                    <span class="main-title">HOT COMIC</span>
                    <!-- <span class="subtitle">must read</span> -->
                </h1>

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

                    <div v-for="comic in ComicList.data" class="col mt-4 position-relative popup">
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

            <div v-if="ComicList.data.length">
                <Pagination :links="ComicList.links" />
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
        ComicList: Object,
        CombinedData: Array,
        Chapter: Array
    },
    methods: {
        getCoverPath(cover) {
            return `/images/comic_cover/${cover}`;
        },
        // tambahanku
        openModal(comicId) {
            this.selectedComicId = comicId;
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
    components: { Pagination },
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
import Pagination from '@/Pages/Application/Component/Pagination.vue';
</script>