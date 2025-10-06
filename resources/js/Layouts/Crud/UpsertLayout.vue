<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import BackButton from "@/Components/BackButton.vue";

const props = defineProps({
    upsertCallback: Function,
    routeBackPath: String,
});
</script>

<template>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form @submit.prevent="upsertCallback()">

            <slot/>

            <PrimaryButton class="mt-4">Save</PrimaryButton>
            <BackButton :routeBackPath="routeBackPath">Cancel</BackButton>
        </form>
    </div>
</template>
