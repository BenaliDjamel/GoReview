<script setup>
import ReviewsCount from "@/Components/Review/ReviewsCount.vue";
import { Inertia } from "@inertiajs/inertia";
import DropDown from "@/Shared/DropDown.vue";
import DropdownButton from "@/Components/DropdownButton.vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    requests: Array,
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
    <section>
        <template v-if="requests.length">
            <div class="grid grid-cols-6 gap-4">
                <div
                    v-for="request in requests"
                    :request="request"
                    class="col-span-5"
                >
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
                                <DropdownButton
                                    :href="route('request.edit', request.id)"
                                >
                                    Edit Request
                                </DropdownButton>

                                <DropdownButton
                                    @click="destroy(request.id)"
                                    v-if="!request.closed"
                                >
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
                                class="text-sm sm:text-xl text-gray-900 hover:underline hover:underline-offset-8"
                                >{{ request.title }}</Link
                            >
                        </div>
                        <div class="mt-6 p-4 bg-gray-50">
                            <div
                                class="text-gray-800 text-base tracking-wide leading-8 font-normal"
                            >
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
                            <a
                                class="text-blue-900 break-all"
                                :href="request.link"
                                >{{ request.link }}</a
                            >
                        </div>

                        <div class="mt-8 flex">
                            <ReviewsCount :request="request" />
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template v-else>
            <div class="mt-6 text-2xl text-center text-gray-700">
                You don't have requests
            </div>
        </template>
    </section>
</template>
