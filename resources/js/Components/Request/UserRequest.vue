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
    <div class="col-span-5">
        <div class="p-6 bg-white shadow-md rounded-lg">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <p class="text-sm text-gray-700">
                        Asked
                        <span class="ml-1 text-gray-900">{{ request.created_at }}</span>
                    </p>
                    <span
                        v-if="request.closed"
                        class="ml-4 px-2.5 py-1 rounded-full text-white text-sm bg-green-600"
                    >Closed</span>
                </div>

                <div class="relative inline-block">
                    <!-- Dropdown toggle button -->
                    <svg
                        @click="dropdown = !dropdown"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-gray-700 cursor-pointer"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                        />
                    </svg>

                    <!-- Dropdown menu -->
                    <div
                        v-show="dropdown"
                        class="absolute right-0 z-20 w-48 py-2 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-800"
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

            <div class="mt-8">
                <a
                    :href="`/request/${request.id}`"
                    class="text-sm sm:text-xl text-gray-900 sm:text-gray-800"
                >{{ request.title }}</a>
            </div>
            <div class="mt-6 p-4 bg-gray-50">
                <div class="text-gray-800 text-base tracking-wide leading-8 font-normal">
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

            <div class="mt-6">
                <span class="text-gray-700 text-base">Link :</span>
                <a class="text-blue-900 break-all" :href="request.link">{{ request.link }}</a>
            </div>

            <div class="mt-8 flex">
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
                <span class="ml-2 text-gray-800">{{ numberOfReviews }} review(s)</span>
            </div>
        </div>
    </div>
</template>