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
    <section class="p-6 bg-gray-100" >
        <div class="">
            <slot />
        </div>
    </section>
</template>