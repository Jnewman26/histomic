<template>
    <!-- <div class="col mt-4 position-relative popup">
        
        <img :src="cover" alt="Comic Cover" class="card-img-top rounded-3" style="z-index: 1;">
        <div class="card-body">
            <div class="row">
                <a href="" class="col-10 text-decoration-none" data-bs-toggle="modal"
                    v-bind:data-bs-target="'#exampleModal-' + comic.COMIC_ID" @click="openModal">
                    <strong class="fs-5 text-danger">{{ genre }}</strong><br>
                    <p class="text-dark text-truncate">{{ title }}</p>
                </a>
                <div class="col-2 d-flex align-items-center justify-content-end">
                    <a href="">
                        <i class="fa-duotone fa-heart fs-5 text-dark"></i>
                    </a>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script setup>
import { defineProps } from 'vue'
import { Link } from '@inertiajs/vue3'

const openModal = () => {
    emit('open-modal')
}

const props = defineProps({
    genre: String,
    title: String,
    cover: String
})
</script>

<!-- <div class="position-absolute label-own py-2 px-3">
        <strong class="mt-2">Owned</strong>
        </div> -->