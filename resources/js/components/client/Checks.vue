<template>
    <div>
        <div class="bg-blue-300 h-40">
            <div class="flex">
                <span class="text-white text-center w-full text-2xl mt-8">
                    CHECKS
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
            <div class="mx-4">
                <ul class="nav nav-tabs flex flex-row flex-wrap list-none border-b-0 pl-0 mb-4" role="tablist">
                    <li class="nav-item flex-auto text-center">
                        <button v-on:click="setTabActive('pending')" class="nav-link w-full block font-medium text-xs text-white leading-tight uppercase border-x-0 border-t-0 border-b-2 border-transparent px-6 py-3 my-2" v-bind:class="tabActive === 'pending' ? 'border-b-blue-400' : ''" role="tab">
                            PENDING
                        </button>
                    </li>
                    <li class="nav-item flex-auto text-center">
                        <button v-on:click="setTabActive('acepted')" class="nav-link w-full block font-medium text-xs text-white leading-tight uppercase border-x-0 border-t-0 border-b-2 border-transparent px-6 py-3 my-2" v-bind:class="tabActive === 'acepted' ? 'border-b-blue-400' : ''" role="tab">
                            ACEPTED
                        </button>
                    </li>
                    <li class="nav-item flex-auto text-center">
                        <button v-on:click="setTabActive('rejected')" class="nav-link w-full block font-medium text-xs text-white leading-tight uppercase border-x-0 border-t-0 border-b-2 border-transparent px-6 py-3 my-2" v-bind:class="tabActive === 'rejected' ? 'border-b-blue-400' : ''" role="tab">
                            REJECTED
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex mt-4">
            <check-list v-show="tabActive === 'pending'" :checks="pending"></check-list>
            <check-list v-show="tabActive === 'acepted'" :checks="acepted"></check-list>
            <check-list v-show="tabActive === 'rejected'" :checks="rejected"></check-list>
        </div>
        <div class="fixed bottom-4 right-4">
            <button class="bg-blue-400 rounded-full h-12 w-12 text-5xl text-white">
                +
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dateFilter: new Date().getFullYear() + "-" + String(new Date().getMonth() + 1).padStart(2, "0"),
            tabActive: 'acepted',

            pending: [],
            acepted: [],
            rejected: []
        };
    },

    watch: {
        dateFilter(newValue, oldValue) {
            this.$refs.selectperiod.blur();
            this.getData();
        },
    },

    methods: {
        async getData() {
            const { data } = await axios.get('checks/search', {
                params: {
                    period: this.dateFilter,
                }
            });

            this.pending = data.pending;
            this.acepted = data.acepted;
            this.rejected = data.rejected;
        },

        setTabActive(tab) {
            this.tabActive = tab;
        }
    },

    mounted() {
        this.getData();
    },
};
</script>
