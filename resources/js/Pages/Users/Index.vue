<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";

defineProps(["users"])
</script>

<template>
    <Head title="Users" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div class="my-4 flex justify-end">
                            <Link :href="route('users.create')" class="py-2 px-4 bg-indigo-500 text-center text-indigo-100 rounded">Create</Link>
                        </div>

                        <Table
                            :resource="users"
                            :striped="true"
                            :prevent-overlapping-requests="false"
                            :input-debounce-ms="1000"
                            :prevent-scroll="true"
                        />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
