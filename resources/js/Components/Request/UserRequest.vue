<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { computed, onMounted, ref } from 'vue';
import DropDown from "@/Shared/DropDown.vue";
import ReviewsCount from "../Review/ReviewsCount.vue";

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

                <DropDown>
                    <Link
                        as="button"
                        :href="route('request.edit', props.request.id)"
                        class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                    >Edit Request</Link>
                    <Link
                        as="button"
                        method="delete"
                        :href="route('request.delete', props.request.id)"
                        class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white cursor-pointer"
                    >Delete Request</Link>
                    <Link as="button"
                        v-if="!request.closed"
                        href="#"
                        class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                    >Invite Reviewer</Link>
                    <Link
                        v-if="!request.closed && numberOfReviews"
                        as="button"
                        method="put"
                        :href="route('request.close', props.request.id)"
                        class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                    >Close Request</Link>
                </DropDown>
            </div>

            <div class="mt-8">
                <Link
                :href="route('request.view', request.id)"
                    class="text-sm sm:text-xl text-gray-900 sm:text-gray-800"
                >{{ request.title }}</Link>
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
                <ReviewsCount :request="request"/>
            </div>
        </div>
    </div>
</template>