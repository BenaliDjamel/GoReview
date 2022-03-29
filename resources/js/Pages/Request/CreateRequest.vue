<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

defineProps({
    communities: Array
})

const form = useForm({
    title: '',
    content: '',
    link: '',
    community_id: '',
});

const submit = () => {
    form.post(route('request.store'), {
        onFinish: () => form.reset('title', 'content', 'link'),
    });
};

</script>


<template>
    <Head title="Submit Request" />
    <div class="max-w-4xl mx-auto mt-4">
        <div>
            <h1 class="text-sm md:text-lg">Submit a request for a review</h1>
        </div>
        <form
            @submit.prevent="submit"
            class="grid grid-cols-1 mt-4 px-8 py-4 bg-white rounded-lg shadow-md"
            action="#"
        >
            <div>
                <label
                    class="block mt-4 text-sm font-medium text-gray-600 dark:text-gray-200"
                    for="title"
                >Title</label>
                <input
                    v-model="form.title"
                    class="mt-1 px-4 py-2 w-full text-gray-700 bg-white rounded border focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                    type="text"
                    name="title"
                    id="title"
                />
            </div>

            <div class="mt-4">
                <label
                    class="block mt-4 text-sm font-medium text-gray-600 dark:text-gray-200"
                    for="link"
                >Link</label>
                <input
                    v-model="form.link"
                    class="w-full mt-1 px-4 py-2 rounded border focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                    type="text"
                    name="link"
                    id="link"
                />
            </div>

            <div class="mt-4">
                <label
                    class="block mt-4 text-sm font-medium text-gray-600 dark:text-gray-200"
                    for="community"
                >Community</label>
                <select
                    v-model="form.community_id"
                    class="w-full mt-1 px-2 py-2 shadow-sm bg-white border rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 focus:outline-none"
                    name="community"
                    id="community"
                >
                    <option
                        v-for="community in communities"
                        :value="community.id"
                    >{{ community.name }}</option>
                </select>
            </div>

            <div class="mt-4 mb-24 md:mb-16 sm:h-80">
                <label
                    class="block mt-4 mb-1 text-sm font-medium text-gray-600 dark:text-gray-200"
                    for="content"
                >Content</label>
                <QuillEditor
                    theme="snow"
                    v-model:content="form.content"
                    contentType="html"
                    toolbar="essential"
                />
            </div>

            <div class="flex justify-end">
                <button
                    class="mt-8 px-4 py-2 sm:px-6 sm:py-3 bg-sky-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-sky-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                    type="submit"
                >submit</button>
            </div>
        </form>
    </div>
</template>