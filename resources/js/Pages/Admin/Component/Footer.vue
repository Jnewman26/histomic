<template>
    <div class="">
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <p class="col-md-4 mb-0 text-muted">© 2023 Histomic, Inc</p>

                <a href="/"
                    class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-md-4 justify-content-end">
                    <li class="nav-item"><Link href="/admin" class="nav-link px-2 text-muted">Dashboard</Link></li>
                    <li class="nav-item"><Link href="/user" class="nav-link px-2 text-muted">User</Link></li>
                    <li class="nav-item"><Link href="#" class="nav-link px-2 text-muted">Pricing</Link></li>
                    <li class="nav-item"><Link href="#" class="nav-link px-2 text-muted">FAQs</Link></li>
                    <li class="nav-item"><Link href="#" class="nav-link px-2 text-muted">About</Link></li>
                </ul>
            </footer>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>