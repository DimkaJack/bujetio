<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import UpsertLayout from "@/Layouts/Crud/UpsertLayout.vue";
import Form from "@/Pages/Tag/Form.vue";

const props = defineProps({
    tag: Object,
});

const form = useForm({
    name: props.tag.name,
    color: props.tag.color,
});
</script>

<template>
    <Head title="Tags"/>

    <AuthenticatedLayout>
        <UpsertLayout
            :upsertCallback="() => form.put(route('tags.update', props.tag.id), { onSuccess: () => form.reset() })"
            :routeBackPath="'tags.index'"
        >
            <Form :form="form"/>
        </UpsertLayout>
    </AuthenticatedLayout>
</template>
