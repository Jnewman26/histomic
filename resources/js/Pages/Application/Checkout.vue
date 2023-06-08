<template>
    <NavbarLogin />
    <section class="container mt-5">
        <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible fade show" role="alert"
            id="success-alert" style="z-index: 999;">
            <i class="fa-duotone fa-circle-check"></i> {{ $page.props.flash.message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="col-12" v-for="comic in checkout">
            <div class="row">
                <div class="col-md-4 col-sm-12 bg-body-tertiary rounded-4 p-3 mx-auto">
                    <div class="col-12 px-3">
                        <div class="row">
                            <div class="col-4 p-0">
                                <img :src="getCoverPath(comic.COMIC_COVER)" alt="" class="img-fluid w-100 rounded-3">
                            </div>
                            <div class="col-8">
                                <strong class="fs-5 text-danger">{{ comic.COMIC_GENRE }}</strong>
                                <h5>{{ comic.COMIC_TITLE }}</h5>
                                <div class="text-end">
                                    <h5 class="mt-5">Rp {{ comic.COMIC_PRICE }}</h5>
                                    <img src="@/Assets/Images/bca.jpg" class="img-fluid w-75" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="border border-1 border-dark">
                    <div class="col-12 p-3">
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-muted">Subtotal</strong>
                            </div>
                            <div class="col-6">
                                <h5 class="text-muted fw-bold text-end">IDR {{ comic.COMIC_PRICE }}</h5>
                            </div>

                            <div class="col-6">
                                <strong class="text-muted">Biaya Layanan</strong>
                            </div>
                            <div class="col-6">
                                <h5 class="text-muted fw-bold text-end">IDR 250.000</h5>
                            </div>
                        </div>
                    </div>
                    <hr class="border border-1 border-dark">
                    <div class="col-12 p-3">
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-muted">Total</strong>
                            </div>
                            <div class="col-6">
                                <h5 class="text-muted fw-bold text-end">IDR {{ comic.SALES_TOTAL }}</h5>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="pay(comic.COMIC_ID, comic.COMIC_GENRE, comic.COMIC_TITLE, comic.COMIC_PRICE, comic.SALES_ID)">
                        <button type="submit" class="btn btn-success w-100"><i class="fa-duotone fa-credit-card me-1"></i> Pay Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <Footer />
</template>

<script setup>
import NavbarLogin from '@/Pages/Application/Component/NavbarLogin.vue'
import Footer from '@/Pages/Application/Component/Footer.vue'
</script>

<script>
export default {
    props: {
        checkout: Array
    },
    methods: {
        getCoverPath(cover) {
            return `/images/comic_cover/${cover}`;
        },
        pay(cartId, genre, title, price, salesid) {
            const formData = {
                COMIC_ID: cartId,
                SALES_TOTAL: parseFloat(price),
                COMIC_GENRE: genre,
                COMIC_TITLE: title,
                SALES_ID: salesid
            };

            this.$inertia.post('/checkout', formData)
                .then(() => {
                    // Jika berhasil, lakukan tindakan yang sesuai, misalnya alihkan ke halaman lain
                })
                .catch((error) => {
                    // Jika terjadi kesalahan, tangani kesalahan di sini
                    console.error(error);
                });
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
</script>