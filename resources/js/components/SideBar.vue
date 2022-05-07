<template>
    <div>
        <button v-on:click="toggleShow" class="fixed top-4 left-4 outline-none mobile-menu-button">
            <svg class="w-6 h-6 text-blue-400"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <nav v-on:click.self="toggleShow" class="fixed top-0 left-0 bg-black/40 h-screen w-screen mobile-menu" :class="show || 'hidden'">
            <div class="bg-blue-400 h-full w-60">
                <div class="bg-blue-300 h-24 flex justify-around items-center">
                    <button v-on:click="toggleShow" class="outline-none mobile-menu-button">
                        <svg class="w-6 h-6 text-white"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <span class="text-white text-3xl mr-4">
                        BNB Bank
                    </span>
                </div>

                <ul class="text-white">
                    <li v-if="! admin" class="ml-8 p-2">
                        <a href="/">BALANCE</a>
                    </li>
                    <li v-if="! admin" class="ml-8 p-2">
                        <a href="incomes">INCOMES</a>
                    </li>
                    <li v-if="! admin" class="ml-8 p-2">
                        <a href="expenses">EXPENSES</a>
                    </li>
                    <li v-if="! admin" class="ml-8 p-2">
                        <a>CHECKS</a>
                    </li>

                    <li class="ml-8 p-2">
                        <a href="logout">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    props: {
        admin: {
            type: Number,
            required: true,
        },
    },

    data () {
        return {
            show: false,
        };
    },

    methods: {
        toggleShow () {
            this.show = ! this.show;
        }
    }
};
</script>
