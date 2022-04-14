<script setup>
import { ref } from "vue";

defineProps({
    requests: Array,
});
</script>

<template>
    <div class="flex flex-col justify-center">
        <div class="flex border-b border-gray-200 dark:border-gray-700">
            <Link
                :href="route('admin.panel')"
                class="h-10 px-4 py-2 -mb-px text-sm text-center text-gray-700 bg-transparent border-b-2 border-transparent sm:text-base dark:text-white whitespace-nowrap cursor-base focus:outline-none hover:border-gray-400"
            >
                Users
            </Link>

            <Link
                :href="route('admin.requests')"
                class="h-10 px-4 py-2 -mb-px text-sm text-center text-blue-600 bg-transparent border-b-2 border-blue-500 sm:text-base whitespace-nowrap cursor-base focus:outline-none"
            >
                Request
            </Link>
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
                            <Link
                                as="button"
                                method="delete"
                                :href="
                                    route('admin.delete.request', request.id)
                                "
                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                >Delete</Link
                            >
                        </td>
                        <td class="px-6 py-4 text-right">
                            <Link
                                v-if="!request.closed"
                                as="button"
                                method="put"
                                :href="route('admin.close.request', request.id)"
                                class="font-medium text-green-600 dark:text-green-500 hover:underline"
                                >Close</Link
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
