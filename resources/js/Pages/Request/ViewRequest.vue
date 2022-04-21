<script setup>
import BreezeButton from "@/Components/Button.vue";
import UserRequest from "@/Components/Request/UserRequest.vue";
import ReviewRequest from "@/Components/Request/ReviewRequest.vue";
import ReviewsCount from "@/Components/Review/ReviewsCount.vue";
import DropdownButton from "@/Components/DropdownButton.vue";
import LikeIcon from "@/Components/LikeIcon.vue";
import { computed, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

import DropDown from "@/Shared/DropDown.vue";

const props = defineProps({
    request: Object,
    can_request: Object,
    errors: Object,
});

const editor = ref();

const form = useForm({
    content: "",
});

const numberOfReviews = computed(() => {
    const reviews = props.request.reviews;

    return reviews.length > 0
        ? `Your Request has ${reviews.length} Review(s)`
        : "No Reviews for this Request";
});

const notMyRequest = computed(() => {
    const userId = usePage().props.value.auth.user.id;
    return userId !== props.request.user_id;
});

const submit = () => {
    form.post(route("review.store", props.request.id), {
        onSuccess: () => editor.value.setHTML(""),
        preserveScroll: true,
    });
};

/* const numberOfReviews = computed(() => {
    return props.request.reviews.length;
}); */

const destroy = (requestId) => {
    if (confirm("Are you sure you want to delete this request?")) {
        Inertia.delete(route("request.delete", requestId));
    }
};

const closeRequest = (requestId) => {
    if (confirm("Are you sure you want to close this request?")) {
        Inertia.put(route("request.close", requestId), );
    }
};
</script>

<template>
    <div class="">
        <!-- start main section  -->
        <section>
            <div class="grid grid-cols-6">
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

                            <DropDown ref="">
                                <DropdownButton
                                    v-if="can_request.edit_request"
                                    :href="route('request.edit', request.id)"
                                >
                                    Edit Request
                                </DropdownButton>

                                <DropdownButton
                                    @click="destroy(request.id)"
                                    v-if="can_request.delete_request"
                                >
                                    Delete Request
                                </DropdownButton>

                                <DropdownButton
                                    @click="closeRequest(request.id)"
                                    v-if="
                                        !request.closed &&
                                        can_request.close_request &&
                                        numberOfReviews
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
            <div
                v-if="!request.closed && notMyRequest"
                class="grid grid-cols-6"
            >
                <div
                    class="mt-6 p-6 mb-4 col-span-5 bg-white rounded-lg shadow-md"
                >
                    <h2 class="font-semibold text-gray-700 dark:text-gray-200">
                        Your Review
                    </h2>
                    <form @submit.prevent="submit">
                        <div
                            class="mt-4 text-sm sm:h-24 md:h-36 dark:text-gray-400"
                        >
                            <QuillEditor
                                ref="editor"
                                toolbar="essential"
                                theme="snow"
                                contentType="html"
                                v-model:content="form.content"
                            />
                            <div v-if="errors.content" class="text-red-500">
                                {{ errors.content }}
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <BreezeButton
                                class="mt-6 sm:mt-12"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Submit
                            </BreezeButton>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-4 mb-6 text-xl">{{ numberOfReviews }}</div>
            <div class="grid grid-cols-6 gap-y-6">
                <ReviewRequest
                    v-for="review in request.reviews"
                    :review="review"
                />
            </div>
        </section>
        <!-- end main section -->
    </div>
</template>
