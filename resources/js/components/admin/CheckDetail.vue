<template>
    <div>
        <div class="bg-blue-100 h-16">
            <div class="flex">
                <span class="text-blue-400 text-center w-full text-2xl mt-4">
                    CHECK DETAILS
                </span>
            </div>
        </div>

        <div class="text-blue-300 m-4">
            <div class="flex flex-wrap justify-center mt-3">
                <div class="w-full md:w-1/2">
                    <label class="block mb-1 text-blue-300">CUSTOMER</label>
                    <input v-bind:value="check.account.user.username" class="w-full h-10 px-3 tex-blue-400 text-base placeholder-blue-400 border rounded-lg focus:outline-none" type="text" readonly />
                </div>
            </div>
            <div class="flex flex-wrap justify-center mt-3">
                <div class="w-full md:w-1/2">
                    <label class="block mb-1 text-blue-300">CUSTOMER EMAIL</label>
                    <input v-bind:value="check.account.user.email" class="w-full h-10 px-3 tex-blue-400 text-base placeholder-blue-400 border rounded-lg focus:outline-none" type="text" readonly />
                </div>
            </div>
            <div class="flex flex-wrap justify-center mt-3">
                <div class="w-full md:w-1/2">
                    <label class="block mb-1 text-blue-300">ACCOUNT</label>
                    <input v-bind:value="check.account.id" class="w-full h-10 px-3 tex-blue-400 text-base placeholder-blue-400 border rounded-lg focus:outline-none" type="text" readonly />
                </div>
            </div>
            <div class="flex flex-wrap justify-center mt-3">
                <div class="w-full md:w-1/2">
                    <label class="block mb-1 text-blue-300">REPORTED AMOUNT</label>
                    <input v-bind:value="check.amount" class="w-full h-10 px-3 tex-blue-400 text-base placeholder-blue-400 border rounded-lg focus:outline-none" type="text" readonly />
                </div>
            </div>
            <div class="flex flex-wrap justify-center mt-3">
                <div class="w-full md:w-1/2">
                    <img class="w-full max-h-36" v-bind:src="check.image_url" alt="Check image">
                </div>
            </div>

            <div class="flex flex-wrap justify-around mt-3">
                <button v-on:click="reject" class="text-blue-400 py-2 px-4 rounded border border-blue-400">
                    REJECT
                </button>
                <button v-on:click="accept" class="bg-blue-400 text-white py-2 px-4 rounded">
                    ACCEPT
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: {
            type: Number,
            require: true,   
        }
    },

    data() {
        return {
            check: []
        };
    },

    methods: {
        async getData() {
            const { data } = await axios.get(`/checks/${this.id}/api`);

            this.check = data.check;
        },

        async accept() {
            await axios.put(`/checks/${this.id}/accept`);

            window.location.href = '/';
        },

        async reject() {
            await axios.put(`/checks/${this.id}/reject`);

            window.location.href = '/';
        },
    },

    mounted() {
        this.getData();
    },
}
</script>