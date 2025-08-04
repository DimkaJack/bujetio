<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import UpsertLayout from "@/Layouts/Crud/UpsertLayout.vue";

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
            <div>
                <InputLabel for="name" value="Name"/>

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.name"/>
            </div>

            <div class="mt-4">
                <InputLabel for="color" value="Color"/>

                <TextInput
                    id="color"
                    type="color"
                    class="mt-1 block w-full h-12"
                    v-model="form.color"
                    required
                />

                <InputError class="mt-2" :message="form.errors.color"/>
            </div>
        </UpsertLayout>
    </AuthenticatedLayout>
</template>
