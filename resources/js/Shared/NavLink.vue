<script setup>

defineProps({
    active: Boolean
})

</script>


<template>
    <Link class="text-white" :class="{'font-bold underline underline-offset-8 tracking-wider': active}">
    <slot />
    </link>
</template>