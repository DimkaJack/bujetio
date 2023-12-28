<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';

defineProps(['products', 'transactions', 'budgets']);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg grid grid-cols-3">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold pb-4">Last transactions:</h3>
                        <div>
                            <div v-for="transaction in transactions.data">
                                <span class="text-xs">{{ transaction.payDate }}</span>
                                {{ transaction.name }}. {{ transaction.amount}} {{ transaction.amountCurrency}}
                            </div>
                        </div>
                    </div>
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold pb-4">Products:</h3>
                        <div>
                            <div v-for="product in products.data">
                                {{ product.name }}. {{ product.balanceAmount}} {{ product.balanceCurrency}}
                            </div>
                        </div>
                    </div>
                    <div class="p-6 text-gray-900">
                        <span>WIP</span>
                        <h3 class="text-lg font-semibold pb-4">Budget(month): </h3>
                        <ul>
                            <li>income: {{ budgets.monthly.income.amount }} {{ budgets.monthly.income.currency }}</li>
                            <li>outcome: {{ budgets.monthly.outcome.amount }} {{ budgets.monthly.outcome.currency }}</li>
                            <li>balance: {{ budgets.monthly.balance.amount }} {{ budgets.monthly.balance.currency }}</li>
                        </ul>
                    </div>
                    <div class="p-6 text-gray-900">
                        <span>WIP</span>
                        <h3 class="text-lg font-semibold pb-4">Budget(total): </h3>
                        <ul>
                            <li>allowed balance: {{ budgets.total.income.amount }} {{ budgets.total.income.currency }}</li>
                            <li>current debt: {{ budgets.total.outcome.amount }} {{ budgets.total.outcome.currency }}</li>
                            <li>balance: {{ budgets.total.balance.amount }} {{ budgets.total.balance.currency }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
