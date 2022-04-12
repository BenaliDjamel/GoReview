<script setup>
import TopCommunities from "@/Components/Community/TopCommunities.vue";
import RequestContent from "@/Components/Request/RequestContent.vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    community: Object,
    communities: Array,
});
</script>

<template>
    <div class="grid grid-cols-8 gap-6">
        <div class="col-span-8 md:col-span-5 lg:col-span-6">
            <template v-if="community.requests.length">
                <div class="grid grid-flow-row gap-8">
                    <RequestContent
                        v-for="request in community.requests"
                        :request="request"
                        :key="request.id"
                    />
                </div>
            </template>
            <template v-else>
                <div class="mt-6 text-gray-700 text-2xl text-center">
                    There is no requests
                    <Link
                        :href="route('request.create')"
                        class="text-base font-medium underline text-blue-700"
                        >Create one?</Link
                    >
                </div>
            </template>
        </div>

        <div
            class="p-4 hidden md:col-span-3 lg:col-span-2 md:block h-fit bg-white shadow rounded-lg"
        >
            <div class="mb-4 p-4 rounded-lg text-center text-white bg-cyan-600">
                <h1>Top Communities</h1>
            </div>
            <template v-if="communities.length">
                <div class="flex flex-col">
                    <TopCommunities
                        v-for="community in communities"
                        :community="community"
                        :key="community.id"
                    />
                </div>

                <div
                    class="mt-6 py-2 text-center bg-gray-50 border border-cyan-600 rounded-lg hover:bg-cyan-600 hover:text-white"
                >
                    <Link :href="route('community.index')" class="text-gray-900"
                        >View all</Link
                    >
                </div>
            </template>
            <template v-else>
                <div class="mt-6 text-gray-700 text-lg text-center">
                    There is no communities
                </div>
            </template>
            <div class="mt-6 py-2 text-center bg-gray-200 rounded-lg">
              <Link :href="route('community.create')" class="text-gray-900"
                    >Create community</Link
                >
            </div>
        </div>
    </div>
</template>
