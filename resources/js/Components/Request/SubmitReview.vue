<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { QuillEditor } from '@vueup/vue-quill'
import { ref, watch } from 'vue';

const props = defineProps({
    requestId: Number
})
const form = useForm({
    content: ''
});
const editor = ref()

const submit = () => {
    form.post(route('review.store', props.requestId), {

        onSuccess: () => editor.value.setHTML(''),
    });


};




</script>

<template>
    <div class="p-6 md:max-w-4xl mb-6 bg-white rounded-lg shadow-md">
        <h2 class="font-semibold text-gray-700 dark:text-gray-200">Your Review</h2>
        <form @submit.prevent="submit">
            <div class="mt-4 text-sm sm:h-24 md:h-36 dark:text-gray-400">
                <QuillEditor
                    ref="editor"
                    toolbar="essential"
                    theme="snow"
                    v-model:content="form.content"
                    contentType="html"
                />
            </div>
            <button
                :disabled="form.processing"
                type="submit"
                class="px-4 py-2 mt-4 sm:mt-12 font-medium text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80"
            >Submit</button>
        </form>
    </div>
</template>