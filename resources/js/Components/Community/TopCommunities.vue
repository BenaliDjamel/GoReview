
<script setup>

defineProps({
    community: Object
})
</script>

<template>
    <div class="p-2 border flex justify-between items-center">
        <a class="rounded text-gray-800" href="#">
            review/
            <span>{{ community.name }}</span>
        </a>
        <span class="p-2 bg-gray-200 text-xs text-gray-700 rounded-full">{{community.requests_count}}</span>
    </div>
</template>