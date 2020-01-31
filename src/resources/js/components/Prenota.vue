<template>
    <div>
        <button v-on:click="test">test</button>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        data: function () { 
            return {
            }
        },
        methods: {
            test: function (event) {
                this.$store.dispatch('testBanchi');
            },
        },
        computed: mapGetters(['GET_DESKS']),
    }
</script>

<style lang="scss" scoped>

</style>