<template>
    <!-- wrap -->
    <section id="wrap" class="container-fluid">
        <div class="col-12 mt-4">
            <div class="row">

                <div class="col-2 d-none d-xl-block">
                    <!-- sidebar -->
                    <slot name="sidebar" />
                    <!-- end sidebar -->
                </div>
                <div class="col-xl-10 col-lg-12">
                    <!-- main -->
                    <slot name="main" />
                    <!-- end main -->
                </div>
                
            </div>
        </div>
    </section>
    <!-- end wrap -->
</template>