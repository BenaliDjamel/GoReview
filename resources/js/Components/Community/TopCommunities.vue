
<script setup>
import { Link } from '@inertiajs/inertia-vue3'



defineProps({
    community: Object
})
</script>

<template>
    <div class="p-2 border flex justify-between items-center">
        <Link class="rounded text-gray-800" :href="route('community.feed', community.id)">
            review/
            <span>{{ community.name }}</span>
        </Link>
        <span class="p-2 bg-gray-200 text-xs text-gray-700 rounded-full">{{community.requests_count}}</span>
    </div>
</template>