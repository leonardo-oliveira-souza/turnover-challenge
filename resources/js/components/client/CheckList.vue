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
                <td v-bind:class="getStatusColor(check.status)">
                    ${{ check.amount }}
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
    },

    methods: {
        getStatusColor (status) {
            switch (status) {
                case 1:
                    return 'text-blue-400';
                case 2:
                    return 'text-red-400';
                default:
                    return 'text-gray-400';
            }
        }
    }
}
</script>