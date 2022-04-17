<script setup>

defineProps({
    active: Boolean
})

</script>


<template>
    <Link class="text-white font-semibold text-base hover:underline hover:underline-offset-8 hover:decoration-black hover:decoration-2" :class="{'font-bold underline underline-offset-8 decoration-2 tracking-wider': active}">
    <slot />
    </link>
</template>