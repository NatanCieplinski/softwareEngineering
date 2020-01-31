<template>
    <div class="wrapper fadeInDown">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="email" value="a@a.com">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input v-model="password" type="text" value="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button v-on:click="login" class="nav-link btn btn-primary"><router-link style="color:white;" to="/">Login</router-link></button>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        data: function () { 
            return {
                email: 'a@a.com',
                password: 'password'
            }
        },
        methods: {
            login: function (event) {
                this.$store.dispatch('requestToken', {
                    email: this.email,
                    password: this.password
                });
            },
            test: function (event) {
                this.$store.dispatch('testToken');
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