<template>
    <NavbarLogin />
    <MenuBar />
    <LayoutDashboard>
        <template v-slot:sidebar>
            <SideBar />
        </template>
        <template v-slot:main>
            <form @submit.prevent="update">
                <div class="form-group">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <label class="mb-2">Comic Name</label>
                                <input class="form-control mb-3" type="text" v-model="form.title">
                                <p class="text-danger" v-if="errors.title">{{ errors.title }}</p>
                            </div>
                            <!-- <div class="col-md-4 col-12">
                                <label class="mb-2">Comic Genre</label>
                                <input class="form-control mb-3" type="email" v-model="form.genre">
                                <p class="error" v-if="errors.genre">{{ errors.genre }}</p>
                            </div> -->
                            <div class="col-md-4 col-12">
                                <label class="mb-2">Comic Genre</label>
                                <select class="form-control mb-3" v-model="form.genre">
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
                                <input class="form-control mb-3" type="number" v-model="form.price">
                                <p class="error" v-if="errors.price">{{ errors.price }}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <button class="btn btn-success mt-3" type="submit">Update</button>
            </form>
        </template>
    </LayoutDashboard>
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
        errors: Object,
        comic: Object
    },
    data() {
        return {
            form: {
                title: this.comic.COMIC_TITLE,
                genre: this.comic.COMIC_GENRE,
                price: this.comic.COMIC_PRICE,
            }
        }
    },
    methods: {
        update() {
            this.$inertia.put('/librarywriter/' + this.comic.COMIC_ID, this.form)
        }
    },
    components: { Footer },
}
</script>