<script setup>
import { computed } from "vue";

//@todo fix need divide
const props = defineProps(['value', 'currency', 'needDivide']);
const formattedValue = computed(() => {
    let formatter = new Intl.NumberFormat('ru-RU', {
        style: 'currency',
        currency: props.currency,
        currencyDisplay: 'narrowSymbol'
    });
    let value = props.needDivide ? props.value / 100 : props.value;
    return formatter.format(value);
});
</script>

<template>
    <span>{{ formattedValue }}</span>
</template>
