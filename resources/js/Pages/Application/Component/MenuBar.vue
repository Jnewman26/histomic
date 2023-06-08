<template>
    <!-- menu bar -->
    <nav class="navbar navbar-expand-lg bg-body-secondary py-0 d-block d-xl-none d-none d-lg-block">
        <div class="container d-flex justify-content-between menu-bar">
            <Link class="nav-link d-inline py-2 active" href="/dashboard">
            <i class="fa-duotone fa-layer-group me-2"></i>Dashboard
            </Link>
            <Link class="nav-link d-inline py-2" href="/wishlist">
            <i class="fad fa-heart me-2"></i>Wishlist
            </Link>
            <Link class="nav-link d-inline py-2" href="/libraryreader">
            <i class="fad fa-books me-2"></i>Library Reader
            </Link>
            <Link class="nav-link d-inline py-2" href="/librarywriter">
            <i class="fad fa-feather me-2"></i>Library Writer
            </Link>
            <Link class="nav-link d-inline py-2" href="/profile">
            <i class="fad fa-user me-2"></i>Profile
            </Link>
        </div>
    </nav>
    <!-- end menu bar -->
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>