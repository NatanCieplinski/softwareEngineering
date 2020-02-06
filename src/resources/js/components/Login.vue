<template>
    <div class="wrapper fadeInDown">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="email" value="a@a.com">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input v-model="password" type="password" value="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button v-on:click="login" class="nav-link btn btn-primary">Login</button>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        data: function () { 
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            login: function (event) {
                this.$store.dispatch('login', {
                    email: this.email,
                    password: this.password
                }).then(() => {
                    this.$router.push('/');
                });
            },
        },
        computed: mapGetters(['GET_TOKEN']),
    }
</script>

<style lang="scss" scoped>
    .wrapper {
        display: flex;
        align-items: center;
        flex-direction: column; 
        justify-content: center;
        width: 100%;
        min-height: 100%;
        padding: 20px;
}
</style>