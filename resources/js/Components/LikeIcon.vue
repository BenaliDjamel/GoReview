<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { usePage } from "@inertiajs/inertia-vue3";

const props = defineProps({
    review: Object,
});

const isLikedByAuthUser = computed(() => {
    const likes = props.review.likes;
    const userId = usePage().props.value.auth.user.id;
    return likes.filter((obj) => obj.user_id === userId).length > 0;
});

const likeCounts = computed(() => {
    return props.review.likes.length;
});
</script>

<template>
    <svg
       
        xmlns="http://www.w3.org/2000/svg"
        class="h-8 w-8 fill-red-500 stroke-red-500"
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

    <!--  <template v-else-if="$page.props.auth?.user.id === review.user.id">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-8 w-8 stroke-red-200 cursor-not-allowed"
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
    </template> -->
</template>
