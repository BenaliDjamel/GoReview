<script setup>
defineProps({
    communities: Array
})

</script>

<template>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div v-for="community in communities" class="p-4 bg-white rounded-lg shadow-lg">
            <a
                class="px-4 py-1.5 bg-gray-200 text-gray-700 rounded-full"
                href="#"
            >{{ community.name }}</a>
            <div class="mt-4">
                <p class="text-gray-700 tracking-wide leading-6">{{ community.description }}</p>
            </div>

            <div class="mt-3">
                <p class="text-gray-500 text-sm">{{ community.requests_count }} requests published</p>
            </div>
        </div>
    </div>
</template>