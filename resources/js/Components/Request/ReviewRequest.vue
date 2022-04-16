<script setup>
import BreezeButton from "@/Components/Button.vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { QuillEditor } from "@vueup/vue-quill";
import { computed, ref } from "vue";
import DropDown from "@/Shared/DropDown.vue";

const props = defineProps({
    review: Object,
});

const edit = ref(false);
const dropdown = ref(false);

const form = useForm({
    content: props.review.content,
});

const editReview = () => {
    edit.value = !edit.value;
    dropdown.value = false;
};

const submit = () => {
    form.put(
        route("review.update", {
            id: props.review.id,
            requestId: props.review.request_id,
        }),
        {
            onSuccess: () => {
                edit.value = false;
            },
            preserveScroll: true,
        }
    );
};

const likeReview = () => {
    Inertia.post(route("like.store", { id: props.review.id }), _, {
        preserveScroll: true,
    });
};

const unlikeReview = () => {
    Inertia.delete(route("like.delete", { id: props.review.id }), {
        preserveScroll: true,
    });
};

const isLikedByAuthUser = computed(() => {
    const likes = props.review.likes;
    const userId = usePage().props.value.auth.user.id;
    return likes.filter((obj) => obj.user_id === userId).length;
});

const likeCounts = computed(() => {
    return props.review.likes.length;
});

const destroy = (reviewId, requestId) => {
    if (confirm("Are you sure you want to delete this review?")) {
        Inertia.delete(
            route("review.delete", {
                id: reviewId,
                requestId: requestId,
            })
        );
    }
};
</script>

<template>
    <div class="col-span-5">
        <div class="p-6 bg-white shadow-md rounded-lg">
            <div class="flex justify-end items-center">
                <DropDown v-if="$page.props.auth.user?.id === review.user.id">
                    <button
                        @click="editReview"
                        class="text-left w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                    >
                        {{ edit ? "Cancel" : "Edit" }}
                    </button>
                    <button
                        @click="destroy(review.id, review.request_id)"
                        class="text-left block w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                    >
                        Delete
                    </button>
                </DropDown>
            </div>

            <div class="flex">
                <div class="mt-6 p-4 w-full bg-gray-50">
                    <div class>
                        <div
                            class="text-gray-800 text-base tracking-wide leading-8 font-normal"
                        >
                            <template v-if="edit">
                                <QuillEditor
                                    toolbar="essential"
                                    theme="snow"
                                    :readOnly="false"
                                    contentType="html"
                                    v-model:content="form.content"
                                />
                            </template>
                            <template v-else>
                                <QuillEditor
                                    :toolbar="[]"
                                    theme
                                    :readOnly="true"
                                    contentType="html"
                                    :content="review.content"
                                />
                            </template>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-center items-center ml-8">
                    <div
                        class="p-2 cursor-pointer hover:bg-gray-100 hover:rounded-full"
                    >
                        <template v-if="isLikedByAuthUser">
                            <svg
                                @click="unlikeReview"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 fill-red-500 stroke-red-500"
                                fill="red"
                                viewBox="0 0 24 24"
                                stroke="red"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                        </template>

                        <template
                            v-else-if="
                                $page.props.auth?.user.id === review.user.id
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 stroke-red-200 cursor-not-allowed"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                        </template>

                        <template v-else>
                            <svg
                                @click="likeReview"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 stroke-red-500"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                        </template>
                    </div>

                    <div>
                        <span class="text-sm text-red-500">{{
                            likeCounts
                        }}</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <BreezeButton
                    v-if="edit"
                    @click="submit"
                    class="mt-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Submit
                </BreezeButton>
            </div>

            <div class="mt-10">
                <div class="flex justify-end items-center">
                    <img
                        class="object-cover h-10 rounded-full"
                        src="https://images.unsplash.com/photo-1586287011575-a23134f797f9?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=48&amp;q=60"
                        alt="Avatar"
                    />
                    <div class="flex flex-col mx-2">
                        <a
                            href="#"
                            class="font-semibold text-gray-800 tracking-wide dark:text-gray-200 cursor-pointer"
                            >{{ review.user.name }}</a
                        >
                        <p class="text-xs text-gray-500">
                            answered
                            <span class="ml-1">{{ review.created_at }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
