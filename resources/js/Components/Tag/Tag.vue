<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';
defineProps(['tag']);

const form = useForm();

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('tags.destroy', id));
    }
}
</script>

<template>


    <tr>
        <td class="border px-4 py-2">{{ tag.name }}</td>
        <td class="border px-4 py-2">{{ new Date(tag.createdAt).toLocaleString() }}</td>
        <td class="border px-4 py-2">
            <Link
                tabIndex="1"
                class="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                :href="route('tags.edit', tag.id)"
            >
                Edit
            </Link>

            <button
                @click="destroy(tag.id)"
                tabIndex="-1"
                type="button"
                class="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
            >
                Delete
            </button>
        </td>
    </tr>
</template>
