<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import CurrencyInput from "@/Components/CurrencyInput.vue";

const props = defineProps({
    form: Object,
    types: Array,
    products: Array,
    categories: Array,
    tags: Array,
});
</script>

<template>
    <div>
        <InputLabel for="type" value="Type"/>

        <!--                    @todo dropdown make route-->
        <select class="mt-1 block w-full" v-model="props.form.type" required>
            <option v-for="option in props.types" :value="option.value">
                {{ option.label }}
            </option>
        </select>

        <InputError class="mt-2" :message="props.form.errors.type"/>
    </div>

    <div>
        <InputLabel for="name" value="Name"/>

        <TextInput
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="props.form.name"
            required
            autofocus
        />

        <InputError class="mt-2" :message="props.form.errors.name"/>
    </div>

    <div class="mt-4">
        <InputLabel for="amount" value="Amount"/>

        <CurrencyInput
            id="amount"
            type="text"
            class="mt-1 block w-full"
            v-model="props.form.amount"
            :options="{ currency: props.form.amountCurrency }"
            required
        />

        <InputError class="mt-2" :message="props.form.errors.color"/>
    </div>

    <div>
        <InputLabel for="product" value="Product"/>

        <!--                    @todo dropdown make route-->
        <select class="mt-1 block w-full" v-model="props.form.productId" required>
            <option v-for="option in props.products" :value="option.id">
                {{ option.name }}
            </option>
        </select>

        <InputError class="mt-2" :message="props.form.errors.product"/>
    </div>

    <div>
        <InputLabel for="category" value="Category"/>

        <!--                    @todo dropdown make route-->
        <select class="mt-1 block w-full" v-model="props.form.categoryId" required>
            <option v-for="option in props.categories" :value="option.id">
                {{ option.name }}
            </option>
        </select>

        <InputError class="mt-2" :message="props.form.errors.category"/>
    </div>

    <div>
        <InputLabel for="tags" value="Tags"/>

        <!--                    @todo dropdown make route-->
        <select class="mt-1 block w-full" v-model="props.form.tags" multiple required>
            <option v-for="option in props.tags" :value="option.id">
                {{ option.name }}
            </option>
        </select>

        <InputError class="mt-2" :message="props.form.errors.tags"/>
    </div>

    <div>
        <InputLabel for="payDate" value="Pay date"/>

        <TextInput
            id="payDate"
            type="datetime-local"
            class="mt-1 block w-full"
            v-model="props.form.payDate"
            required
        />

        <InputError class="mt-2" :message="props.form.errors.payDate"/>
    </div>
</template>
