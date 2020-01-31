<template>
    <div>
        <ul>
            <li>
                <div v-for="reservation in GET_RESERVATIONS" :key="reservation.id" class="list-group-item d-flex justify-content-between">
                    Prenotazione del {{ reservation.data }} ore: {{ reservation.da_ora }} posto:{{ reservation.posto }}
                    <i class="fas fa-trash" v-on:click="deleteReservation(reservation.id)"></i>
                </div>
            </li>
        </ul>
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
            getReservations: function (id) {
                this.$store.dispatch('getReservations', id);
            },
            deleteReservation: function (id) {
                this.$store.dispatch('deleteReservation', id);
            },
        },
        computed: mapGetters(['GET_RESERVATIONS']),
        created(){
            this.$store.dispatch('getReservations', this.$store.getters.GET_USER.id);
        }
    }
</script>

<style lang="scss" scoped>
    ul{
        margin-top: 15px;
        padding: 0;
    }
    li{
         display: flex;
        flex-direction: column;
    }
</style>