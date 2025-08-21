<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import UpsertLayout from "@/Layouts/Crud/UpsertLayout.vue";
import Form from "@/Pages/Tag/Form.vue";

const form = useForm({
    name: '',
    color: '#000000',
});
</script>

<template>
    <Head title="Tags"/>

    <AuthenticatedLayout>
        <UpsertLayout
            :upsertCallback="() => form.post(route('tags.store'), { onSuccess: () => form.reset() })"
            :routeBackPath="'tags.index'"
        >
            <Form :form="form" />
        </UpsertLayout>
    </AuthenticatedLayout>
</template>
