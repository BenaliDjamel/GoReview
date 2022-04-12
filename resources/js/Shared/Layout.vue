<script setup>
import Navbar from "./Navbar.vue";
import { Link } from '@inertiajs/inertia-vue3'


</script>

<template>
 
  <section class="px-20 py-4 bg-gray-700">
    <header class="container flex-none hidden sm:flex justify-between">
      <div class="flex items-center">
        <Link href="/feed" class="font-bold text-white text-lg">
          GoReview  
        </Link>
      </div>

      <Navbar  />
    </header>
  </section>
    <section class="" >
        <div class="container mx-auto p-10">
            <slot />
        </div>
    </section>
</template>