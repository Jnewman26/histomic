<template>
    <div class="container">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border- top">
            <div class="col mb-3">
                <a href="/"
                    class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none font-bangers fs-1">
                    Histomic
                </a>
                <p class="text-body-secondary">© 2023</p>
            </div>

            <div class="col mb-3">

            </div>

            <div class="col mb-3">
                <h5>Useful Links</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="index.php" class="nav-link p-0 text-body-secondary">Home</a></li>
                    <li class="nav-item mb-2"><a href="comics.php" class="nav-link p-0 text-body-secondary">Comics</a></li>
                    <li class="nav-item mb-2"><a href="genres.php" class="nav-link p-0 text-body-secondary">Genres</a></li>
                </ul>
            </div>

            <div class="col mb-3">
                <h5>Genres</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Action</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Fantasy</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Adventrue</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Mystery</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Superhero</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Romance</a></li>
                </ul>
            </div>

            <div class="col mb-3">
                <h5>Payment</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <img src="@/Assets/Images/payment/bca.png" alt="" class="img-fluid w-25 mx-2 mb-3">
                        <img src="@/Assets/Images/payment/gopay.png" alt="" class="img-fluid w-25 mx-2 mb-3">
                        <img src="@/Assets/Images/payment/visa.png" alt="" class="img-fluid w-25 mx-2 mb-3">
                        <img src="@/Assets/Images/payment/mastercard.png" alt="" class="img-fluid w-25 mx-2 mb-3">
                        <img src="@/Assets/Images/payment/qris.png" alt="" class="img-fluid w-25 mx-2 mb-3">
                        <img src="@/Assets/Images/payment/jcb.webp" alt="" class="img-fluid w-25 mx-2 mb-3">
                    </li>
                </ul>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>