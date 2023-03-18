<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm, Head} from '@inertiajs/inertia-vue3';
import CurrencyInput from "@/Components/CurrencyInput.vue";

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
});
</script>

<template>
    <Head title="Product"/>

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.put(route('products.update', props.product.data.id), { onSuccess: () => form.reset() })">
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

                <div>
                    <InputLabel for="type" value="Type"/>

                    <!--                    @todo dropdown make route-->
                    <select class="mt-1 block w-full" v-model="form.type" required>
                        <option v-for="option in props.types" :value="option.value">
                            {{ option.label }}
                        </option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.type"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="startBalanceAmount" value="Start balance"/>

                    <CurrencyInput
                        id="startBalanceAmount"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.startBalanceAmount"
                        :options="{ currency: form.startBalanceCurrency }"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.color"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="balanceAmount" value="Current balance"/>

                    <CurrencyInput
                        id="balanceAmount"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.balanceAmount"
                        :options="{ currency: form.balanceCurrency }"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.color"/>
                </div>

                <PrimaryButton class="mt-4">Save</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
