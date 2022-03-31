<script setup>
import { Inertia } from '@inertiajs/inertia';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { QuillEditor } from '@vueup/vue-quill'
import { computed, ref } from 'vue';


const props = defineProps({
    review: Object
})

const edit = ref(false)
const dropdown = ref(false)


const form = useForm({
    content: props.review.content
});


const editReview = () => {
    edit.value = true
}


const submit = () => {
    form.put(route('review.update', { id: props.review.id, requestId: props.review.request_id }), {
        onSuccess: () => {
            edit.value = false

        },
        preserveScroll: true
    });
};

const likeReview = () => {
    Inertia.post(route('like.store', { id: props.review.id }), _,
        { preserveScroll: true });
}

const unlikeReview = () => {
    Inertia.delete(route('like.delete', { id: props.review.id }),
        { preserveScroll: true });
}

const isLikedByAuthUser = computed(() => {
    const likes = props.review.likes;
    const userId = usePage().props.value.auth.user.id
    return likes.filter(obj => obj.user_id === userId).length
})

const likeCounts = computed(() => {
    return props.review.likes.length
})

</script>

<template>
  <!--   <div
        class="mb-6 px-8 py-4 col-span-5 bg-white rounded-lg shadow-md overflow-hidden dark:bg-gray-800"
    >
        <div class="flex justify-end">
            <div class="flex items-center justify-center">
                <div class="relative inline-block">
                    <button
                        @click="dropdown = !dropdown"
                        class="relative z-10 block p-2 text-gray-700 bg-white border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none"
                    >
                        <svg
                            class="w-5 h-5 text-gray-800 dark:text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>

                    <div
                        v-show="dropdown"
                        class="absolute right-0 z-20 w-48 py-2 bg-white rounded-md shadow-xl dark:bg-gray-800"
                    >
                        <button
                            @click="editReview"
                            class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                        >Edit</button>
                        <Link
                            as="button"
                            method="delete"
                            :href="route('review.delete', { id: props.review.id, requestId: props.review.request_id })"
                            class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                        >Delete</Link>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="mt-2 text-sm sm:h-24 md:h-36 lg:h-auto bg-gray-50 dark:text-gray-400">
                <template v-if="edit">
                    <QuillEditor
                        toolbar="essential"
                        theme="snow"
                        :readOnly="false"
                        contentType="html"
                        v-model:content="form.content"
                    />
                </template>
                <template v-else>
                    <QuillEditor
                        :toolbar="[]"
                        theme
                        :readOnly="true"
                        contentType="html"
                        :content="review.content"
                    />
                </template>
            </div>

            <div class="mt-8 lg:mt-20">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <img
                                class="object-cover h-10 rounded-full"
                                src="https://images.unsplash.com/photo-1586287011575-a23134f797f9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=48&q=60"
                                alt="Avatar"
                            />
                            <a
                                href="#"
                                class="mx-2 font-semibold text-gray-700 dark:text-gray-200"
                            >{{ review.user.name }}</a>
                        </div>
                        <span
                            class="mx-1 text-xs text-gray-600 dark:text-gray-300"
                        >{{ review.created_at }}</span>
                    </div>
                    <div
                        class="flex flex-col items-center text-gray-400 px-2 rounded cursor-pointer"
                    >
                        <template v-if="isLikedByAuthUser">
                            <svg
                                @click="unlikeReview"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-red-500"
                                fill="red"
                                viewBox="0 0 24 24"
                                stroke="red"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                        </template>

                        <template v-else>
                            <svg
                                @click="likeReview"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                        </template>
                        <span class="text-center">{{ likeCounts }}</span>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button
                        v-if="edit"
                        @click="submit"
                        class="mt-4 px-4 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-green-600 rounded-md hover:bg-green-500 focus:outline-none focus:ring focus:ring-green-300 focus:ring-opacity-80"
                    >Submit</button>
                </div>
            </div>
        </div>
    </div> -->

   
        <div class="col-span-5">
          <div class="p-6 bg-white shadow-md rounded-lg">
            <div class="flex justify-end items-center">
              <div class="relative inline-block">
                <!-- Dropdown toggle button -->
                <svg  @click="dropdown = !dropdown"
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
                <div  v-show="dropdown" class="absolute right-0 z-20 w-48 py-2 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-800">
                         <button
                            @click="editReview"
                            class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                        >Edit</button>
                        <Link
                            as="button"
                            method="delete"
                            :href="route('review.delete', { id: props.review.id, requestId: props.review.request_id })"
                            class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                        >Delete</Link>
                        </div> 
              </div>
            </div>

            <div class="flex">
              <div class="mt-6 p-4 w-full bg-gray-50">
                <div class="">
                  <div
                    class="text-gray-800 text-base tracking-wide leading-8 font-normal"
                  >
                   <template v-if="edit">
                    <QuillEditor
                        toolbar="essential"
                        theme="snow"
                        :readOnly="false"
                        contentType="html"
                        v-model:content="form.content"
                    />
                </template>
                <template v-else>
                    <QuillEditor
                        :toolbar="[]"
                        theme
                        :readOnly="true"
                        contentType="html"
                        :content="review.content"
                    />
                </template>
                  </div>
                </div>
              </div>
              <div class="flex flex-col justify-center items-center ml-8">
                <div
                  class="p-2 cursor-pointer hover:bg-gray-100 hover:rounded-full"
                >
                  <template v-if="isLikedByAuthUser">
                            <svg
                                @click="unlikeReview"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8  fill-red-500 stroke-red-500"
                                fill="red"
                                viewBox="0 0 24 24"
                                stroke="red"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                        </template>

                        <template v-else>
                            <svg
                                @click="likeReview"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 stroke-red-500"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                        </template>
                </div>

                <div>
                  <span class="text-sm text-red-500">{{ likeCounts }}</span>
                </div>
              </div>
            </div>

            <div class="mt-10">
              <div class="flex justify-end items-center">
                <img
                  class="object-cover h-10 rounded-full"
                  src="https://images.unsplash.com/photo-1586287011575-a23134f797f9?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=48&amp;q=60"
                  alt="Avatar"
                />
                <div class="flex flex-col mx-2">
                  <a
                    href="#"
                    class="font-semibold text-gray-800 tracking-wide dark:text-gray-200 cursor-pointer"
                    >{{ review.user.name }}</a
                  >
                  <p class="text-xs text-gray-500">
                    answered
                    <span class="ml-1">{{ review.created_at }}</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
</template>