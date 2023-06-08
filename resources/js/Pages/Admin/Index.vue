<template>
    <Navbar />
    <MenuBar />
    <DashboardLayout>
        <template v-slot:sidebar>
            <SideBar />
        </template>
        <template v-slot:main>
            <h3>{{ pageTitle }}</h3>
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-8">
                                    <label class="fw-bold text-secondary">Total user</label>
                                    <h3>{{ totalUsers }}</h3>
                                </div>
                                <div class="col-4 text-end d-flex align-items-center justify-content-end">
                                    <i class="fa-duotone fa-users fs-3 text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-8">
                                    <label class="fw-bold text-secondary">User Active</label>
                                    <h3>{{ totalUsersActive }}</h3>
                                </div>
                                <div class="col-4 text-end d-flex align-items-center justify-content-end">
                                    <i class="fa-duotone fa-user fs-3 text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-8">
                                    <label class="fw-bold text-secondary">User Non Active</label>
                                    <h3>{{ totalUsersNonActive }}</h3>
                                </div>
                                <div class="col-4 text-end d-flex align-items-center justify-content-end">
                                    <i class="fa-duotone fa-user-slash fs-3 text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-8">
                                    <label class="fw-bold text-secondary">Sales</label>
                                    <h3>{{ sales }}</h3>
                                </div>
                                <div class="col-4 text-end d-flex align-items-center justify-content-end">
                                    <i class="fa-duotone fa-rupiah-sign fs-3 text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-8">
                                    <label class="fw-bold text-secondary">Comics</label>
                                    <h3>{{ comic }}</h3>
                                </div>
                                <div class="col-4 text-end d-flex align-items-center justify-content-end">
                                    <i class="fa-duotone fa-books fs-3 text-dark"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        totalUsers: Array,
        totalUsersActive: Array,
        totalUsersNonActive: Array,
        sales: Array,
        comic: Array
    }
}

</script>