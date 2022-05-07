<template>
    <table class="w-full mt-2">
        <tbody>
            <tr v-for="transaction in transactions" v-bind:key="transaction.id" class="mx-4 flex justify-between items-center border-b border-b-slate-200 pb-2">
                <td>
                    <span class="text-blue-400">
                        {{ transaction.description }}
                    </span>
                    <br>
                    <span class="text-blue-300">
                        {{ transaction.datetime }}
                    </span>
                </td>
                <td v-bind:class="transaction.type === 1 ? 'text-blue-400' : 'text-red-400'">
                    {{ transaction.amount }}
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        transactions: {
            type: Array,
            default: () => [],
        }
    }
}
</script>