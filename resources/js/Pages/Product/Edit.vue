<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import UpsertLayout from "@/Layouts/Crud/UpsertLayout.vue";
import Form from "@/Pages/Product/Form.vue";

const props = defineProps({
    product: Object,
    types: Array
});

const form = useForm({
    name: props.product.data.name,
    type: props.product.data.type.id,
    startBalanceAmount: props.product.data.startBalanceAmount,
    startBalanceCurrency: props.product.data.startBalanceCurrency,
    balanceAmount: props.product.data.balanceAmount,
    balanceCurrency: props.product.data.balanceCurrency,
    bankLoanAmount: props.product.data.bankLoanAmount,
});
</script>

<template>
    <Head title="Product"/>

    <AuthenticatedLayout>
        <UpsertLayout
            :upsertCallback="() => form.put(route('products.update', props.product.data.id), { onSuccess: () => form.reset() })"
            :routeBackPath="'products.index'"
        >
            <Form
                :form="form"
                :types="props.types"
            />
        </UpsertLayout>
    </AuthenticatedLayout>
</template>
