<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';
defineProps(['category']);

const form = useForm();

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('categories.destroy', id));
    }
}
</script>

<template>


    <tr>
        <td class="border px-4 py-2">{{ category.name }}</td>
        <td class="border px-4 py-2">
            <div class="box-border h-9 p-4 border-4 rounded" :style="`background-color: ${category.color}`"></div>
        </td>
        <td class="border px-4 py-2">{{ new Date(category.createdAt).toLocaleString() }}</td>
        <td class="border px-4 py-2">
            <Link
                tabIndex="1"
                class="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                :href="route('categories.edit', category.id)"
            >
                Edit
            </Link>

            <button
                @click="destroy(category.id)"
                tabIndex="-1"
                type="button"
                class="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
            >
                Delete
            </button>
        </td>
    </tr>
</template>
