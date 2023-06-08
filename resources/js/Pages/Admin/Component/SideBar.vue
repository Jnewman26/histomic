<template>
    <!-- sidebar -->
    <div class="card shadow pt-3 border-0 sticky-top" style="top: 40px;">
        <div class="row mb-2 container">
            <div class="col-12">
                <h6 class="text-center">Admin 1</h6>
            </div>
        </div>

        <div class="card-body sidebar pb-2">
            <Link href="/admin" class="d-block py-2 px-3 rounded text-decoration-none mb-2"
                :class="{ active: activePage === 'admin' }">
            <i class="fa-duotone fa-layer-group me-2"></i>Dashboard
            </Link>
            <Link href="/user" class="d-block py-2 px-3 rounded text-decoration-none mb-2"
                :class="{ active: activePage === 'user' }">
            <i class="fa-duotone fa-users me-2"></i>User
            </Link>
            <Link href="/comic" class="d-block py-2 px-3 rounded text-decoration-none mb-2" :class="{ active: activePage === 'comic' }">
            <i class="fad fa-books me-2"></i>Comic
            </Link>
        </div>

        <div class="card-footer">
            <Link href="/useradmin" class="d-block py-2 px-3 rounded text-decoration-none text-dark mb-2">
            <i class="fad fa-user me-2"></i>Admin
            </Link>
            <Link href="" class="d-block py-2 px-3 rounded text-decoration-none text-dark mb-2">
            <i class="fa-duotone fa-door-open me-2"></i>Sign Out
            </Link>
        </div>
    </div>
    <!-- end sidebar -->
    <slot></slot>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const activePage = computed(() => {
    return window.location.pathname.split('/')[1]
})
</script>


