<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { ExclamationCircleIcon } from '@heroicons/vue/solid';
import { useForm } from '@inertiajs/inertia-vue3'

const form = useForm({
    name: '',
    email: '',
    remember: false
});

const submit = () => {
    form.post(route('users.store'), {
        onFinish: () => form.reset('name'),
    });
};
</script>

<template>
    <Head title="Create a user" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a user
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <form @submit.prevent="submit">

                            <div class="mt-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input v-model="form.name" type="text" name="name" id="name" class="block w-full pr-10 border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md" placeholder="Your Name" aria-invalid="true" aria-describedby="name-error" />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                    </div>
                                </div>
                                <p v-if="form.errors.name" class="mt-2 text-sm text-red-600" id="name-error">{{ form.errors.name }}</p>
                            </div>

                            <div class="mt-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input v-model="form.email" type="email" name="email" id="email" class="block w-full pr-10 border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md" placeholder="you@example.com" aria-invalid="true" aria-describedby="email-error" />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                    </div>
                                </div>
                                <p v-if="form.errors.email" class="mt-2 text-sm text-red-600" id="email-error">{{ form.errors.email }}</p>
                            </div>

                            <div class="mt-4">
                                <button :disabled="form.processing" type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Sign in</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
