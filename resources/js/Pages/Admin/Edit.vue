<template>
    <Navbar></Navbar>
    <MenuBar />
    <DashboardLayout>
        <template v-slot:sidebar>
            <SideBar />
        </template>
        <template v-slot:main>
            <form @submit.prevent="update">
                <div class="form-group">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <label class="mb-2">Name</label>
                                <input class="form-control mb-3" type="text" v-model="form.name">
                                <p class="text-danger" v-if="errors.name">{{ errors.name }}</p>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="mb-2">Email</label>
                                <input class="form-control mb-3" type="email" v-model="form.email">
                                <p class="error" v-if="errors.email">{{ errors.email }}</p>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="mb-2">Phone</label>
                                <input class="form-control mb-3" type="number" v-model="form.phone">
                                <p class="error" v-if="errors.phone">{{ errors.phone }}</p>
                            </div>
                            <!-- <div class="col-md-4 col-12">
                                <label class="mb-2">Status</label><br>
                                <input class="mb-3" type="radio" v-model="form.status" value="1"> Active
                                <input class="mb-3 ms-2" type="radio" v-model="form.status" value="0"> Non-Active
                                <p class="error" v-if="errors.status">{{ errors.status }}</p>
                            </div> -->

                            <div class="col-md-4 col-12">
                                <label for="">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheck"
                                        v-model="form.status" :true-value="1" :false-value="0">
                                    <label class="form-check-label" for="flexSwitchCheck">{{ form.status ? 'Active' :
                                        'Non-Active' }}</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <button class="btn btn-success mt-3" type="submit">Update</button>
            </form>
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
        errors: Object,
        user: Object
    },
    data() {
        return {
            form: {
                name: this.user.USER_NAME,
                email: this.user.USER_EMAIL,
                phone: this.user.USER_PHONE,
                status: this.user.USER_STATUS
            }
        }
    },
    methods: {
        update() {
            this.$inertia.put('/user/' + this.user.USER_ID, this.form)
        }
    }
}
</script>