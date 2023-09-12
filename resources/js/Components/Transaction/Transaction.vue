<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';
defineProps(['transaction']);

const form = useForm();

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('transactions.destroy', id));
    }
}
</script>
<template>
<!--    //@todo extract balance to entity-->
    <tr>
        <td class="border px-4 py-2">{{ transaction.type.label }}</td>
        <td class="border px-4 py-2">{{ transaction.name }}</td>
        <td class="border px-4 py-2">{{ transaction.type.id === 2 ? '-' : '' }}{{ transaction.amount }}</td>
        <td class="border px-4 py-2">{{ transaction.amountCurrency }}</td>
        <td class="border px-4 py-2">{{ transaction.product.name }}</td>
        <td class="border px-4 py-2">{{ transaction.category.name }}</td>
        <td class="border px-4 py-2">{{ new Date(transaction.payDate).toLocaleString() }}</td>
        <td class="border px-4 py-2">{{ new Date(transaction.createdAt).toLocaleString() }}</td>
        <td class="border px-4 py-2">
            <Link
                tabIndex="1"
                class="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                :href="route('transactions.edit', transaction.id)"
            >
                Edit
            </Link>

            <button
                @click="destroy(transaction.id)"
                tabIndex="-1"
                type="button"
                class="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
            >
                Delete
            </button>
        </td>
    </tr>
</template>
