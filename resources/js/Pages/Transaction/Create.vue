<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';
import CurrencyInput from "@/Components/CurrencyInput.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    categories: Object,
    products: Object,
    tags: Object,
    types: Array,
});

const form = useForm({
    type: '',
    name: '',
    amount: 0,
    amountCurrency: 'RUB', //@todo
    productId: '', //@todo
    categoryId: '', //@todo
    payDate: '', //@todo
    tags: [], //@todo
});
</script>

<template>
    <Head title="Transaction create" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('transactions.store'), { onSuccess: () => form.reset() })">
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

                    <InputError class="mt-2" :message="form.errors.tags" />
                </div>

                <div>
                    <InputLabel for="payDate" value="Pay date" />

                    <TextInput
                        id="payDate"
                        type="datetime-local"
                        class="mt-1 block w-full"
                        v-model="form.payDate"
                        required
                        autofocus
                    />

                    <InputError class="mt-2" :message="form.errors.payDate" />
                </div>

                <PrimaryButton class="mt-4">Save</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
