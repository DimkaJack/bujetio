<script setup>
import { computed } from "vue";

//@todo fix need divide
const props = defineProps(['value', 'currency', 'needDivide']);
const formattedValue = computed(() => {
    let currencySymbol = typeof props.currency === 'object' ?
        props.currency.toString() : props.currency;
    console.log(typeof props.currency === 'object', currencySymbol);
    let formatter = new Intl.NumberFormat('ru-RU', {
        style: 'currency',
        currency: currencySymbol,
        currencyDisplay: 'narrowSymbol'
    });
    let value = props.needDivide ? props.value / 100 : props.value;
    return formatter.format(value);
});
</script>

<template>
    <span>{{ formattedValue }}</span>
</template>
