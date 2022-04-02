
<script setup>
import { ref } from 'vue';

defineProps({

})

const isOpen = ref(false)


</script>

<template>
    <div class="relative inline-block">
        <!-- Dropdown toggle button -->
        <svg
            @click="isOpen = !isOpen"
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 text-gray-700 cursor-pointer"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
            />
        </svg>

        <!-- Dropdown menu -->
        <div
            v-show="isOpen"
            class="absolute right-0 z-20 w-48 py-2 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-800"
        >
            <slot></slot>
        </div>
    </div>
</template>