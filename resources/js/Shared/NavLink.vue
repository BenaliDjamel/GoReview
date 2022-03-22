<script setup>

defineProps({
    active: Boolean
})

</script>


<template>
    <Link class="text-black hover:underline" :class="{ 'font-bold underline': active }">
    <slot />
    </link>
</template>