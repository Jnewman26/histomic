<template>
    <Navbar></Navbar>
    <MenuBar />
    <DashboardLayout>
        <template v-slot:sidebar>
            <SideBar />
        </template>
        <template v-slot:main>
            <div class="card card-body d-flex">

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

                <div class="col-12 mb-3">
                    <strong>User Information</strong>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <label for="">Status</label><br>
                            <p v-if="user.USER_STATUS === 1" class="badge text-bg-success fw-semibold">Active</p>
                            <p v-else="user.USER_STATUS === 0" class="badge text-bg-danger fw-semibold">Non-Active</p>
                        </div>

                        <div class="col-sm-12 col-md-3">
                            <label for="">User ID</label>
                            <p class="fw-semibold">{{ user.USER_ID }}</p>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="">LIbrary Writer ID</label>
                            <p class="fw-semibold">{{ user.LIBRARY_WRITER_ID }}</p>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="">Library Reader ID</label>
                            <p class="fw-semibold">{{ user.LIBRARY_READER_ID }}</p>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="">User Cart ID</label>
                            <p class="fw-semibold">{{ user.CART_ID }}</p>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="">Wishlist ID</label>
                            <p class="fw-semibold">{{ user.WISHLIST_ID }}</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <Link href="/user" class="btn btn-dark me-2">Back</Link>
                    <Link :href="`/user/${user.USER_ID}/edit`" class="btn btn-primary text-white me-2">Edit</Link>
                    <!-- <a href="" @click.prevent="deleteuser" class="btn btn-danger">Delete</a> -->
                </div>
            </div>
        </template>
    </DashboardLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<script>
// Layout
import DashboardLayout from '@/Pages/Admin/Layout/DashboardLayout.vue'

// Component
import SideBar from '@/Pages/Admin/Component/SideBar.vue'
import Navbar from '@/Pages/Admin/Component/Navbar.vue'
import MenuBar from '@/Pages/Admin/Component/MenuBar.vue'

export default {
    props: {
        title: String,
        user: Object
    },
    methods: {
        deleteuser() {
            if (confirm('data user ingin dihapus?')) {
                this.$inertia.delete('/users/' + this.user.id);
            } else {
                false
            }
        }
    }
}
</script>