<template>
    <NavbarLogin />
    <MenuBar />
    <LayoutDashboard>
        <template v-slot:sidebar>
            <SideBar />
        </template>
        <template v-slot:main>
            <!-- main -->
            <h3 class="fw-bold">My Library Writer</h3>
            <div class="col-12">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

                    <div v-for="libw in LibraryWriter" class="col mt-4">
                        <img :src="getCoverPath(libw.COMIC_COVER)" alt="" class="card-img-top rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <a href="" class="col-12 text-decoration-none" data-bs-toggle="modal"
                                    v-bind:data-bs-target="'#exampleModal-' + libw.COMIC_ID" @click="openModal">
                                    <strong class="fs-5 text-danger">{{ libw.COMIC_GENRE }}</strong><br>
                                    <h5 class="text-dark text-truncate">{{ libw.COMIC_TITLE }}</h5>
                                </a>
                            </div>
                            <!-- <button class="btn btn-dark w-100"><i class="fa-duotone fa-pen-nib me-1"></i> edit</button> -->
                            <Link :href="`/librarywriter/${libw.COMIC_ID}/edit`" class="btn btn-dark w-100">
                                <i class="fa-duotone fa-pen-nib me-1"></i> edit
                            </Link>
                        </div>
                    </div>
                    <Link href="/newcomic" class="col mt-4 text-decoration-none text-dark">
                        <div
                            class="card-body h-100 border border-2 rounded-3 d-flex justify-content-center align-items-center">
                            <i class="fad fa-plus" style="font-size: 60px;"></i>
                        </div>
                    </Link>
                </div>
                <!-- end main -->
            </div>
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

import LayoutDashboard from '@/Pages/Application/Layout/LayoutDashboard.vue'
import SideBar from '@/Pages/Application/Component/SideBar.vue'
import NavbarLogin from '@/Pages/Application/Component/NavbarLogin.vue'
import MenuBar from '@/Pages/Application/Component/MenuBar.vue'
import Footer from '@/Pages/Application/Component/Footer.vue';
</script>

<script>
export default {
    props: {
        LibraryWriter: Array,
        CombinedData: Array,
        Chapter: Array,
        comic: Array
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
    },
    components: { Footer },
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
</script>