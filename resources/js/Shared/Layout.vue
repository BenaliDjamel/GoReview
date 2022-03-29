<script setup>
import { } from "@/Shared/Navbar.vue";
import Navbar from "./Navbar.vue";

</script>

<template>
 
  <section class="p-4 bg-gray-800">
    <header class="flex justify-between">
      <div class="flex items-center">
        <h1 class="font-bold text-white text-lg">
          My App
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