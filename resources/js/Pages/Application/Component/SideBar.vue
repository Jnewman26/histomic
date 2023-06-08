<template>
    <!-- sidebar -->
    <div class="card shadow pt-4 border-0 sticky-top" style="top: 40px;">
        <div class="row mb-2 container">
            <div class="col-3">
                <img src="@/Assets/Images/profile.png" alt="" class="img-fluid bg-danger rounded p-1 ms-3">
            </div>
            <div class="col-9">
                <h6 class="mt-1 text-truncate">{{ USER_NAME }}</h6>
                <!-- {{ USER_NAME.split(' ')[0] }} -->
            </div>
        </div>

        <div class="card-body sidebar pb-2">
            <Link href="/dashboard" class="d-block py-2 px-3 rounded text-decoration-none mb-2"
                :class="{ active: activePage === 'dashboard' }">
            <i class="fa-duotone fa-layer-group me-2"></i>Dashboard
            </Link>
            <a href="/wishlist" class="d-block py-2 px-3 rounded text-decoration-none mb-2"
            :class="{ active: activePage === 'wishlist' }">
                <i class="fad fa-heart me-2"></i>Wishlist
            </a>
            <Link href="/libraryreader" class="d-block py-2 px-3 rounded text-decoration-none mb-2"
            :class="{ active: activePage === 'libraryreader' }">
            <i class="fad fa-books me-2"></i>Library Reader
            </Link>
            <Link href="/librarywriter" class="d-block py-2 px-3 rounded text-decoration-none mb-2"
            :class="{ active: activePage === 'librarywriter' }">
            <i class="fad fa-feather me-2"></i>Library Writer
            </Link>
        </div>

        <div class="card-footer">
            <Link href="/profile" class="d-block py-2 px-3 rounded text-decoration-none text-dark mb-2">
            <i class="fad fa-user me-2"></i>Profile
            </Link>
            <Link href="/logout" method="post" class="d-block py-2 px-3 rounded text-decoration-none text-dark mb-2">
            <i class="fa-duotone fa-door-open me-2"></i>Sign Out
            </Link>
        </div>
    </div>
    <!-- end sidebar -->
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const activePage = computed(() => {
    return window.location.pathname.split('/')[1]
})
</script>

<script>
export default {
    computed: {
        auth() {
            return this.$page.props.auth;
        },
        USER_ID() {
            return this.auth ? this.auth.USER_ID : null;
        },
        USER_NAME() {
            return this.auth ? this.auth.USER_NAME : null;
        }
    }
}
</script>