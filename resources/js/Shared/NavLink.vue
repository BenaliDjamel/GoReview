<script setup>

defineProps({
    active: Boolean
})

</script>


<template>
    <Link class="text-white" :class="{'font-bold underline underline-offset-8': active}">
    <slot />
    </link>
</template>