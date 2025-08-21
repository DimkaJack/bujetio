<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import UpsertLayout from "@/Layouts/Crud/UpsertLayout.vue";
import Form from "@/Pages/Product/Form.vue";

const props = defineProps({
    types: Array,
});

const form = useForm({
    name: '',
    type: '',
    startBalanceAmount: 0,
    startBalanceCurrency: 'RUB', //@todo
    balanceAmount: 0,
    balanceCurrency: 'RUB', //@todo
    bankLoanAmount: 0,
});
</script>

<template>
    <Head title="Product create"/>

    <AuthenticatedLayout>
        <UpsertLayout
            :upsertCallback="() => form.post(route('products.store'), { onSuccess: () => form.reset() })"
            :routeBackPath="'products.index'"
        >
            <Form
                :form="form"
                :types="props.types"
            />
        </UpsertLayout>
    </AuthenticatedLayout>
</template>
