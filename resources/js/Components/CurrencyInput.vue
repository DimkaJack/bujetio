<template>
    <input
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        ref="inputRef"
        type="text"
    />
</template>

<script>
import { useCurrencyInput } from 'vue-currency-input'

export default {
    name: 'CurrencyInput',
    props: {
        modelValue: Number, // Vue 2: value
        options: Object
    },
    setup(props) {
        const { inputRef } = useCurrencyInput(
            Object.assign(props.options, {
                locale: 'en-US',
                // autoDecimalDigits: true,
            })
        )

        return { inputRef }
    }
}
</script>
