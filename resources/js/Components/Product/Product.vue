<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';
defineProps(['product']);

const form = useForm();

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('products.destroy', id));
    }
}
</script>

<template>
<!--    //@todo extract balance to entity-->
    <tr>
        <td class="border px-4 py-2">{{ product.name }}</td>
        <td class="border px-4 py-2">{{ product.type }}</td>
        <td class="border px-4 py-2">{{ product.start_balance_amount }}</td>
        <td class="border px-4 py-2">{{ product.balance_amount }}</td>
        <td class="border px-4 py-2">{{ new Date(product.created_at).toLocaleString() }}</td>
        <td class="border px-4 py-2">
            <Link
                tabIndex="1"
                class="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                :href="route('products.edit', product.id)"
            >
                Edit
            </Link>

            <button
                @click="destroy(product.id)"
                tabIndex="-1"
                type="button"
                class="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
            >
                Delete
            </button>
        </td>
    </tr>
</template>
