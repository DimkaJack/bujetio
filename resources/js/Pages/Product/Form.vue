<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import CurrencyInput from "@/Components/CurrencyInput.vue";
import {computed} from "vue";

const props = defineProps({
    form: Object,
    types: Array,
});

const isCredit = computed(() =>
    [2, 3].includes(props.form.type)
);
</script>

<template>
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

    <div class="mt-4">
        <InputLabel for="startBalanceAmount" value="Start balance"/>

        <CurrencyInput
            id="startBalanceAmount"
            type="text"
            class="mt-1 block w-full"
            v-model="props.form.startBalanceAmount"
            :options="{ currency: props.form.startBalanceCurrency }"
            required
        />

        <InputError class="mt-2" :message="props.form.errors.startBalanceAmount"/>
    </div>

    <div class="mt-4">
        <InputLabel for="balanceAmount" value="Current balance"/>

        <CurrencyInput
            id="balanceAmount"
            type="text"
            class="mt-1 block w-full"
            v-model="props.form.balanceAmount"
            :options="{ currency: props.form.balanceCurrency }"
            required
        />

        <InputError class="mt-2" :message="props.form.errors.balanceAmount"/>
    </div>

    <!--                @todo create constants-->
    <div class="mt-4" v-if="isCredit">
        <InputLabel for="bankLoanAmount" value="Bank loan amount"/>

        <CurrencyInput
            id="bankLoanAmount"
            type="text"
            class="mt-1 block w-full"
            v-model="props.form.bankLoanAmount"
            :options="{ currency: props.form.balanceCurrency }"
            required
        />

        <InputError class="mt-2" :message="props.form.errors.bankLoanAmount"/>
    </div>
</template>
