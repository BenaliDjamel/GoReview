<script setup>

defineProps({
    requests: Array,
    communities: Array
})

</script>

<template>
    <div class="grid grid-cols-8 gap-6">
        <div class="col-span-8 md:col-span-5 lg:col-span-6">
            <div class="grid grid-flow-row gap-8">
                <div v-for="request in requests" :key="request.id" class="p-6 bg-white shadow-md rounded-lg">
                    <div class="flex justify-between items-center">
                        <div  class="flex items-center">
                            <button v-if="request.closed"
                                class="px-2.5 py-1 rounded-full text-white text-sm bg-green-600"
                            >Closed</button>
                        </div>

                        <div class="relative inline-block">
                            <!-- Dropdown toggle button -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-gray-700 cursor-pointer"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                                />
                            </svg>

                            <!-- Dropdown menu -->
                            <!-- <div class="absolute right-0 z-20 w-48 py-2 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-800">
                            <a href="#" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"> your profile </a>
                            <a href="#" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"> Your projects </a>
                            <a href="#" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"> Help </a>
                            <a href="#" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"> Settings </a>
                            <a href="#" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"> Sign Out </a>
                            </div>-->
                        </div>
                    </div>

                    <div class="mt-8">
                        <a class="text-sm sm:text-xl text-gray-900 sm:text-gray-800" href="#">
                            {{request.title}}
                        </a>
                    </div>
                    <div class="mt-6 p-4 bg-gray-50">
                        <p class="text-gray-800 text-base tracking-wide leading-8 font-normal">
                            {{request.content}}
                        </p>
                    </div>
                    <div class="mt-6">
                        <div class="flex justify-end items-center">
                            <img
                                class="object-cover h-10 rounded-full"
                                src="https://images.unsplash.com/photo-1586287011575-a23134f797f9?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=48&amp;q=60"
                                alt="Avatar"
                            />
                            <div class="flex flex-col mx-2">
                                <a
                                    href="#"
                                    class="font-semibold text-gray-800 tracking-normal dark:text-gray-200 cursor-pointer"
                                >{{request.user.name}}</a>
                                <p class="text-xs text-gray-500">
                                    asked
                                    <span class="ml-1">{{request.created_at}}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center">
                        <div class="bg-gray-200 px-2 py-1 rounded-full">
                            <a class="text-gray-700" href="#">
                                review/
                                <span class="text-cyan-900">{{request.community.name}}</span>
                            </a>
                        </div>

                        <div class="ml-4 flex items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                                />
                            </svg>
                            <span class="ml-1 text-gray-800">{{request.reviews.length}} review(s)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="p-4 hidden md:col-span-3 lg:col-span-2 md:block h-fit bg-white shadow rounded-lg"
        >
            <div class="mb-4 p-4 rounded-lg text-center text-white bg-cyan-600">
                <h1>Top Communities</h1>
            </div>
            <div class="flex flex-col">
                <div v-for="community in communities" :key="community.id" class="p-2 border flex justify-between items-center">
                    <a class="rounded text-gray-800" href="#">
                        review/
                        <span>{{community.name}}</span>
                    </a>
                    <span class="p-2 bg-gray-200 text-xs text-gray-700 rounded-full">15</span>
                </div>
            </div>

            <div
                class="mt-6 py-2 text-center bg-gray-50 border border-cyan-600 rounded-lg hover:bg-cyan-600 hover:text-white"
            >
                <a class="text-gray-900" href="#">View all</a>
            </div>
            <div class="mt-6 py-2 text-center bg-gray-200 rounded-lg">
                <a class="text-gray-900" href="#">Create community</a>
            </div>
        </div>
    </div>
</template>