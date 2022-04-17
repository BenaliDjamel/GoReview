<script setup>
import Navbar from "./Navbar.vue";
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <section class="py-6 gradient">
        <header
            class="container px-3 mx-auto flex-none hidden sm:flex justify-between"
        >
            <div class="flex items-center">
                <Link href="/feed" class="font-bold text-white text-2xl">
                    GoReview
                </Link>
            </div>

            <Navbar />
        </header>
    </section>
    <section class="">
        <div class="container mx-auto p-10">
            <slot />
        </div>
    </section>
</template>

<style>
.gradient {
    background: linear-gradient(90deg, #3a86ff 0%, #776de2 100%);
}
</style>
