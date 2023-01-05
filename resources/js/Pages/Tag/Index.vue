<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Tag from "@/Components/Tag/Tag.vue";
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps(['tags']);
</script>

<template>
    <Head title="Tags" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tags</h2>
        </template>

        <div class="mx-auto p-4 sm:p-6 lg:p-8">

            <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <Link
                    class="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                    :href="route('tags.create')"
                >
                    Create Tag
                </Link>
            </div>

            <table class="table-fixed w-full bg-white">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Created at</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                </thead>
                <tbody>
                    <Tag
                        v-for="tag in tags.data"
                        :key="tag.id"
                        :tag="tag"
                    />
                </tbody>
            </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
