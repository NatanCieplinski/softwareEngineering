<template>
    <div>
        <ul >
            <li>
                <div v-for="reservation in GET_RESERVATIONS" :key="reservation.id" class="list-group-item d-flex justify-content-between">
                    Prenotazione del {{ reservation.data }} ore: {{ reservation.da_ora }} posto:{{ reservation.posto }}
                    <button class="delete"></button>
                </div>
            </li>
        </ul>
        <button v-on:click="getReservations">getReservations</button>
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
            getReservations: function (event) {
                this.$store.dispatch('getReservations');
            },
        },
        computed: mapGetters(['GET_RESERVATIONS']),
        created(){
            var obj = this;
            this.$store.dispatch('requestToken', {
                email: "a@a.com",
                password: "password"
            });
        }
    }
</script>

<style lang="scss" scoped>
    ul{
        padding: 0;
    }
    li{
         display: flex;
        flex-direction: column;
    }
    .delete{
        width: 20 px;
        background-color: red;
    }
</style>