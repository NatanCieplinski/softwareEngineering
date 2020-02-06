import Vue from 'vue';
const axios = require('axios').default;

export default {
	state: {
		desks: [],
		reserved: [],
		classroom: 1,
	},
	mutations: { 
		SET_DESKS: (state, desks) => (state.desks = desks),
		SET_RESERVED: (state, reserved) => (state.reserved = reserved),
		SET_SEAT: (state, data) => (Vue.set(state.reserved, data.index, data.array))
	},
	actions: {
		async getDesks({commit, dispatch, getters}, data){
			axios.get('api/banchi/aula/'+getters.GET_CLASSROOM).then(function(response){
				dispatch('initReserved', response.data);
				commit('SET_DESKS', response.data);
			});
		},
		async reserveSeat({ dispatch, getters }, data){
			var payload = {
				da_ora: data.da_ora,
				ad_ora: data.ad_ora,
				posto: data.seat_id,
				user_id: data.user_id,
				desk_id: data.desk_id,
			};

			axios.post('api/prenotazioni/new', payload).then(function(response){
				var requestData = {
					da_ora: data.da_ora,
					ad_ora: data.ad_ora,
					classroom_id: getters.GET_CLASSROOM,
				}
				dispatch('checkAvailability', requestData);
			});
		},
		async checkAvailability({commit, getters}, data){
			var payload = {
				da_ora: data.da_ora,
				ad_ora: data.ad_ora,
			};

			axios.post('api/prenotazioni/aula/'+getters.GET_CLASSROOM, payload).then(function(response){
				var reserved = getters.GET_RESERVED;
				var desks = getters.GET_DESKS;

				desks.forEach(function(desk){
					for(var i=0; i<desk.tipo_banco.numero_posti; i++){
						reserved[desk.id][i] = true;
					}
				});

				response.data.data.forEach(function(reservation){
					reserved[reservation.desk_id][reservation.posto] = false;
				});

				reserved.forEach(function(desk, index){
					commit('SET_SEAT', { array: desk, index: index});
				});
			});
		},
		initReserved({commit}, desks){
			var reserved = new Array();

			desks.forEach(function(desk){
				reserved[desk.id] = new Array();
				for(var i=0; i<desk.tipo_banco.numero_posti; i++){
					reserved[desk.id][i] = false;
				}
			});

			commit('SET_RESERVED', reserved);
		}
	},
	getters: { 
		GET_DESKS: (state) => state.desks,
		GET_RESERVED: (state) => state.reserved,
		GET_CLASSROOM: (state) => state.classroom
	}
}