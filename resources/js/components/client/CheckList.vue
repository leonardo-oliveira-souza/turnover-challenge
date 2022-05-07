<template>
    <table class="w-full mt-2">
        <tbody>
            <tr v-for="check in checks" v-bind:key="check.id" class="mx-4 flex justify-between items-center border-b border-b-slate-200 pb-2">
                <td>
                    <span class="text-blue-400">
                        {{ check.description }}
                    </span>
                    <br>
                    <span class="text-blue-300">
                        {{ check.datetime }}
                    </span>
                </td>
                <td v-bind:class="check.status === 1 ? 'text-blue-400' : 'text-red-400'">
                    {{ check.amount }}
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        checks: {
            type: Array,
            default: () => [],
        }
    }
}
</script>