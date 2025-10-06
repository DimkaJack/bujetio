<!--@todo сделать-->
<script setup>
export default {
    data() {
        return {
            selected: 'A',
            options: [],
        }
    }
}
</script>

<template>
    <select v-model="selected">
        <option v-for="option in options" :value="option.value">
            {{ option.text }}
        </option>
    </select>
</template>
