<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';
import CurrencyInput from "@/Components/CurrencyInput.vue";

const form = useForm({
    name: '',
    type: '',
    amount: '',
    amountCurrency: 'RUB', //@todo
    productId: '', //@todo
    categoryId: '', //@todo
});

const selectOptions = [
    {
        text: 'Приход',
        value: 1,
    },
    {
        text: 'Расход',
        value: 2,
    },
];
</script>

<template>
    <Head title="Transaction create" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('transactions.store'), { onSuccess: () => form.reset() })">
                <div>
                    <InputLabel for="type" value="Type" />

<!--                    @todo dropdown make route-->
                    <select class="mt-1 block w-full" v-model="form.type">
                        <option v-for="option in selectOptions" :value="option.value">
                            {{ option.text }}
                        </option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.type" />
                </div>

                <div class="mt-4">
                    <InputLabel for="amount" value="Amount" />

                    <CurrencyInput
                        id="amount"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.amount"
                        :options="{ currency: form.amountCurrency }"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.color" />
                </div>

                <div>
                    <InputLabel for="product" value="Product" />

                    <TextInput
                        id="product"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.productId"
                        required
                        autofocus
                    />

                    <!--                    @todo dropdown make route-->
<!--                    <select class="mt-1 block w-full" v-model="form.type">-->
<!--                        <option v-for="option in selectOptions" :value="option.value">-->
<!--                            {{ option.text }}-->
<!--                        </option>-->
<!--                    </select>-->

                    <InputError class="mt-2" :message="form.errors.product" />
                </div>

                <div>
                    <InputLabel for="category" value="Category" />

                    <TextInput
                        id="category"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.categoryId"
                        required
                        autofocus
                    />

                    <!--                    @todo dropdown make route-->
<!--                    <select class="mt-1 block w-full" v-model="form.type">-->
<!--                        <option v-for="option in selectOptions" :value="option.value">-->
<!--                            {{ option.text }}-->
<!--                        </option>-->
<!--                    </select>-->

                    <InputError class="mt-2" :message="form.errors.category" />
                </div>

                <PrimaryButton class="mt-4">Save</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
