<script setup>

defineProps({
    active: Boolean
})

</script>


<template>
    <Link class="text-white hover:underline" :class="{ 'font-bold ': active }">
    <slot />
    </link>
</template>