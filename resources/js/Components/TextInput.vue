<script setup>
defineProps({
    error: String,
    modelValue: String,
});

defineEmits(["update:modelValue"]);
</script>

<template>
    <input
        :class="{ 'border-red-600': error }"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="mt-1 px-4 py-2 w-full text-gray-700 bg-white rounded border focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
        type="text"
        name="title"
        id="title"
    />
</template>
