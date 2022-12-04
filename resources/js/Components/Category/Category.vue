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
        <td class="border px-4 py-2">{{ category.color }}</td>
        <td class="border px-4 py-2">{{ new Date(category.created_at).toLocaleString() }}</td>
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
