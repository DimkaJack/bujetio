<script setup>
import { computed } from "vue";

const props = defineProps(['value', 'currency']);
const formattedValue = computed(() => {
    let formatter = new Intl.NumberFormat('ru-RU', {
        style: 'currency',
        currency: props.currency,
        currencyDisplay: 'narrowSymbol'
    });
    return formatter.format(props.value);
});
</script>

<template>
    <span>{{ formattedValue }}</span>
</template>
