<script setup>
import { } from "@/Shared/Navbar.vue";
import Navbar from "./Navbar.vue";

</script>

<template>
 
  <section class="px-20 py-4 bg-sky-900">
    <header class="container flex-none hidden sm:flex justify-between">
      <div class="flex items-center">
        <h1 class="font-bold text-white text-lg">
          GoReview  
        </h1>
      </div>

      <Navbar  />
    </header>
  </section>
    <section class=" bg-gray-100" >
        <div class="container mx-auto p-6">
            <slot />
        </div>
    </section>
</template>