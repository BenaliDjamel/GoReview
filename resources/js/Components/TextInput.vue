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
        class="mt-1 px-4 py-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        type="text"
        name="title"
        id="title"
    />
</template>
