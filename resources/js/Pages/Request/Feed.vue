<script setup>
import DropDown from "@/Shared/DropDown.vue";
import TopCommunities from "@/Components/Community/TopCommunities.vue";
import ReviewsCount from "@/Components/Review/ReviewsCount.vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import Pagination from "@/Shared/Pagination.vue";

import { Link } from "@inertiajs/inertia-vue3";
import RequestContent from "@/Components/Request/RequestContent.vue";
import DropdownButton from "@/Components/DropdownButton.vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    requests: Object,
    communities: Array,
    hotRequests: Array,
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
    <div class="grid grid-cols-8 gap-6">
        <div class="col-span-8 md:col-span-5 lg:col-span-6">
            <template v-if="requests.data.length">
                <div class="grid grid-flow-row gap-8">
                    <div
                        v-for="request in requests.data"
                        :key="request.id"
                        class="p-6 max-w-4xl bg-white shadow-md rounded-lg"
                    >
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <button
                                    v-if="request.closed"
                                    class="px-2.5 py-1 rounded-full text-white text-sm bg-green-600"
                                >
                                    Closed
                                </button>
                            </div>

                            <DropDown
                                v-if="
                                    $page.props.auth.user?.id ===
                                    request.user.id
                                "
                            >
                                <DropdownButton
                                    :href="route('request.edit', request.id)"
                                >
                                    Edit Request
                                </DropdownButton>

                                <DropdownButton @click="destroy(request.id)">
                                    Delete Request
                                </DropdownButton>

                                <DropdownButton
                                    @click="closeRequest(request.id)"
                                    v-if="
                                        !request.closed &&
                                        request.reviews.length
                                    "
                                >
                                    Close Request
                                </DropdownButton>

                                <DropdownButton v-if="!request.closed">
                                    Invite Reviewer
                                </DropdownButton>
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
                                        <span class="ml-1">{{
                                            request.created_at
                                        }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center">
                            <div class="bg-gray-200 px-2 py-1 rounded-full">
                                <Link
                                    :href="
                                        route(
                                            'community.feed',
                                            request.community.id
                                        )
                                    "
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
                </div>
                <Pagination :links="requests.links" class="mt-6" />
            </template>
            <template v-else>
                <div class="mt-6 text-gray-700 text-2xl text-center">
                    There is no requests
                    <Link
                        :href="route('request.create')"
                        class="text-base font-medium underline text-blue-700"
                        >Create one?</Link
                    >
                </div>
            </template>
        </div>

        <div
            class="p-4 hidden md:col-span-3 lg:col-span-2 md:block h-fit bg-white shadow rounded-lg"
        >
            <div class="mb-4 p-4 rounded-lg text-center text-white bg-cyan-600">
                <h1>Top Communities</h1>
            </div>
            <template v-if="communities.length">
                <div class="flex flex-col">
                    <TopCommunities
                        v-for="community in communities"
                        :community="community"
                        :key="community.id"
                    />
                </div>

                <div
                    class="mt-6 py-2 text-center bg-gray-50 border border-cyan-600 rounded-lg hover:bg-cyan-600 hover:text-white"
                >
                    <Link :href="route('community.index')" class="text-gray-900"
                        >View all</Link
                    >
                </div>
            </template>
            <template v-else>
                <div class="mt-6 text-gray-700 text-lg text-center">
                    There is no communities
                </div>
            </template>
            <div class="mt-6 py-2 text-center bg-gray-200 rounded-lg">
                <Link :href="route('community.create')" class="text-gray-900"
                    >Create community</Link
                >
            </div>

            <div
                v-if="hotRequests.length"
                class="mt-8 mb-6 font-medium p-4 rounded-lg text-center text-white bg-gray-700"
            >
                Hot Network Requests
            </div>
            <ul>
                <li
                    v-for="hotRequest in hotRequests"
                    :key="hotRequest.id"
                    class="mb-4 text-xs font-semibold text-gray-600 hover:underline"
                >
                    <Link :href="route('request.view', hotRequest.id)">{{
                        hotRequest.title
                    }}</Link>
                </li>
            </ul>
        </div>
    </div>
</template>
