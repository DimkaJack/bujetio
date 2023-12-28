<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import MoneyFormatter from "@/Components/MoneyFormatter.vue";

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
                <div class="bg-white shadow-sm sm:rounded-lg grid grid-cols-2">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold pb-4">Last transactions:</h3>
                        <div>
                            <div v-for="transaction in transactions.data">
                                <span class="text-xs">{{ transaction.payDate }}</span>
                                {{ transaction.name }}.
                                <MoneyFormatter
                                    :value="transaction.amount"
                                    :currency="transaction.amountCurrency"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold pb-4">Products:</h3>
                        <div>
                            <div v-for="product in products.data">
                                {{ product.name }}.
                                <MoneyFormatter
                                    :value="product.balanceAmount"
                                    :currency="product.balanceCurrency"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="p-6 text-gray-900">
                        <span>WIP</span>
                        <h3 class="text-lg font-semibold pb-4">Budget(month): </h3>
                        <ul>
                            <li>income:
                                <MoneyFormatter
                                    :value="budgets.monthly.income.amount"
                                    :currency="budgets.monthly.income.currency"
                                />
                            </li>
                            <li>outcome:
                                <MoneyFormatter
                                    :value="budgets.monthly.outcome.amount"
                                    :currency="budgets.monthly.outcome.currency"
                                />
                            </li>
                            <li>balance:
                                <MoneyFormatter
                                    :value="budgets.monthly.balance.amount"
                                    :currency="budgets.monthly.balance.currency"
                                />
                            </li>
                        </ul>
                    </div>
                    <div class="p-6 text-gray-900">
                        <span>WIP</span>
                        <h3 class="text-lg font-semibold pb-4">Budget(total): </h3>
                        <ul>
                            <li>Allowed balance:
                                <MoneyFormatter
                                    :value="budgets.total.income.amount"
                                    :currency="budgets.total.income.currency"
                                />
                            </li>
                            <li>Current debt:
                                <MoneyFormatter
                                    :value="budgets.total.outcome.amount"
                                    :currency="budgets.total.outcome.currency"
                                />
                            </li>
                            <li>Balance:
                                <MoneyFormatter
                                    :value="budgets.total.balance.amount"
                                    :currency="budgets.total.balance.currency"
                                />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
