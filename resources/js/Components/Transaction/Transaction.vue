<script setup>
import {Link, useForm} from '@inertiajs/inertia-vue3';
import { getContrastColor } from '@/Helpers/ColorUtils';

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
        <td class="border px-4 py-2">
            <div class="flex flex-wrap gap-1">
                <span
                    v-for="tag in transaction.tags"
                    :key="tag.id"
                    class="inline-block rounded-full px-2 py-0.5 text-xs font-semibold text-gray-700"
                    :style="{
                        backgroundColor: tag.color || '#e5e7eb',
                        color: getContrastColor(tag.color)
                    }"
                >
                    {{ tag.name }}
                </span>
            </div>
        </td>
        <td class="border px-4 py-2">{{ new Date(transaction.payDate).toLocaleString() }}</td>
        <td class="border px-4 py-2">{{ new Date(transaction.createdAt).toLocaleString() }}</td>
        <td class="border px-4 py-2">
            <div class="flex flex-wrap gap-1">
                <Link
                    tabIndex="1"
                    class="inline-block mx-1 px-3 py-2 text-sm text-white bg-blue-500 rounded"
                    :href="route('transactions.edit', transaction.id)"
                >
                    Edit
                </Link>

                <button
                    @click="destroy(transaction.id)"
                    tabIndex="-1"
                    type="button"
                    class="inline-block mx-1 px-3 py-2 text-sm text-white bg-red-500 rounded"
                >
                    Delete
                </button>
            </div>
        </td>
    </tr>
</template>
