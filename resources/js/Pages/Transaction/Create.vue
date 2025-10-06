<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import UpsertLayout from "@/Layouts/Crud/UpsertLayout.vue";
import Form from "@/Pages/Transaction/Form.vue";

const props = defineProps({
    categories: Object,
    products: Object,
    tags: Object,
    types: Array,
});

const form = useForm({
    type: '',
    name: '',
    amount: 0,
    amountCurrency: 'RUB', //@todo
    productId: '', //@todo
    categoryId: '', //@todo
    payDate: '', //@todo
    tags: [], //@todo
});
</script>

<template>
    <Head title="Transaction create"/>

    <AuthenticatedLayout>
        <UpsertLayout
            :upsertCallback="() => form.post(route('transactions.store'), { onSuccess: () => form.reset() })"
            :routeBackPath="'transactions.index'"
        >
            <Form
                :form="form"
                :categories="props.categories"
                :products="props.products"
                :tags="props.tags"
                :types="props.types"
            />
        </UpsertLayout>
    </AuthenticatedLayout>
</template>
