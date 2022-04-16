<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

import TabLink from "@/Components/Admin/TabLink.vue";
import GroupTabLink from "@/Components/Admin/GroupTabLink.vue";

defineProps({
    requests: Array,
});

const destroy = (requestId) => {
    if (confirm("Are you sure you want to delete this request?")) {
        Inertia.delete(route("admin.delete.request", requestId));
    }
};

const closeRequest = (requestId) => {
    if (confirm("Are you sure you want to close this request?")) {
        Inertia.put(route("admin.close.request", requestId));
    }
};
</script>

<template>
    <div class="flex flex-col justify-center">
        <div class="flex border-b border-gray-200 dark:border-gray-700">
            <GroupTabLink />
        </div>

        <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
            <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">Submited by</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Delete</span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Close</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="request in requests"
                        :key="request.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                        >
                            <Link
                                class="cursor-pointer hover:underline hover:underline-offset-4"
                                :href="route('request.view', request.id)"
                            >
                                {{ request.title }}</Link
                            >
                        </th>
                        <td class="px-6 py-4">{{ request.user.name }}</td>
                        <td class="px-6 py-4">{{ request.user.email }}</td>
                        <td class="px-6 py-4 text-right">
                            <button
                                @click="destroy(request.id)"
                                class="font-medium text-red-600 dark:text-red-500"
                            >
                                Delete
                            </button>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button
                                v-if="!request.closed"
                                @click="closeRequest(request.id)"
                                class="font-medium text-green-600 dark:text-green-500"
                            >
                                Close
                            </button>
                        </td>
                    </tr>
                    <tr v-if="requests.length === 0">
                        <td class="px-6 py-4 border-t" colspan="3">
                            No requests found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
