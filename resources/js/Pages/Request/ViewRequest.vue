<script setup>
import UserRequest from "@/Components/Request/UserRequest.vue";
import ReviewRequest from "@/Components/Request/ReviewRequest.vue";
import { computed, ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { QuillEditor } from "@vueup/vue-quill";

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

const submit = () => {
    form.post(route("review.store", props.request.id), {
        onSuccess: () => editor.value.setHTML(""),
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="">
        <!-- start main section  -->
        <section>
            <div class="grid grid-cols-6">
                <UserRequest :request="request" :can="can_request" />
            </div>
            <div v-if="!request.closed" class="grid grid-cols-6">
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
                            <button
                                type="submit"
                                class="px-4 py-2 mt-4 sm:mt-12 font-medium text-white transition-colors duration-200 transform bg-sky-900 text-xs leading-tight uppercase rounded shadow-md hover:bg-sky-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg ease-in-out"
                            >
                                Submit
                            </button>
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
