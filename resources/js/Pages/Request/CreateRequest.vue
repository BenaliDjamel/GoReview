<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import CommunityDropdown from '@/Components/Dropdown.vue';
import CommunityDropdownLink from '@/Components/DropdownLink.vue';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';


const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['blockquote', 'code-block'],

    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
    [{ 'script': 'sub' }, { 'script': 'super' }],      // superscript/subscript
    [{ 'indent': '-1' }, { 'indent': '+1' }],          // outdent/indent
    [{ 'direction': 'rtl' }],                         // text direction

    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    [{ 'font': [] }],
    [{ 'align': [] }],

    ['clean']                                         // remove formatting button
];






</script>


<template>
    <Head title="Create Request" />
    <form>
        <div>
            <label for="about" class="block text-sm font-medium text-gray-700">About</label>
            <div class="mt-1">
                <QuillEditor theme="snow" :toolbar="toolbarOptions" />
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
                id="code-link"
                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                placeholder="www.example.com"
            />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
            <select
                id="country"
                name="country"
                autocomplete="country-name"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            >
                <option>United States</option>
                <option>Canada</option>
                <option>Mexico</option>
            </select>
        </div>
        <button
            type="submit"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
        >Submit</button>
    </form>
</template>