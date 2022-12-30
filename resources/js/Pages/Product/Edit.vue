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
});

const form = useForm({
    name: props.product.name,
    type: props.product.type,
    startBalanceAmount: props.product.start_balance_amount,
    startBalanceAmountCurrency: props.product.start_balance_amount_currency,
    balanceAmount: props.product.balance_amount,
    balanceAmountCurency: props.product.balance_amount_curency,
});

const selectOptions = [
    {
        text: 'Дебетовая карта',
        value: 1,
    },
    {
        text: 'Кредитная карта',
        value: 2,
    },
    {
        text: 'Кредит',
        value: 3,
    },
    {
        text: 'Счет',
        value: 4,
    },
];
</script>

<template>
    <Head title="Product"/>

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.put(route('products.update', props.product.id), { onSuccess: () => form.reset() })">
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
                    <select class="mt-1 block w-full" v-model="form.type">
                        <option v-for="option in selectOptions" :value="option.value">
                            {{ option.text }}
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
                        :options="{ currency: 'RUB' }"
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
                        :options="{ currency: 'RUB' }"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.color"/>
                </div>

                <PrimaryButton class="mt-4">Save</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
