<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Link } from '@inertiajs/inertia-vue3'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { computed, onMounted, ref } from 'vue';


const dropdown = ref(false)


const props = defineProps({
    request: Object,
})


const numberOfReviews = computed(() => {
    return props.request.reviews.length
})


</script>


<template>
    <div   class="mb-8">
        <div class="md:max-w-4xl px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <span
                        class="text-sm font-light text-gray-600 dark:text-gray-400"
                    >{{ request.created_at }}</span>

                    <span
                        v-if="request.closed"
                        class="text-sm ml-6 p-1.5 bg-green-600 rounded-full text-white dark:text-gray-400"
                    >Closed</span>
                </div>

                <div class="flex items-center justify-center">
                    <div class="relative inline-block">
                        <!-- Dropdown toggle button -->
                        <button
                            @click="dropdown = !dropdown"
                            class="relative z-10 block p-2 text-gray-700 bg-gray-100 border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none"
                        >
                            <svg
                                class="w-5 h-5 text-gray-800 dark:text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div
                            v-show="dropdown"
                            class="absolute right-0 z-20 w-48 py-2 bg-white rounded-md shadow-xl dark:bg-gray-800"
                        >
                            <Link
                                as="button"
                                :href="`/request/${props.request.id}/edit`"
                                class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                            >Edit Request</Link>
                            <Link
                                as="button"
                                method="delete"
                                :href="route('request.delete', props.request.id)"
                                class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white cursor-pointer"
                            >Delete Request</Link>
                            <a
                                v-if="!request.closed"
                                href="#"
                                class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                            >Invite Reviewer</a>
                            <Link
                                v-if="!request.closed && numberOfReviews"
                                as="button"
                                method="put"
                                :href="route('request.close', props.request.id)"
                                class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                            >Close Request</Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <Link
                    :href="`/request/${request.id}`"
                    class="text-2xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline"
                >{{ request.title }}</Link>

                <div class="mt-6 bg-gray-50">
                    <QuillEditor
                        class="language-plaintext"
                        :toolbar="[]"
                        theme
                        :readOnly="true"
                        contentType="html"
                        :content="request.content"
                    />
                </div>
            </div>

            <div class="mt-4">
                Link :
                <a :href="request.link" class="text-blue-600">{{ request.link }}</a>
            </div>

            <div class="flex items-center justify-between mt-6">
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
                    >{{ numberOfReviews }} review(s)</a>
                </div>
            </div>
        </div>
    </div>
</template>