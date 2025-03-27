<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm, Head} from '@inertiajs/inertia-vue3';
import CurrencyInput from "@/Components/CurrencyInput.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    categories: Object,
    products: Object,
    transaction: Object,
    tags: Object,
    types: Array,
});

const form = useForm({
    name: props.transaction.data.name,
    type: props.transaction.data.type.id,
    amount: props.transaction.data.amount,
    amountCurrency: props.transaction.data.amountCurrency,
    productId: props.transaction.data.product.id,
    categoryId: props.transaction.data.category.id,
    payDate: props.transaction.data.payDate,
    tags: props.transaction.data.tags.map(tag => tag.id),
});
</script>

<template>
    <Head title="Transaction"/>

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.put(route('transactions.update', props.transaction.data.id), { onSuccess: () => form.reset() })">
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

                    <!--                    @todo dropdown make route-->
                    <select class="mt-1 block w-full" v-model="form.productId" required>
                        <option v-for="option in props.products" :value="option.id">
                            {{ option.name }}
                        </option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.product" />
                </div>

                <div>
                    <InputLabel for="category" value="Category" />

                    <!--                    @todo dropdown make route-->
                    <select class="mt-1 block w-full" v-model="form.categoryId" required>
                        <option v-for="option in props.categories" :value="option.id">
                            {{ option.name }}
                        </option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.category" />
                </div>

                <div>
                    <InputLabel for="tags" value="Tags" />
                    <!--                    @todo dropdown make route-->
                    <select class="mt-1 block w-full" v-model="form.tags" multiple required>
                        <option v-for="option in props.tags" :value="option.id">
                            {{ option.name }}
                        </option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.category" />
                </div>

                <div>
                    <InputLabel for="payDate" value="Pay date" />

                    <TextInput
                        id="payDate"
                        type="datetime-local"
                        class="mt-1 block w-full"
                        v-model="form.payDate"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.payDate" />
                </div>

                <PrimaryButton class="mt-4">Save</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
