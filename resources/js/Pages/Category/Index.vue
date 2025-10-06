<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Category from '@/Components/Category/Category.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps(['categories']);
</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Categories</h2>
        </template>

        <div class="mx-auto p-4 sm:p-6 lg:p-8">

            <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <Link
                    class="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                    :href="route('categories.create')"
                >
                    Create Category
                </Link>
            </div>

            <table class="table-fixed w-full bg-white">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Color</th>
                    <th class="px-4 py-2">Created at</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                </thead>
                <tbody>
                    <Category
                        v-for="category in categories.data"
                        :key="category.id"
                        :category="category"
                    />
                </tbody>
            </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
