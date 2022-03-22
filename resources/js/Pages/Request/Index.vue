<script setup>
import { Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
    requests: Array
})

</script>

<template>
    <ul>
        <li v-for="request in requests" :key="request.id">{{ request.created_at }}</li>
    </ul>
</template>