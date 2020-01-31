<template>
	<div>
			<h1 class="mt-5">Aula C1.10</h1>
		<div class="row">
			<div class="desk col-md-3" v-for="desk in GET_DESKS" :key="desk.id">
				<div class="seat-container">
					<div class="seat" v-for="seat in getSeats(desk)" :key="seat"
						v-bind:style="{ width: 'calc(100%/'+desk.tipo_banco.numero_posti/2+')', 
						background: GET_RESERVED[desk.id][seat] ? '#b2e87b' : '#ff5757'}" 
					>
						<div v-on:click="reserveSeat(desk.id, seat)"></div>
					</div>
				</div>
			</div>
			<div class="form-inline mt-5">
				<div class="form-group">
					<label class="ml-3">Da Ora: </label>
					<select v-model="da_ora" v-on:change="checkAvailability" class="form-control ml-3">
						<option value="08:00:00">08:00</option>
						<option value="09:00:00">09:00</option>
						<option value="10:00:00">10:00</option>
						<option value="11:00:00">11:00</option>
						<option value="12:00:00">12:00</option>
						<option value="13:00:00">13:00</option>
						<option value="14:00:00">14:00</option>
						<option value="15:00:00">15:00</option>
						<option value="16:00:00">16:00</option>
						<option value="17:00:00">17:00</option>
						<option value="18:00:00">18:00</option>
						<option value="19:00:00">19:00</option>
					</select>
				</div>
				<div class="form-group">
					<label class="ml-3">Ad Ora: </label>
					<select v-model="ad_ora" v-on:change="checkAvailability" class="form-control ml-3">
						<option value="08:00:00">08:00</option>
						<option value="09:00:00">09:00</option>
						<option value="10:00:00">10:00</option>
						<option value="11:00:00">11:00</option>
						<option value="12:00:00">12:00</option>
						<option value="13:00:00">13:00</option>
						<option value="14:00:00">14:00</option>
						<option value="15:00:00">15:00</option>
						<option value="16:00:00">16:00</option>
						<option value="17:00:00">17:00</option>
						<option value="18:00:00">18:00</option>
						<option value="19:00:00">19:00</option>
						<option value="20:00:00">20:00</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapGetters } from 'vuex';
	const axios = require('axios').default;
	
	export default {
		data: function () { 
			return {
				da_ora: '',
				ad_ora: '',
				colors: []
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
				if(this.da_ora.localeCompare(this.ad_ora)<0 &&
					this.da_ora != '' && this.ad_ora != ''	
				){
					if(confirm("Vuoi prenotare il posto?")){
						this.$store.dispatch('reserveSeat', {
							da_ora: this.da_ora,
							ad_ora: this.ad_ora,
							user_id: this.$store.getters.GET_USER.id,
							desk_id: desk_id,
							seat_id: seat_id,
						});
					}
				}
			},
			checkAvailability: function(){
				if(this.da_ora.localeCompare(this.ad_ora)<0 &&
					this.da_ora != '' && this.ad_ora != ''	
				){
					this.$store.dispatch('checkAvailability', {
						da_ora: this.da_ora,
						ad_ora: this.ad_ora,
					});
				};
			},
		},
		computed: {
			...mapGetters(['GET_DESKS','GET_RESERVED','GET_TOKEN']),
		},
		created(){
			this.$http.interceptors.response.use(undefined, function (err) {
				return new Promise(function (resolve, reject) {
					if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
						this.$store.dispatch(logout)
					}
					throw err;
				});
			});
			this.$store.dispatch('getDesks')
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
		border: 1px solid black;
	}
	.seat > div{
		width: 100%;
		height: 100%;
	}
</style>