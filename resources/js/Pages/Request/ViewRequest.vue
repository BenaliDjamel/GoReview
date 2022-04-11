<script setup>
import UserRequest from '@/Components/Request/UserRequest.vue';
import ReviewRequest from '@/Components/Request/ReviewRequest.vue';
import { computed } from 'vue';
import SubmitReview from '@/Components/Review/SubmitReview.vue';

const props = defineProps({
    request: Object,
    can: Object
})

const numberOfReviews = computed(() => {
    const reviews = props.request.reviews;

    return reviews.length > 0 ?
        `Your Request has ${reviews.length} Review(s)`
        : 'No Reviews for this Request'
})

</script>



<template>
    <div class="">

        <!-- start main section  -->
        <section >
            <div class="grid grid-cols-6">
                <UserRequest :request="request" :can="can"  />
            </div>
            <div class="grid grid-cols-6">
                <SubmitReview v-if="!request.closed" :requestId="request.id" />
            </div>
            <div class="my-8 text-xl">{{ numberOfReviews }}</div>
            <div class="grid grid-cols-6 gap-y-6">
                <ReviewRequest v-for="review in request.reviews" :review="review" />
            </div>
        </section>
        <!-- end main section -->
    </div>
</template>