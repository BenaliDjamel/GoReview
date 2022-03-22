<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const props = defineProps({
    communities: Array
})

const form = useForm({
    content: '',
    link: '',
    community_id: '',
});

const submit = () => {
    form.post(route('request.store'), {
        onFinish: () => form.reset('content', 'link'),
    });
};

</script>


<template>
    <Head title="Create Request" />
    <form @submit.prevent="submit">
        <div>
            <label for="about" class="block text-sm font-medium text-gray-700">About</label>
            <div class="mt-1">
                <QuillEditor theme="snow" v-model:content="form.content" contentType="html"  toolbar="essential" />
            </div>
        </div>

        <label for="code-link" class="block text-sm font-medium text-gray-700">Link</label>
        <div class="mt-1 flex rounded-md shadow-sm">
            <span
                class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"
            >http://</span>
            <input
                type="text"
                name="code-link"
                v-model="form.link"
                id="code-link"
                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                placeholder="www.example.com"
            />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
            <select
            v-model="form.community_id"
                id="country"
                name="country"
                autocomplete="country-name"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            >
                <option
                    v-for="community in props.communities"
                    :value="community.id"
                >{{ community.name }}</option>
            </select>
        </div>
        <button
            type="submit"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
        >Submit</button>
    </form>
</template>