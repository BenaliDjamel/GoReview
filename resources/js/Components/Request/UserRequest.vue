<script setup>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { computed } from 'vue';

const props = defineProps({
    'request': Object
})

const comments = computed(() => {
    return props.request.comments.length
})

</script>


<template>
    <div class="mb-8">
        <div class="md:max-w-2xl px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <span
                    class="text-sm font-light text-gray-600 dark:text-gray-400"
                >{{ props.request.created_at }}</span>
                <a
                    class="px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-200 transform bg-gray-600 rounded cursor-pointer hover:bg-gray-500"
                >Design</a>
            </div>

            <div class="mt-8">
                <a
                    href="#"
                    class="text-2xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline"
                >Accessibility tools for designers and developers</a>
                <div class="mt-6">
                    <QuillEditor
                        theme="snow"
                        contentType="html"
                        toolbar="essential"
                        :readOnly="true"
                        :content="props.request.content"
                    />
                </div>
            </div>

            <div class="mt-4">
                Link :
                <a :href="props.request.link" class="text-blue-600">{{ props.request.link }}</a>
            </div>

            <div class="flex items-center justify-between mt-4">
                <div class="flex items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-gray-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                        />
                    </svg>

                    <a
                        class="ml-2 text-gray-700 cursor-pointer dark:text-gray-200"
                    >{{ comments }} answers</a>
                </div>
            </div>
        </div>
    </div>
</template>