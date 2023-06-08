<template>
    <NavbarLogin />
    <MenuBar />

    <section class="container mt-5">
        <h3 class="fw-bold">My Cart</h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Comic</th>
                        <th scope="col">Price</th>
                        <th scope="col">Checkout</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cart in CartList">
                        <td>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-2 col-sm-12">
                                        <img :src="getCoverPath(cart.COMIC_COVER)" alt="" class="img-fluid"
                                            style="width: 100px;">
                                    </div>
                                    <div class="col-md-10 col-sm-12">
                                        <strong class="fs-5 text-danger">{{ cart.COMIC_GENRE }}</strong>
                                        <h5>{{ cart.COMIC_TITLE }}</h5>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>Rp {{ cart.COMIC_PRICE }}</td>
                        <td>
                            <form
                                @submit.prevent="checkout(cart.COMIC_ID, cart.COMIC_GENRE, cart.COMIC_COVER, cart.COMIC_TITLE, cart.COMIC_PRICE)">
                                <button type="submit" class="btn btn-dark">Checkout
                                    <i class="fa-duotone fa-arrow-right ms-1"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <button href="" @click="addToCart(cart, $event)" class="btn btn-danger">
                                <i class="fa-duotone fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
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
        CartList: Array
    },
    data() {
        // return {
        //     selectedComicId: null,
        //     cart: {
        //         COMIC_ID: '',
        //         COMIC_PRICE: '',
        //         COMIC_GENRE: '',
        //         COMIC_COVER: '',
        //         COMIC_TITLE: ''
        //     }
        // };
    },
    methods: {
        getCoverPath(cover) {
            return `/images/comic_cover/${cover}`;
        },
        openModal(comicId) {
            this.selectedComicId = comicId;
        },
        addToCart(cart, event) {
            event.preventDefault();
            this.$inertia.post('/add-to-cart', { comicId: cart.COMIC_ID });
            comic.isInCart = true;
            this.redirectToCart();
        },
        checkout(cartId, genre, cover, title, price) {
            const formData = {
                COMIC_ID: cartId,
                COMIC_PRICE: parseFloat(price),
                COMIC_GENRE: genre,
                COMIC_COVER: cover,
                COMIC_TITLE: title
            };

            this.$inertia.post('/cart', formData)
                .then(() => {
                    // Jika berhasil, lakukan tindakan yang sesuai, misalnya alihkan ke halaman lain
                })
                .catch((error) => {
                    // Jika terjadi kesalahan, tangani kesalahan di sini
                    console.error(error);
                });
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