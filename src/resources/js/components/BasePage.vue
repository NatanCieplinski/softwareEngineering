<template>
    
</template>
<script>
export default {
    mounted(){
        console.log("component mounted")
    },
    data() {
        return {
            data: [],
            data: {
                id: '',
                nome: '',
                username: '',
                email: '',
                email_verified_at: '',
                is_bannato: '',
                tipo_utente: '',
                created_at: '',
                updated_at: ''
            },
            first_page_url: '',
            from: '',
            last_page: '',
            last_page_url: '',
            next_page_url: '',
            path: '',
            per_page: '',
            prev_page_url: '',
            to: '',
            total: ''
        }
    },
    created(){
        this.fetchUser()
    },
    methods: {
        fetchUser(){
            axios
            .get('/api/utenti')
            .then(response => (this.info = response))
            .then(response => {
                console.log();
            })
        }
    }
    
}
</script>