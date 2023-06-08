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
                    <li class="nav-item mx-1">
                        <Link class="nav-link text-dark" href="/wishlist" @click="activePage = 'wishlist'">
                        <i :class="['fa-duotone', 'fa-heart', 'fs-5', { 'text-danger': activePage === 'wishlist' }]"></i>
                        </Link>
                    </li>
                    <li class="nav-item mx-1 me-3">
                        <Link class="nav-link" href="/cart" @click="activePage = 'cart'">
                        <i
                            :class="['fa-basket-shopping', 'text-dark', 'fs-5', { 'fa-duotone': activePage !== 'cart', 'fa-solid': activePage === 'cart' }]"></i>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="dropdown-toggle p-0 border-0 bg-transparent" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="@/Assets/Images/profile.png" alt="" class="img-fluid bg-danger rounded p-2"
                                    style="width: 40px;">
                            </button>
                            <ul class="dropdown-menu mt-3" style="left: -100px;">
                                <li>
                                    <Link class="dropdown-item" href="/dashboard">
                                    <i class="mb-2 fa-duotone fa-layer-group me-2"></i>Dashboard
                                    </Link>
                                </li>
                                <li>
                                    <Link class="dropdown-item" href="/libraryreader">
                                    <i class="mb-2 fa-duotone fa-books me-2"></i>Library Reader
                                    </Link>
                                </li>
                                <li>
                                    <Link class="dropdown-item" href="/librarywriter">
                                    <i class="mb-2 fa-duotone fa-books me-2"></i>Library Writer
                                    </Link>
                                </li>
                                <li>
                                    <Link class="dropdown-item" href="/profile">
                                    <i class="mb-2 fa-duotone fa-user me-2"></i>Profile
                                    </Link>
                                </li>
                                <li>
                                    <Link class="dropdown-item" href="/logout" method="post">
                                    <i class="mb-2 fa-duotone fa-door-open me-2"></i>Sign Out
                                    </Link>
                                </li>
                            </ul>
                        </div>
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


