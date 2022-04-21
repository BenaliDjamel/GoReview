<script setup>
defineProps({
    href: {
        type: String,
        default: ''
    },

});
</script>

<template>
    <Link
        as="button"
        :href="href"
        class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
    >
        <slot />
    </Link>
</template>
