<template>
    <NavbarLogin />
    <MenuBar />
    <LayoutDashboard>
        <template v-slot:sidebar>
            <SideBar />
        </template>
        <template v-slot:main>
            <!-- main -->
            <h3 class="fw-bold">Create New Comic</h3>
            <div class="col-12">
                <div class="card card-body">
                    <!-- start code -->
                    <form @submit.prevent="save">
                        <div class="form-group">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label class="mb-2">Comic Name</label>
                                        <input class="form-control mb-3" type="text">
                                        <!-- <p class="text-danger" v-if="errors.title">{{ errors.title }}</p> -->
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="mb-2">Comic Genre</label>
                                        <select class="form-control mb-3">
                                            <option value="">Select a genre</option>
                                            <option value="Adventure">Adventure</option>
                                            <option value="Action">Action</option>
                                            <option value="Fantasy">Fantasy</option>
                                            <option value="Mystery">Mystery</option>
                                            <option value="Romance">Romance</option>
                                            <option value="Superhero">Superhero</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="mb-2">Comic Price</label>
                                        <input class="form-control mb-3" type="number">
                                        <!-- <p class="error" v-if="errors.price">{{ errors.price }}</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success mt-3" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </template>
    </LayoutDashboard>
    <Footer />
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
        HARGA_KOMIK() {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(this.CartList.COMIC_PRICE);
        }
    }
}
</script>