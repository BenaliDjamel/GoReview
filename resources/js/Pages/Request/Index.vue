<script setup>
import UserRequest from '@/Components/Request/UserRequest.vue';

 defineProps({
    requests: Array,
})

/* const comments = computed(() => {
    return props.requests.comments.length
}) 
 */

</script>

<template>
  
        <!-- start main section  -->
        <!-- <section class="col-span-2 md:col-span-3">
           
           <UserRequest  v-for="request in requests" :request="request"/>
          
        </section> -->
        <!-- end main section -->
        <section >
           
          <div class="grid grid-cols-6 gap-4">
               <UserRequest  v-for="request in requests" :request="request"/>
          </div>
          
        </section>
    
</template>