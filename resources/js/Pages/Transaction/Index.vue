<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Transaction from "@/Components/Transaction/Transaction.vue";

defineProps(['transactions']);
</script>

<template>
    <Head><title>Transactions</title></Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transactions</h2>
        </template>

        <div class="mx-auto p-4 sm:p-6 lg:p-8">

            <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <Link
                    class="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                    :href="route('transactions.create')"
                >
                    Create transaction
                </Link>
            </div>

            <table class="table-fixed w-full bg-white">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Amount</th>
                    <th class="px-4 py-2">Currency</th>
                    <th class="px-4 py-2">Product</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Pay date</th>
                    <th class="px-4 py-2">Created at</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                </thead>
                <tbody>
                    <Transaction
                        v-for="transaction in transactions.data"
                        :key="transaction.id"
                        :transaction="transaction"
                    />
                </tbody>
            </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
