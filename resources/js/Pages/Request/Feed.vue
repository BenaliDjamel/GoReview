<script setup>
import DropDown from '@/Shared/DropDown.vue';
import TopCommunities from '../../Components/Community/TopCommunities.vue';
import ReviewsCount from '@/Components/Review/ReviewsCount.vue';
import { QuillEditor } from '@vueup/vue-quill'
import { Link } from '@inertiajs/inertia-vue3'
import RequestContent from '@/Components/Request/RequestContent.vue';


const props = defineProps({
    requests: Array,
    communities: Array
})

</script>

<template>
    <div class="grid grid-cols-8 gap-6">
        <div class="col-span-8 md:col-span-5 lg:col-span-6">
            <div class="grid grid-flow-row gap-8">
               <RequestContent  v-for="request in requests" :request="request" :key="request.id" />
            </div>
        </div>

        <div
            class="p-4 hidden md:col-span-3 lg:col-span-2 md:block h-fit bg-white shadow rounded-lg"
        >
            <div class="mb-4 p-4 rounded-lg text-center text-white bg-cyan-600">
                <h1>Top Communities</h1>
            </div>
            <div class="flex flex-col">
                <TopCommunities v-for="community in communities" :community="community" :key="community.id" />
            </div>

            <div
                class="mt-6 py-2 text-center bg-gray-50 border border-cyan-600 rounded-lg hover:bg-cyan-600 hover:text-white"
            >
                <Link :href="route('community.index')" class="text-gray-900" >View all</Link>
            </div>
            <div class="mt-6 py-2 text-center bg-gray-200 rounded-lg">
                <Link :href="route('community.create')" class="text-gray-900" >Create community</Link>
            </div>
        </div>
    </div>
</template>