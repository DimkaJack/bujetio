<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import UpsertLayout from "@/Layouts/Crud/UpsertLayout.vue";
import Form from "@/Pages/Category/Form.vue";

const props = defineProps({
    category: Object,
});

const form = useForm({
    name: props.category.name,
    color: props.category.color,
});
</script>

<template>
    <Head title="Categories"/>

    <AuthenticatedLayout>
        <UpsertLayout
            :upsertCallback="() => form.put(route('categories.update', props.category.id), { onSuccess: () => form.reset() })"
            :routeBackPath="'categories.index'"
        >
           <Form :form="form" />
        </UpsertLayout>
    </AuthenticatedLayout>
</template>
