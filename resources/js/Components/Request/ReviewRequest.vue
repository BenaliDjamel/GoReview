<script setup>
import { QuillEditor } from '@vueup/vue-quill'



const props = defineProps({
    review: Object
})
</script>

<template>
    <div class="md:max-w-4xl mb-6 bg-white rounded-lg shadow-md overflow-hidden dark:bg-gray-800">
        <div class="p-6">
            <div class="mt-2 text-sm bg-gray-50 dark:text-gray-400">
                <QuillEditor
                    class="language-plaintext"
                    :toolbar="[]"
                    theme
                    :readOnly="true"
                    contentType="html"
                    :content="props.review.content"
                />
            </div>

            <div class="mt-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <img
                                class="object-cover h-10 rounded-full"
                                src="https://images.unsplash.com/photo-1586287011575-a23134f797f9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=48&q=60"
                                alt="Avatar"
                            />
                            <a
                                href="#"
                                class="mx-2 font-semibold text-gray-700 dark:text-gray-200"
                            >{{ props.review.user.name }}</a>
                        </div>
                        <span
                            class="mx-1 text-xs text-gray-600 dark:text-gray-300"
                        >{{ props.review.created_at }}</span>
                    </div>
                    <div
                        class="flex flex-col items-center text-gray-400 px-2 rounded cursor-pointer"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                            />
                        </svg>
                        <span class="text-center">67</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>