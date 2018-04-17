<template>
    <div v-if="_job">
        <div class="card nobottommargin">
            <div class="card-body ui form" style="padding: 40px;">
                <form @submit.prevent="validateForm('new-job-form')" data-vv-scope="new-job-form"
                      class="nobottommargin">

                    <h2 class="mb-5">
                        <span class="uk-text-meta">Job Work details</span> <br>
                        {{ _job.title }}
                    </h2>

                    <div class="col_full">
                        <div class="">
                            <label>Broadcast to: <small class="uk-text-meta">(Choose all that apply)</small></label>
                            <div class="fluid d-flex justify-content-between row">
                                <div class="inline field col-6" v-for="(config, key) in broadcastsConfig.data">
                                    <div class="ui checkbox">
                                        <input type="checkbox" :value="key" name="job.broadcastsConfig"
                                               v-model="job.broadcastsConfig" tabindex="0" class="hidden">
                                        <label>{{ config }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col_full">
                        <div class="row">
                            <div class="col-6">
                                <label>Should start on:</label>
                                <input type="text" id="starts" name="starts"
                                       data-toggle="datetimepicker" data-target="#starts" class="date-picker"
                                       placeholder="">
                            </div>

                            <div class="col-6">
                                <label>Ends:</label>
                                <input type="text" id="ends" name="starts"
                                       data-toggle="datetimepicker" data-target="#ends" class="date-picker"
                                       placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="col_full">
                        <div class="row">
                            <div class="col-6">
                                <label>SIA staff rating:</label>
                                <div class="fluid d-block">
                                    <div class="ui star rating sia_staff_rating float-none" data-max-rating="5"></div>
                                </div>
                                <span class="d-block p-0 fluid m-0 uk-text-meta">
                                   {{ ratingMessage }}
                              </span>
                            </div>
                            <div class="col-6">
                                <label>Offer (£):</label>

                                <div class="ui input fluid">
                                    <input type="text" name="wage" placeholder="£ 8.00" v-model="job.wages">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col_full nobottommargin">
                        <button class="button button-3d button-green nomargin" type="submit">Save and continue</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>
<style scoped>

</style>
<script type="text/babel">

    export default{
        data(){
            return{
                job : {
                    date : {
                        start : '',
                        end : ''
                    },
                    wages : 0,
                    rating : 0,
                    broadcastsConfig : [],
                    loadingAddress : false
                },
                broadcastsConfig : {
                    data : null,
                    loading : false
                },
                ratingMessage : 'Minimum wage for all SIA Personnel is £8.00',
            }
        },
        props : ['_job'],
        methods : {
            save: function () {
                var vm = this;

                vm.$root.showSplashScreen('Saving....');

                // merge step 1 job with step 2 job
                for (var property in this._job) {
                    if (!this.job.hasOwnProperty(property)) {
                        this.job[property] = this._job[property];
                    }
                }

                window.axios.post('/api/jobs/new', vm.job)
                        .then(
                                function (response) {
                                    vm.$root.showSplashScreen('Job saved! Redirecting...');
                                    window.location.href = '/account/jobs/schedule';
                                }
                        )
                        .catch(function (e) {
                            vm.$root.hideSplashScreen();
                        });
            },
            validateForm: function(scope) {
                var vm = this;

                this.$validator.validateAll(scope).then(function(result) {
                    if (result) {
                        vm.save();
                    } else {
                        alert('You have provided invalid data. Please check again!')
                    }
                });
            },
            loadBroadcasts : function () {
                var vm = this;
                vm.broadcastsConfig.loading = true;

                window.axios.get('/api/app/broadcasts-config')
                        .then(function (response) {

                            vm.broadcastsConfig.data = response.data;

                            vm.broadcastsConfig.loading = false;

                            setTimeout(()=> {
                                $('.ui.checkbox')
                                        .checkbox()
                                ;
                            },1000)
                        });
            },
        },
        mounted(){
            const vm = this;

            this.loadBroadcasts();

            $('#starts').datetimepicker();
            $('#ends').datetimepicker({
                useCurrent: false
            });
            $("#starts").on("dp.change", function (e) {
                vm.job.date.start = e.target.value;

                $('#ends').data("DateTimePicker").minDate(e.date.add(4, 'hours').add(30, 'days'));
            });
            $("#ends").on("dp.change", function (e) {
                vm.job.date.end = e.target.value;

                $('#starts').data("DateTimePicker").maxDate(e.date);
            });

            $('.rating.sia_staff_rating')
                    .rating({
                        onRate : function (value) {
                            vm.job.rating = value;

                            switch (value){
                                case 4 :
                                    vm.ratingMessage = 'Consider offering 4-star SIA Personnel £10.00';
                                    break;
                                case 5 :
                                    vm.ratingMessage = 'Consider offering 5-star SIA Personnel £12.00';
                                    break;
                                default:
                                    vm.ratingMessage = 'Minimum wage for all SIA Personnel is £8.00';
                            }
                        }
                    })
            ;
        },
    }
</script>
