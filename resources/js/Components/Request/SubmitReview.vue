<script setup>
import { QuillEditor } from '@vueup/vue-quill'




</script>

<template>
    <div class="p-6 md:max-w-4xl mb-6 bg-white rounded-lg shadow-md">
        <h2 class="font-semibold text-gray-700 dark:text-gray-200">Your Review</h2>
        <div class="mt-4 text-sm sm:h-24 md:h-36 dark:text-gray-400">
            <QuillEditor
                toolbar="essential"
                theme="snow"
                content="Your reviw goes here!"
                contentType="html"
            />
        </div>
        <button
            class="px-4 py-2 mt-4 sm:mt-12 font-medium text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80"
        >Submit</button>
    </div>
</template>