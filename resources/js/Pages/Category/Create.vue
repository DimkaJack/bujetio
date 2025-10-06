<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import UpsertLayout from "@/Layouts/Crud/UpsertLayout.vue";
import Form from "@/Pages/Category/Form.vue";

const form = useForm({
    name: '',
    color: '#000000',
});
</script>

<template>
    <Head title="Categories"/>

    <AuthenticatedLayout>
        <UpsertLayout
            :upsertCallback="() => form.post(route('categories.store'), { onSuccess: () => form.reset() })"
            :routeBackPath="'categories.index'"
        >
            <Form :form="form"/>
        </UpsertLayout>
    </AuthenticatedLayout>
</template>
