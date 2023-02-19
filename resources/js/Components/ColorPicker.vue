<template>
    <color-picker :hue="color" @input="onInput"></color-picker>
</template>

<script>
import { ref } from 'vue';
import ColorPicker from '@radial-color-picker/vue-color-picker';

export default {
    components: { ColorPicker },
    setup() {
        const color = ref(50);
        return {
            color,
            onInput(hue) {
                color.hue = hue;
            },
        };
    },
};
</script>

<style>
@import '@radial-color-picker/vue-color-picker/dist/vue-color-picker.min.css';
</style>
