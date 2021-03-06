<script setup>
import DropDown from "@/Shared/DropDown.vue";
import { Inertia } from "@inertiajs/inertia";
import ReviewsCount from "../Review/ReviewsCount.vue";
import { QuillEditor } from "@vueup/vue-quill";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    request: Object,
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
    <div class="p-6 max-w-4xl bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <button
                    v-if="request.closed"
                    class="px-2.5 py-1 rounded-full text-white text-sm bg-green-600"
                >
                    Closed
                </button>
            </div>

            <DropDown v-if="$page.props.auth.user?.id === request.user.id">
                <Link
                    as="button"
                    :href="route('request.edit', request.id)"
                    class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                    >Edit Request</Link
                >
                <button
                    @click="destroy(request.id)"
                    class="text-left block w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white cursor-pointer"
                >
                    Delete Request
                </button>
                <Link
                    v-if="!request.closed"
                    as="button"
                    class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                    >Invite Reviewer</Link
                >
                <button
                    @click="closeRequest(request.id)"
                    v-if="!request.closed && request.reviews.length"
                    class="text-left block w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    Close Request
                </button>
            </DropDown>
        </div>

        <div class="mt-8">
            <Link
                :href="route('request.view', request.id)"
                class="text-sm sm:text-xl text-gray-900 over:underline hover:underline-offset-8"
                >{{ request.title }}</Link
            >
        </div>
        <div class="mt-6 bg-gray-50">
            <div class="text-gray-800 tracking-wide">
                <QuillEditor
                    class="overflow-x-auto text-xs"
                    :toolbar="[]"
                    theme
                    :readOnly="true"
                    contentType="html"
                    :content="request.content"
                />
            </div>
        </div>
        <div class="mt-6">
            <div class="flex justify-end items-center">
                <img
                    class="object-cover h-10 rounded-full"
                    src="https://images.unsplash.com/photo-1586287011575-a23134f797f9?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=48&amp;q=60"
                    alt="Avatar"
                />
                <div class="flex flex-col mx-2">
                    <a
                        href="#"
                        class="font-semibold text-gray-800 tracking-normal dark:text-gray-200 cursor-pointer"
                        >{{ request.user.name }}</a
                    >
                    <p class="text-xs text-gray-500">
                        asked
                        <span class="ml-1">{{ request.created_at }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center">
            <div class="bg-gray-200 px-2 py-1 rounded-full">
                <Link
                    :href="route('community.feed', request.community.id)"
                    class="text-gray-700"
                >
                    review/
                    <span class="text-gray-900 font-semibold">{{
                        request.community.name
                    }}</span>
                </Link>
            </div>

            <div class="ml-4 flex items-center">
                <ReviewsCount :request="request" />
            </div>
        </div>
    </div>
</template>
