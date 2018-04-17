<template>
    <div class="px-4">
        <form id="reg-form" name="login-form" class="nobottommargin" @submit.prevent="register()">

            <div class="col_full">
                <label class="t400">I am...</label>
                <div class="fluid">
                    <div>
                        <input id="employer" class="radio-style" name="radio-group-3"
                               type="radio" :value="true"
                               v-model="registration.isEmployer">
                        <label for="employer" class="radio-style-3-label">an Employer</label>
                    </div>
                    <div>
                        <input id="job_seeker" class="radio-style"
                               :value="false" v-model="registration.isEmployer"
                               name="radio-group-3" type="radio">
                        <label for="job_seeker" class="radio-style-3-label">a Job Seeker</label>
                    </div>
                </div>
            </div>

            <div class="col_full">
                <label class="t400">Email:</label>
                <input type="text" name="email"
                       v-model="registration.email" class="form-control" />
            </div>

            <div class="col_full">
                <label for="reg_password" class="t400">Password:</label>
                <input type="password" id="reg_password" name="password"
                       v-model="registration.password" class="form-control" />
            </div>

            <div class="col_full">
                <label for="retype_password" class="t400">Retype Password:</label>
                <input type="password" id="retype_password" name="password"
                       v-model="registration.retype_password" class="form-control" />
            </div>

            <div class="col_full" v-show="registration.isEmployer">
                <label class="t400">Company Name:</label>
                <input type="text" name="company" placeholder=""
                       v-model="registration.company" class="form-control" />
            </div>

            <input hidden type="text" id="referral_code" name="referral_code" v-model="registration.referral_code" class="form-control" />
            <div class="col_full nobottommargin">
                <button class="button button-rounded t400 nomargin" id="reg-form-submit"
                        type="submit">Register</button>
            </div>

            <div class="ui divider"></div>

            <div class="">
                <a class="d-inline-block uk-link fg-site-blue" @click.prevent="$root.togglePage()">
                    Already have an account? Login here!
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
                registration : {
                    email: '',
                    password : '',
                    retype_password : '',
                    company : '',
                    referral_code : this.$root.getUrlVars()['ref'],
                    isEmployer : false
                },
                message : 'Working. Please wait...'
            }
        },
        methods : {
            register: function(){
                // TODO:: login the user
                var vm = this;

                vm.$root.showSplashScreen('Creating your account.... Please wait!');

                window.axios.post('/api/account/register', vm.registration)
                        .then(function(response){
                            vm.requesting = false;

                            var redirect = vm.$root.getUrlVars()['redirect'];

                            if(!redirect) {
                                redirect = '/congratulations';
                            }
                            window.location.href = redirect;
                        }).catch(function (error) {
                    vm.$root.hideSplashScreen();
                });
            },
        }
    }
</script>
