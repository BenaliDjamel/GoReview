<script setup>

import {Link} from '@inertiajs/inertia-vue3';

const props = defineProps(['name'])

</script>

<template>
 <div>
     Hello inertia - {{props.name}}

     <div class="mt-4">
         <Link href="/" >Welcome</Link>
     </div>
 </div>
</template>