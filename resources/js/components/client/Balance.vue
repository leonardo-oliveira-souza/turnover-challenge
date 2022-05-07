<template>
    <div>
        <div class="bg-blue-300 h-32">
            <div class="flex">
                <span class="text-white text-center w-full text-2xl mt-8">
                    BNB Bank
                </span>
            </div>
            <div class="flex mx-4 justify-between">
                <div>
                    <span class="text-white">Current balance</span>
                    <br>
                    <span class="text-white text-3xl">
                        ${{ currentBalance }}
                    </span>
                </div>
                <div class="flex">
                    <select v-model="dateFilter" ref="selectperiod" class="self-end form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-white bg-blue-300 bg-clip-padding bg-no-repeat transition ease-in-out m-0 focus:text-blue-300 focus:bg-white focus:border-blue-400 focus:outline-none">
                        <option class="p-2" value="2022-04">April, 2022</option>
                        <option class="p-2" value="2022-05">May, 2022</option>
                        <option class="p-2" value="2022-06">June, 2022</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex bg-blue-200 h-20">
            <div class="flex w-full mx-4 justify-between self-center">
                <div>
                    <span class="text-blue-400">Incomes</span>
                    <br>
                    <span class="text-blue-400 text-xl">
                        ${{ totalIncomes }}
                    </span>
                </div>
                <button class="text-center text-blue-400">
                    <span class="text-3xl">+</span>
                    <br>
                    <span class="text-sm">Deposit a check</span>
                </button>
            </div>
        </div>
        <div class="flex bg-blue-100 h-20">
            <div class="flex w-full mx-4 justify-between self-center">
                <div>
                    <span class="text-blue-400">Expenses</span>
                    <br>
                    <span class="text-blue-400 text-xl">
                        ${{ totalExpenses }}
                    </span>
                </div>
                <a href="purchase" class="text-center text-blue-400 mr-6">
                    <span class="text-3xl">+</span>
                    <br>
                    <span class="text-sm">Purchase</span>
                </a>
            </div>
        </div>
        <div class="block mt-4">
            <h1 class="block ml-4 text-blue-400 text-xl">Transactions</h1>
            <transaction-list :transactions="transactions"></transaction-list>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            currentBalance: 0,
            totalIncomes: 0,
            totalExpenses: 0,
            transactions: [],

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
            const { data } = await axios.get('balance', {
                params: {
                    period: this.dateFilter
                }
            });

            this.currentBalance = data.current_balance;
            this.totalIncomes = data.total_incomes;
            this.totalExpenses = data.total_expenses;
            this.transactions = data.transactions;
        }
    },

    mounted () {
        this.getData();
    }
}
</script>