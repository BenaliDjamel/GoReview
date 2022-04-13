<script setup>
import BreezeButton from '@/Components/Button.vue';
import { useForm } from "@inertiajs/inertia-vue3";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    errors: Object,
});

const form = useForm({
    name: "",
    description: "",
});

const submit = () => {
    form.post(route("community.store"), {
        onSuccess: () => form.reset("name", "description"),
    });
};
</script>

<template>
    <div class="flex h-screen justify-center">
        <div>
            <div>
                <h1 class="text-sm md:text-lg">Create a community</h1>
            </div>
            <form
                @submit.prevent="submit"
                class="grid grid-cols-1 mt-4 px-8 py-4 bg-white rounded-lg shadow-md"
            >
                <div>
                    <label
                        class="block mt-4 text-sm font-medium text-gray-600 dark:text-gray-200"
                        for="title"
                        >Name</label
                    >
                    <TextInput v-model="form.name" :error="errors.name" />
                    <div v-if="errors.name" class="text-red-500">
                        {{ errors.name }}
                    </div>
                </div>

                <div>
                    <label
                        class="block mt-4 text-sm font-medium text-gray-600 dark:text-gray-200"
                        for="description"
                        >Description</label
                    >
                    <textarea
                        v-model="form.description"
                        :class="{ 'border-red-600': errors.description }"
                        class="mt-1 px-4 py-2 w-full text-gray-700 bg-white rounded border focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                        type="text"
                        name="description"
                        id="description"
                        cols="30"
                        rows="4"
                    ></textarea>
                    <div v-if="errors.description" class="text-red-500">
                        {{ errors.description }}
                    </div>
                </div>

                <div class="flex justify-end">
                     <BreezeButton class="ml-4 mt-8" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Submit
                </BreezeButton>
                </div>
            </form>
        </div>
    </div>
</template>
