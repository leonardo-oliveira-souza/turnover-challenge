<template>
    <div>
        <div class="bg-blue-300 h-28">
            <div class="flex">
                <span class="text-white text-center w-full text-2xl mt-8">
                    INCOMES
                </span>
            </div>
            <div class="flex mx-4 justify-between">
                <div class="flex">
                    <select v-model="dateFilter" ref="selectperiod" class="self-end form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-white bg-blue-300 bg-clip-padding bg-no-repeat transition ease-in-out m-0 focus:text-blue-300 focus:bg-white focus:border-blue-400 focus:outline-none">
                        <option class="p-2" value="2022-04">April, 2022</option>
                        <option class="p-2" value="2022-05">May, 2022</option>
                        <option class="p-2" value="2022-06">June, 2022</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex mt-4">
            <transaction-list :transactions="incomes"></transaction-list>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            incomes: [],

            dateFilter: (new Date).getFullYear() + '-' + String((new Date()).getMonth() + 1).padStart(2, '0'),
        };
    },

    watch: {
        dateFilter(newValue, oldValue) {
            this.$refs.selectperiod.blur();
            this.getData();
        }
    },

    methods: {
        async getData () {
            const { data } = await axios.get('transactions/search', {
                params: {
                    period: this.dateFilter,
                    type: 1,
                }
            });

            this.incomes = data.transactions;
        }
    },

    mounted () {
        this.getData();
    }
}
</script>
