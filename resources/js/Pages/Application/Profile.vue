<template>
    <NavbarLogin />
    <MenuBar />
    <LayoutDashboard>
        <template v-slot:sidebar>
            <SideBar />
        </template>
        <template v-slot:main v-for="user in user">
            <!-- main -->
            <h3 class="fw-bold mb-5">My Profile</h3>
            <div class="col-12 mb-3">
                <strong>User Profile</strong>
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="">Name</label>
                        <p class="fw-semibold">{{ user.USER_NAME }}</p>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="">Email</label>
                        <p class="fw-semibold">{{ user.USER_EMAIL }}</p>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="">Phone</label>
                        <p class="fw-semibold">{{ user.USER_PHONE }}</p>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="">Gender</label>
                        <p class="fw-semibold">{{ user.USER_GENDER }}</p>
                    </div>
                </div>
            </div>

            <!-- <div class="d-flex justify-content-end">
                <Link href="/user" class="btn btn-dark me-2">Back</Link>
                <Link :href="`/user/${user.USER_ID}/edit`" class="btn btn-primary text-white me-2">Edit</Link>
                <a href="" @click.prevent="deleteuser" class="btn btn-danger">Delete</a>
            </div> -->
        </template>
    </LayoutDashboard>
    <Footer />
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
        user: Array
    },
    data() {
        return {
            selectedComicId: null,
        };
    },
    components: { Footer },
    computed: {
        auth() {
            return this.$page.props.auth;
        },
        USER_ID() {
            return this.auth ? this.auth.USER_ID : null;
        }
    }
}
</script>