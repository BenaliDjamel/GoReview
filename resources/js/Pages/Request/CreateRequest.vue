<script setup>
import BreezeButton from '@/Components/Button.vue';
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

import TextInput from "@/Components/TextInput.vue";

defineProps({
    communities: Array,
    errors: Object,
});

const form = useForm({
    title: "",
    content: "",
    link: "",
    community_id: "",
});

const submit = () => {
    form.post(route("request.store"), {
        onSuccess: () => form.reset("title", "content", "link"),
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
                    >Title</label
                >
                <TextInput v-model="form.title" :error="errors.title" />
                <div v-if="errors.title" class="text-red-500">
                    {{ errors.title }}
                </div>
            </div>

            <div class="mt-4">
                <label
                    class="block mt-4 text-sm font-medium text-gray-600 dark:text-gray-200"
                    for="link"
                    >Link</label
                >
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
                    >Community</label
                >
                <select
                    v-model="form.community_id"
                    :class="{ 'border-red-600': errors.community_id }"
                    class="w-full mt-1 px-2 py-2 shadow-sm bg-white border rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 focus:outline-none"
                    name="community"
                    id="community"
                >
                    <option
                        v-for="community in communities"
                        :value="community.id"
                    >
                        {{ community.name }}
                    </option>
                </select>
                <div v-if="errors.community_id" class="text-red-500">
                    {{ errors.community_id }}
                </div>
            </div>

            <div class="mt-4 mb-24 md:mb-16 sm:h-80">
                <label
                    class="block mt-4 mb-1 text-sm font-medium text-gray-600 dark:text-gray-200"
                    for="content"
                    >Content</label
                >
                <QuillEditor
                    theme="snow"
                    v-model:content="form.content"
                    contentType="html"
                    toolbar="essential"
                />
                <div v-if="errors.content" class="text-red-500">
                    {{ errors.content }}
                </div>
            </div>

            <div class="flex justify-end">
               <BreezeButton class="ml-4 mt-8" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Submit
                </BreezeButton>
            </div>
        </form>
    </div>
</template>
