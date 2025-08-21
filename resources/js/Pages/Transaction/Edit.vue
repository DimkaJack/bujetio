<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import UpsertLayout from "@/Layouts/Crud/UpsertLayout.vue";
import Form from "@/Pages/Transaction/Form.vue";

const props = defineProps({
    categories: Object,
    products: Object,
    transaction: Object,
    tags: Object,
    types: Array,
});

const form = useForm({
    name: props.transaction.data.name,
    type: props.transaction.data.type.id,
    amount: props.transaction.data.amount,
    amountCurrency: props.transaction.data.amountCurrency,
    productId: props.transaction.data.product.id,
    categoryId: props.transaction.data.category.id,
    payDate: props.transaction.data.payDate,
    tags: props.transaction.data.tags.map(tag => tag.id),
});
</script>

<template>
    <Head title="Transaction"/>

    <AuthenticatedLayout>
        <UpsertLayout
            :upsertCallback="() => form.put(route('transactions.update', props.transaction.data.id), { onSuccess: () => form.reset() })"
            :routeBackPath="'products.index'"
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
