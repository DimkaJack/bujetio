<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    form: Object,
});
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

    <div class="mt-4">
        <InputLabel for="color" value="Color"/>

        <TextInput
            id="color"
            type="color"
            class="mt-1 block w-full h-12"
            v-model="props.form.color"
            required
        />

        <InputError class="mt-2" :message="props.form.errors.color"/>
    </div>
</template>
