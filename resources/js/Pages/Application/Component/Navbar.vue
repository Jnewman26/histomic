<template>
    <!-- start navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <Link class="navbar-brand font-bangers" style="font-size:36px;" href="/">Histomic</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-1">
                        <Link class="nav-link fw-semibold" aria-current="page" href="/comics"
                            :class="{ active: activePage === 'comics' }">Comics</Link>
                    </li>
                    <li class="nav-item mx-1">
                        <Link class="nav-link fw-semibold" href="/genres" :class="{ active: activePage === 'genres' }">
                        Genres</Link>
                    </li>
                    <li class="nav-item mx-3">
                        <Link href="/login" type="submit" class="btn btn-dark">Log In</Link>
                    </li>
                    <li class="nav-item">
                        <Link href="/signup" type="submit" class="btn btn-outline-dark">Sign Up</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const activePage = computed(() => {
    return window.location.pathname.split('/')[1]
})
</script>

<script>

</script>