<template>
    <div class="px-4">
        <form id="login-form" name="login-form" class="nobottommargin" @submit.prevent="login()">

            <div class="col_full">
                <label for="username" class="t400">Username:</label>
                <input type="text" id="username" name="login-form-username"
                       v-model="credentials.email" class="form-control" />
            </div>

            <div class="col_full">
                <label for="password" class="t400">Password:</label>
                <input type="password" id="password" name="login-form-password"
                       v-model="credentials.password" class="form-control" />
            </div>

            <div class="col_full nobottommargin">
                <button class="button button-rounded t400 nomargin" id="login-form-submit"
                        name="login-form-submit" value="login">Login</button>
                <a href="#" class="fright">Forgot Password?</a>
            </div>

            <div class="ui divider"></div>

            <div class="">
                <a class="d-inline-block uk-link fg-site-blue" @click.prevent="$root.togglePage()">
                    Don't have an account? Register here!
                </a>
            </div>

        </form>
    </div>
</template>
<style scoped>

</style>
<script type="text/babel">

    export default{
        data(){
            return{
                credentials : {
                    email: '',
                    password : ''
                },
                requesting : false,
            }
        },
        methods : {
            login: function(){
                // TODO:: login the user
                var vm = this;

                vm.requesting = true;

                vm.$root.showSplashScreen('Signing in.... Please wait!');

                window.axios.post('/account/login', vm.credentials)
                        .then(function(response){
                            vm.requesting = false;

                            vm.$root.showSplashScreen(vm.$root.greetPerson(response.data.user.username));

                            var redirect = vm.$root.getUrlVars()['redirect'];

                            if(!redirect) {
                                redirect = response.data.redirect;
                            }

                            window.location.href = redirect;
                        }).catch(function (error) {

                    vm.$root.hideSplashScreen();
                });
            },
        }
    }
</script>
