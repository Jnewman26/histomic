<template>
    <Navbar v-if="!auth" />
    <NavbarLogin v-else />
    <MainLayout>
        <template v-slot:main>
            <div class="d-flex justify-content-right fixed-bottom">
                <div v-if="$page.props.flash.message"
                    class="alert alert-success alert-dismissible fade w-25 show position-absolute" role="alert"
                    id="success-alert" style="z-index: 999; right: 0px; bottom: 0px;">
                    <i class="fa-duotone fa-circle-check"></i> {{ $page.props.flash.message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <!-- start hero -->
            <section id="hero" class="container position-relative mt-3">
                <img src="@/Assets/Images/hero-2.webp" class="img-fluid" style="width: 100%;" />
                <img v-if="!auth" src="@/Assets/Images/ironman-hero.webp" class="img-fluid position-absolute hero"
                    style="left: 0; top: -45px;" />
                <img v-if="auth" src="@/Assets/Images/ultraman.png"
                    class="img-fluid position-absolute hero image-animation w-50" style="left: 0; top: -45px;" />
            </section>
            <!-- end hero -->

            <!-- start content -->
            <section class="container" style="margin-top: 100px;">
                <h1 class="text-center font-bangers position-relative">
                    <span class="main-title">HOT COMIC</span>
                </h1>

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                    <div v-for="comic in ComicList.slice(0, 10)" class="col mt-4 position-relative popup">
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
                                    <div v-if="Wishlist.some(item => item.COMIC_ID == comic.COMIC_ID)">
                                        <button class="bg-transparent border-0 p-0" href=""
                                            @click="removeToWishlist(comic, $event)">
                                            <i class="fa-duotone fa-heart fs-5 text-danger"></i>
                                        </button>
                                    </div>

                                    <div v-else>
                                        <button class="bg-transparent border-0 p-0" href=""
                                            @click="addToWishlist(comic, $event)">
                                            <i class="fa-duotone fa-heart fs-5 text-dark"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                    <div v-for="comic in ComicList.slice(0, 10)" :key="comic.COMIC_ID"
                        class="col mt-4 position-relative popup">
                        <img :src="getCoverPath(comic.COMIC_COVER)" alt="Comic Cover" class="card-img-top rounded-3"
                            style="z-index: 1;">
                        <div class="card-body">
                            <div class="row">
                                <a href="#" class="col-10 text-decoration-none" data-bs-toggle="modal"
                                    :data-bs-target="'#exampleModal-' + comic.COMIC_ID" @click="openModal">
                                    <strong class="fs-5 text-danger">{{ comic.COMIC_GENRE }}</strong><br>
                                    <p class="text-dark text-truncate">{{ comic.COMIC_TITLE }}</p>
                                </a>
                                <div class="col-2 d-flex align-items-center justify-content-end">
                                    <button class="bg-transparent border-0 p-0" href=""
                                        @click="addToWishlist(comic.COMIC_ID, $event)">
                                        <i class="fa-duotone fa-heart fs-5 text-dark"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                    <div v-for="comic in ComicList.slice(0, 10)" :key="comic.COMIC_ID"
                        class="col mt-4 position-relative popup">
                        <img :src="getCoverPath(comic.COMIC_COVER)" alt="Comic Cover" class="card-img-top rounded-3"
                            style="z-index: 1;">
                        <div class="card-body">
                            <div class="row">
                                <a href="" class="col-10 text-decoration-none" data-bs-toggle="modal"
                                    v-bind:data-bs-target="'#exampleModal-' + comic.COMIC_ID"
                                    @click="openModal(comic.COMIC_ID)">
                                    <strong class="fs-5 text-danger">{{ comic.COMIC_GENRE }}</strong><br>
                                    <p class="text-dark text-truncate">{{ comic.COMIC_TITLE }}</p>
                                </a>
                                <div class="col-2 d-flex align-items-center justify-content-end">
                                    <button class="bg-transparent border-0 p-0" href="" @click="toggleWishlist(comic)">
                                        <i v-if="comic.isInWishlist" class="fa-duotone fa-heart fs-5 text-danger"></i>
                                        <i v-else class="fa-duotone fa-heart fs-5 text-dark"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->


                <div class="text-center mt-5">
                    <Link href="/comics" class="btn btn-outline-dark">SEE ALL COMIC</Link>
                </div>
            </section>

            <!-- end content -->

            <!-- banner -->
            <section class="position-relative" style="margin-top: 100px;">
                <img src="@/Assets/Images/banner.webp" class="img-fluid rounded-4" style="width: 100%;">
                <img src="@/Assets/Images/drstrange.webp" class="img-fluid position-absolute banner me-3"
                    style="right: 0; top: -45px;">
            </section>
            <!-- end banner -->

            <!-- content2 -->
            <section class="container" style="margin-top: 100px;">
                <h1 class="text-center font-bangers position-relative">
                    <span class="main-title">genre</span>
                    <!-- <span class="subtitle">Most Genre</span> -->
                </h1>
                <ul class="nav nav-pills mb-4 d-flex justify-content-center mt-4" id="pills-tab" role="tablist">
                    <li class="nav-item mx-4" role="presentation">
                        <button class="nav-link active" id="pills-action-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-action" type="button" role="tab" aria-controls="pills-action"
                            aria-selected="true">Action</button>
                    </li>
                    <li class="nav-item mx-4" role="presentation">
                        <button class="nav-link" id="pills-fantasy-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-fantasy" type="button" role="tab" aria-controls="pills-fantasy"
                            aria-selected="false">Fantasy</button>
                    </li>
                    <li class="nav-item mx-4" role="presentation">
                        <button class="nav-link" id="pills-adventure-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-adventure" type="button" role="tab" aria-controls="pills-adventure"
                            aria-selected="false">Adventure</button>
                    </li>
                    <li class="nav-item mx-4" role="presentation">
                        <button class="nav-link" id="pills-mystery-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-mystery" type="button" role="tab" aria-controls="pills-mystery"
                            aria-selected="false">Mystery</button>
                    </li>
                    <li class="nav-item mx-4" role="presentation">
                        <button class="nav-link" id="pills-superhero-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-superhero" type="button" role="tab" aria-controls="pills-superhero"
                            aria-selected="false">Superhero</button>
                    </li>
                    <li class="nav-item mx-4" role="presentation">
                        <button class="nav-link" id="pills-romance-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-romance" type="button" role="tab" aria-controls="pills-romance"
                            aria-selected="false">Romance</button>
                    </li>
                </ul>
                <div class="tab-content card px-4 shadow-custom border-0" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-action" role="tabpanel"
                        aria-labelledby="pills-action-tab" tabindex="0">
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
                            <div v-for="comic in ComicListAction" class="col mt-4 position-relative popup">
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
                    </div>


                    <div class="tab-pane fade" id="pills-fantasy" role="tabpanel" aria-labelledby="pills-fantasy-tab"
                        tabindex="0">
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
                            <div v-for="comic in ComicListFantasy" class="col mt-4 position-relative popup">
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
                    </div>

                    <div class="tab-pane fade" id="pills-adventure" role="tabpanel" aria-labelledby="pills-adventure-tab"
                        tabindex="0">
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
                            <Card v-for="comic in ComicListAdventure" :key="comic.COMIC_ID"
                                :cover="getCoverPath(comic.COMIC_COVER)" :genre="comic.COMIC_GENRE"
                                :title="comic.COMIC_TITLE" />
                            <div v-for="comic in ComicListAdventure" class="col mt-4 position-relative popup">
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
                    </div>

                    <div class="tab-pane fade" id="pills-mystery" role="tabpanel" aria-labelledby="pills-mystery-tab"
                        tabindex="0">
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
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
                    </div>

                    <div class="tab-pane fade" id="pills-superhero" role="tabpanel" aria-labelledby="pills-superhero-tab"
                        tabindex="0">
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
                            <div v-for="comic in ComicListSuperhero" class="col mt-4 position-relative popup">
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
                    </div>

                    <div class="tab-pane fade" id="pills-romance" role="tabpanel" aria-labelledby="pills-romance-tab"
                        tabindex="0">
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
                            <div v-for="comic in ComicListRomance" class="col mt-4 position-relative popup">
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
                    </div>
                </div>
            </section>
            <!-- end content2 -->

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
                                <h6>Price : <span>{{ comic.COMIC_PRICE }}</span></h6>

                                <div v-if="LibraryReader.some(item => item.COMIC_ID === comic.COMIC_ID)">
                                    <div class="position-absolute label-own py-2 px-3">
                                        <strong class="mt-2">Owned</strong>
                                    </div>
                                </div>

                                <div v-else-if="LibraryWriter.some(item => item.COMIC_ID === comic.COMIC_ID)">
                                    <div class="position-absolute label-writer py-2 px-3">
                                        <strong class="mt-2">Writer</strong>
                                    </div>
                                </div>

                                <div v-else>
                                    <button class="btn btn-dark my-2" @click="addToCart(comic, $event)">
                                        <i class="fa-duotone fa-basket-shopping me-1"></i> Add to Cart
                                    </button>
                                    <button class="btn btn-dark">
                                        <i class="fa-duotone fa-scanner-gun fa-beat-fade me-1"></i> Checkout
                                    </button>
                                </div>
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
        ComicList: Array,
        ComicListAction: Array,
        ComicListFantasy: Array,
        ComicListAdventure: Array,
        ComicListMystery: Array,
        ComicListSuperhero: Array,
        ComicListRomance: Array,
        CombinedData: Array,
        Chapter: Array,
        Wishlist: Array,
        LibraryReader: Array,
        LibraryWriter: Array
    },
    data() {
        return {
            selectedComicId: null,
        };
    },
    methods: {
        getCoverPath(cover) {
            return `/images/comic_cover/${cover}`;
        },
        openModal(comicId) {
            this.selectedComicId = comicId;
        },
        addToWishlist(comic, event) {
            event.preventDefault();
            this.$inertia.post('/add-to-wishlist', { comicId: comic.COMIC_ID });
            comic.isInWishlist = true;
        },
        removeToWishlist(comic, event) {
            event.preventDefault();
            this.$inertia.post('/remove-to-wishlist', { comicId: comic.COMIC_ID });
            comic.isInWish = true;
            this.redirectToWish();
        },
        addToCart(comic, event) {
            event.preventDefault();
            this.$inertia.post('/add-to-cart', { comicId: comic.COMIC_ID });
            comic.isInCart = true;
            this.redirectToCart();
        },
        redirectToCart() {
            const refreshCount = sessionStorage.getItem('cartRefreshCount');
            if (!refreshCount) {
                sessionStorage.setItem('cartRefreshCount', '1');
                window.location.href = '/cart';
            } else if (parseInt(refreshCount) < 2) {
                const newCount = parseInt(refreshCount) + 1;
                sessionStorage.setItem('cartRefreshCount', newCount.toString());
                window.location.href = '/cart';
            }
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
}

// Layout
import MainLayout from '@/Pages/Application/Layout/MainLayout.vue'

// Component
import Navbar from '@/Pages/Application/Component/Navbar.vue'
import NavbarLogin from '@/Pages/Application/Component/NavbarLogin.vue'
import Card from '@/Pages/Application/Component/Card.vue'
import Writer from '@/Pages/Application/Component/Writer.vue'
import Footer from '@/Pages/Application/Component/Footer.vue'
</script>
