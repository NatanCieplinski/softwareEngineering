<template>
    <div>
        <div class="row">
            <div class="desk col-md-3" v-for="desk in GET_DESKS" :key="desk.id">
                <div></div>
            </div>
        </div>
        <button v-on:click="getDesks">getDesks</button>
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
            getDesks: function (event) {
                this.$store.dispatch('getDesks');
            },
        },
        computed: mapGetters(['GET_DESKS']),
        created(){
            this.$store.dispatch('requestToken', {
                email: "a@a.com",
                password: "password"
            });
        }
    }
</script>

<style lang="scss" scoped>
    .desk{
        height: 80px;
        padding: 15px 0;
        margin-top:15px;
    }
    .desk div{
        position: relative;
        background:red; 
        width: 100%;
        height: 100%;
    }
</style>