<script setup>
import {inject} from 'vue';
import {Inertia} from '@inertiajs/inertia';

const route = inject('route');

const props = defineProps({
    routeBackPath: String,
});

const goToRoute = () => {
    if (props.routeBackPath) {
        Inertia.visit(route(props.routeBackPath));
    }
};
</script>

<template>
    <button
        type="button"
        @click="goToRoute"
        class="inline-flex items-center px-4 py-2 ml-6 bg-stone-100 border border-stone-800 rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot/>
    </button>
</template>
