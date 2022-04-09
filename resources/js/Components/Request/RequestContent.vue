<script setup>
import DropDown from '@/Shared/DropDown.vue';
import ReviewsCount from '../Review/ReviewsCount.vue';
import { QuillEditor } from '@vueup/vue-quill'
import { Link } from '@inertiajs/inertia-vue3'


const props = defineProps({
    request: Object,
})


</script>

<template>
    <div class="p-6 max-w-4xl bg-white shadow-md rounded-lg">
        <div class="flex  justify-between items-center">
            <div class="flex items-center">
                <button
                    v-if="request.closed"
                    class="px-2.5 py-1 rounded-full text-white text-sm bg-green-600"
                >Closed</button>
            </div>

            <DropDown>
                <Link
                    as="button"
                    :href="`/request/${request.id}/edit`"
                    class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                >Edit Request</Link>
                <Link
                    as="button"
                    method="delete"
                    :href="route('request.delete', request.id)"
                    class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white cursor-pointer"
                >Delete Request</Link>
                <a
                    v-if="!request.closed"
                    href="#"
                    class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                >Invite Reviewer</a>
                <Link
                    v-if="!request.closed && 1"
                    as="button"
                    method="put"
                    :href="route('request.close', request.id)"
                    class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                >Close Request</Link>
            </DropDown>
        </div>

        <div class="mt-8">
            <Link
                :href="`/request/${request.id}`"
                class="text-sm sm:text-xl text-gray-900 sm:text-gray-800"
                href="#"
            >{{ request.title }}</Link>
        </div>
        <div class="mt-6 p-4 overflow-x-auto  bg-gray-50">
            <div class="text-gray-800  tracking-wide leading-8 font-normal">
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
                    >{{ request.user.name }}</a>
                    <p class="text-xs text-gray-500">
                        asked
                        <span class="ml-1">{{ request.created_at }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center">
            <div class="bg-gray-200 px-2 py-1 rounded-full">
                <a class="text-gray-700" href="#">
                    review/
                    <span class="text-cyan-900">{{ request.community.name }}</span>
                </a>
            </div>

            <div class="ml-4 flex items-center">
                <ReviewsCount :request="request" />
            </div>
        </div>
    </div>
</template>