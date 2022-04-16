<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { computed, onMounted, ref } from "vue";
import DropDown from "@/Shared/DropDown.vue";
import ReviewsCount from "../Review/ReviewsCount.vue";

const props = defineProps({
    request: Object,
    can: Object,
});

const numberOfReviews = computed(() => {
    return props.request.reviews.length;
});

const destroy = (requestId) => {
    if (confirm("Are you sure you want to delete this request?")) {
        Inertia.delete(route("request.delete", requestId));
    }
};

const closeRequest = (requestId) => {
    if (confirm("Are you sure you want to close this request?")) {
        Inertia.put(route("request.close", requestId));
    }
};
</script>

<template>
    <div class="col-span-5">
        <div class="p-6 bg-white shadow-md rounded-lg">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <p class="text-sm text-gray-700">
                        Asked
                        <span class="ml-1 text-gray-900">{{
                            request.created_at
                        }}</span>
                    </p>
                    <span
                        v-if="request.closed"
                        class="ml-4 px-2.5 py-1 rounded-full text-white text-sm bg-green-600"
                        >Closed</span
                    >
                </div>

                <DropDown>
                    <Link
                        v-if="can.edit_request"
                        as="button"
                        :href="route('request.edit', props.request.id)"
                        class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                        >Edit Request</Link
                    >
                    <button
                        @click="destroy(request.id)"
                        v-if="can.delete_request"
                        class="text-left block w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white cursor-pointer"
                    >
                        Delete Request
                    </button>
                    <Link
                        as="button"
                        v-if="!request.closed"
                        class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                        >Invite Reviewer</Link
                    >
                    <button
                        @click="closeRequest(request.id)"
                        v-if="
                            !request.closed &&
                            can.close_request &&
                            numberOfReviews
                        "
                        class="text-left block w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                    >
                        Close Request
                    </button>
                </DropDown>
            </div>

            <div class="mt-8">
                <p class="text-sm sm:text-xl text-gray-900">
                    {{ request.title }}
                </p>
            </div>
            <div class="mt-6 bg-gray-50">
                <div class="text-gray-800 tracking-wide">
                    <QuillEditor
                        class="overflow-x-auto"
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
                <a class="text-blue-900 break-all" :href="request.link">{{
                    request.link
                }}</a>
            </div>

            <div class="mt-8 flex">
                <ReviewsCount :request="request" />
            </div>
        </div>
    </div>
</template>
