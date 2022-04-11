<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { QuillEditor } from "@vueup/vue-quill";
import { ref, watch } from "vue";

const props = defineProps({
    requestId: Number,
    error: String,
});
const form = useForm({
    content: "",
});

const editor = ref();

const submit = () => {
    form.post(route("review.store", props.requestId), {
        onSuccess: () => editor.value.setHTML(""),
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="mt-4 p-6 mb-6 col-span-5 bg-white rounded-lg shadow-md">
        <h2 class="font-semibold text-gray-700 dark:text-gray-200">
            Your Review
        </h2>
        <form @submit.prevent="submit">
            <div class="mt-4 text-sm sm:h-24 md:h-36 dark:text-gray-400">
                <QuillEditor
                    ref="editor"
                    toolbar="essential"
                    theme="snow"
                    v-model:content="form.content"
                    contentType="html"
                />
                <div v-if="error" class="text-red-500">
                    {{ error }}
                </div>
            </div>
            <div class="flex justify-end">
                <button
                    :disabled="form.processing"
                    type="submit"
                    class="px-4 py-2 mt-4 sm:mt-12 font-medium text-white transition-colors duration-200 transform bg-sky-900 text-xs leading-tight uppercase rounded shadow-md hover:bg-sky-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg ease-in-out"
                >
                    Submit
                </button>
            </div>
        </form>
    </div>
</template>
