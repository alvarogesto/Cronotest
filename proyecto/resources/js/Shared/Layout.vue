<script>
import Navbar from "./Navbar.vue";
import Footer from "./Footer.vue";

export default {
    components: { Navbar, Footer }
};

</script>

<template>

    <section class="flex flex-col justify-between min-h-screen font-mono bg-custom-black background">
        <header>
            <Navbar></Navbar>
        </header>

        <section class="flex justify-center items-center text-custom-white">
            <slot></slot>
        </section>

        <footer>
            <Footer></Footer>
        </footer>
    </section>
    
</template>

<style>
.background {
    background-image: url(../../../public/img/rejilla.svg);
}
</style>