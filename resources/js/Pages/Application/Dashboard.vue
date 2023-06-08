<template>
    <NavbarLogin />
    <MenuBar />
    <LayoutDashboard>
        <template v-slot:sidebar>
            <SideBar />
        </template>
        <template v-slot:main>
            <!-- main -->
            <div class="col-12">
                <div class="row">
                    <div class="col-md-7 col-sm-12 mb-3">
                        <div class="crop-dashboard-1 rounded-4 position-relative shadow">
                            <div class="position-absolute w-100 h-100 overlay p-4">
                                <div class="row text-white position-absolute" style="bottom: 20px;">
                                    <div class="col-12">
                                        <p>NAMA PENULIS</p>
                                        <h1>The Amazing Spider-Man</h1>
                                        <button class="btn btn-lg btn-light">Read Now</button>
                                    </div>
                                </div>
                            </div>
                            <img src="@/Assets/Images/dsahboard-main.gif" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <h3 class="fw-bold mb-3">Continue Reading</h3>
                        <div class="crop-dashboard-2 rounded-4 position-relative shadow">
                            <div class="position-absolute w-100 h-100 overlay p-4">
                                <div class="row text-white position-absolute" style="bottom: 20px;">
                                    <div class="col-8">
                                        <h4>Iron-Man : The Invicible Iron Man</h4>
                                    </div>
                                </div>
                            </div>
                            <img src="@/Assets/Images/ironman.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="col-12">
                            <!-- <h3 class="my-3 fw-bold">Unlocked Hero</h3> -->
                            <div class="row mt-4">
                                <div class="col-3 popup">
                                    <img src="@/Assets/Images/ironman-dash.png" alt="" class="img-fluid">
                                </div>
                                <div class="col-3 popup">
                                    <img src="@/Assets/Images/hulk-dash.png" alt="" class="img-fluid">
                                </div>
                                <div class="col-3 popup">
                                    <img src="@/Assets/Images/widow-dash.png" alt="" class="img-fluid">
                                </div>
                                <div class="col-3 popup">
                                    <img src="@/Assets/Images/spiderman-dash.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <h3 class="mt-3 fw-bold">Hot Comic</h3>
                        <div class="row">

                            <div v-for="comic in ComicList.slice(0, 6)" class="col-lg-2 col-md-3 col-6 mt-2 popup">
                                <img :src="getCoverPath(comic.COMIC_COVER)" alt="" class="card-img-top rounded-3">
                                <div class="card-body">
                                    <div class="row">
                                        <a href="" class="col-9 text-decoration-none" data-bs-toggle="modal"
                                            v-bind:data-bs-target="'#exampleModal-' + comic.COMIC_ID" @click="openModal">
                                            <strong class="fs-5 text-danger">{{ comic.COMIC_GENRE }}</strong><br>
                                            <p class="text-dark text-truncate">{{ comic.COMIC_TITLE }}</p>
                                        </a>
                                        <div class="col-3 d-flex align-items-center justify-content-end">
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
            </div>
            <!-- end main -->
        </template>
    </LayoutDashboard>
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
import LayoutDashboard from '@/Pages/Application/Layout/LayoutDashboard.vue'
import SideBar from '@/Pages/Application/Component/SideBar.vue'
import NavbarLogin from '@/Pages/Application/Component/NavbarLogin.vue'
import MenuBar from '@/Pages/Application/Component/MenuBar.vue'
import Footer from '@/Pages/Application/Component/Footer.vue';
</script>

<script>
export default {
    props: {
        ComicList: Array,
        CombinedData: Array,
        Chapter: Array
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
    components: { Footer },
    computed: {
        auth() {
            return this.$page.props.auth;
        },
        USER_ID() {
            return this.auth ? this.auth.USER_ID : null;
        },
        USER_NAME() {
            return this.auth ? this.auth.USER_NAME : null;
        }
    }
}
</script>