<template>
	<div>
		<div class="row">
			<div class="desk col-md-3" v-for="desk in GET_DESKS" :key="desk.id">
				<div class="seat-container">
					<div class="seat" v-for="seat in getSeats(desk)" :key="seat"
						v-bind:style="{ width: 'calc(100%/'+desk.tipo_banco.numero_posti/2+')' }" 
						v-on:click="reserveSeat(desk.id, seat.id)"
					></div>
				</div>
			</div>
			<div class="form-inline mt-5">
				<div class="form-group">
					<label class="ml-3">Da Ora: </label>
					<select v-model="da_ora" class="form-control ml-3">
						<option>08:00</option>
						<option>09:00</option>
						<option>10:00</option>
						<option>11:00</option>
						<option>12:00</option>
						<option>13:00</option>
						<option>14:00</option>
						<option>15:00</option>
						<option>16:00</option>
						<option>17:00</option>
						<option>18:00</option>
						<option>19:00</option>
					</select>
				</div>
				<div class="form-group">
					<label class="ml-3">Ad Ora: </label>
					<select v-model="ad_ora" class="form-control ml-3">
						<option>08:00</option>
						<option>09:00</option>
						<option>10:00</option>
						<option>11:00</option>
						<option>12:00</option>
						<option>13:00</option>
						<option>14:00</option>
						<option>15:00</option>
						<option>16:00</option>
						<option>17:00</option>
						<option>18:00</option>
						<option>19:00</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapGetters } from 'vuex';
	export default {
		data: function () { 
			return {
				da_ora: '',
				ad_ora: ''
			}
		},
		methods: {
			getDesks: function (event) {
				this.$store.dispatch('getDesks');
			},
			getSeats: function (desk){
				var seats = new Array();
				for(var i=0; i<desk.tipo_banco.numero_posti; i++)
					seats[i] = i;
				return seats;
			},
			reserveSeat: function (desk_id, seat_id) {
				if(this.da_ora > this.ad_ora){
					console.log(desk_id);
					console.log(seat_id);
					/*this.$store.dispatch('reserveSeat', {
						da_ora: this.da_ora,
						ad_ora: this.ad_ora,
						user_id: this.$store.getters.GET_USER.id,
						desk_id: desk_id,
						seat_id: seat_id,
					});*/
				}
			},
		},
		computed: mapGetters(['GET_DESKS']),
		beforeCreate(){
			this.$store.dispatch('requestToken', {
				email: "a@a.com",
				password: "password"
			});
		},
		created(){
			this.$store.dispatch('getDesks');
		}
	}
</script>

<style lang="scss" scoped>
	.desk{
		height: 80px;
		padding: 0px 15px;
		margin-top:15px;
		
	}
	.seat-container{
		border: 1px solid black;
		width: 100%;
		height: 100%;
		display: flex;
		flex-wrap: wrap;
	}
	.seat{
		background:red; 
		height: calc(100%/2);
		margin: 0px;
		border: 1px solid blue;
	}
</style>