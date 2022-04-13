<script setup>
defineProps({
    users: Array,
});

</script>

<template>
    <div class="flex flex-col justify-center">
        <div>Dashboard</div>
        <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
            <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">Fullname</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="user in users"
                        :key="user"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                        >
                            {{ user.name }}
                        </th>
                        <td class="px-6 py-4">{{ user.email }}</td>
                        <td class="px-6 py-4 text-right">
                            <Link v-if="$page.props.auth.user?.id !== user.id && !user.is_admin"
                                as="button"
                                method="delete"
                                :href="route('admin.delete.user', user.id)"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                >Delete</Link
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
