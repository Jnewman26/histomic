<template>
    <Navbar></Navbar>
    <MenuBar />
    <DashboardLayout>
        <template v-slot:sidebar>
            <SideBar />
        </template>
        <template v-slot:main>
            <h3 class="">{{ pageTitle }}</h3>
            <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $page.props.flash.message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="card card-body border table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Join Date</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.USER_ID">
                            <th>
                                {{ user.USER_NAME }}
                                <p v-if="user.USER_STATUS === 1" class="badge text-bg-success fw-semibold">Active</p>
                                <p v-else="user.USER_STATUS === 0" class="badge text-bg-danger fw-semibold">Non-Active</p>
                            </th>
                            <td>{{ user.USER_EMAIL }}</td>
                            <td>{{ user.USER_PHONE }}</td>
                            <td>{{ user.USER_JOIN_DATE }}</td>
                            <td class="d-flex">
                                <Link :href="`/user/${user.USER_ID}`" class="me-2 btn btn-dark text-white">
                                <i class="fas fa-id-card"></i>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Join Date</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </template>
    </DashboardLayout>
    <Footer />
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
import Footer from '@/Pages/Admin/Component/Footer.vue'

export default {
    props: {
        pageTitle: String,
        users: Array
    }
}

</script>