<template>
    <div>
        <div class="bg-blue-300 h-20">
            <div class="flex">
                <span class="text-white text-center w-full text-2xl mt-8">
                    CHECKS CONTROL
                </span>
            </div>
        </div>
        <div class="block mt-4">
            <table class="w-full mt-2">
                <tbody>
                    <tr v-for="check in checks" v-bind:key="check.id">
                        <a v-bind:href="`/checks/${check.id}`" class="mx-4 flex justify-between items-center border-b border-b-slate-200 pb-2 hover:cursor-pointer">
                            <td>
                                <span class="text-blue-400">
                                    {{ check.description }}
                                </span>
                                <br>
                                <span class="text-blue-300">
                                    {{ check.datetime }}
                                </span>
                            </td>
                            <td class="text-blue-400">
                                ${{ check.amount }}
                            </td>
                        </a>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            checks: [],
        };
    },

    methods: {
        async getData () {
            const { data } = await axios.get('checks/all-pending');

            this.checks = data.data;
        }
    },

    mounted () {
        this.getData();
    }
}
</script>
