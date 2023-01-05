<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';

const props = defineProps({
    tag: Object,
});

const form = useForm({
    name: props.tag.name,
});
</script>

<template>
    <Head title="Tags" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.put(route('tags.update', props.tag.id), { onSuccess: () => form.reset() })">
                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <PrimaryButton class="mt-4">Save</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
