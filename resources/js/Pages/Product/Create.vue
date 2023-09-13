<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';
import CurrencyInput from "@/Components/CurrencyInput.vue";
import {computed} from "vue";

const props = defineProps({
    types: Array,
});

const form = useForm({
    name: '',
    type: '',
    startBalanceAmount: 0,
    startBalanceCurrency: 'RUB', //@todo
    balanceAmount: 0,
    balanceCurrency: 'RUB', //@todo
    bankLoanAmount: 0,
});

const isCredit = computed(() =>
    [2, 3].includes(form.type)
);
</script>

<template>
    <Head title="Product create" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('products.store'), { onSuccess: () => form.reset() })">
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

                <div>
                    <InputLabel for="type" value="Type" />

<!--                    @todo dropdown make route-->
                    <select class="mt-1 block w-full" v-model="form.type" required>
                        <option v-for="option in props.types" :value="option.value">
                            {{ option.label }}
                        </option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.type" />
                </div>

                <div class="mt-4">
                    <InputLabel for="startBalanceAmount" value="Start balance" />

                    <CurrencyInput
                        id="startBalanceAmount"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.startBalanceAmount"
                        :options="{ currency: form.startBalanceCurrency }"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.startBalanceAmount" />
                </div>

                <div class="mt-4">
                    <InputLabel for="balanceAmount" value="Current balance" />

                    <CurrencyInput
                        id="balanceAmount"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.balanceAmount"
                        :options="{ currency: form.balanceCurrency }"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.balanceAmount" />
                </div>

<!--                @todo create constants-->
                <div class="mt-4" v-if="isCredit">
                    <InputLabel for="bankLoanAmount" value="Bank loan amount" />

                    <CurrencyInput
                        id="bankLoanAmount"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.bankLoanAmount"
                        :options="{ currency: form.balanceCurrency }"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.bankLoanAmount" />
                </div>

                <PrimaryButton class="mt-4">Save</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
