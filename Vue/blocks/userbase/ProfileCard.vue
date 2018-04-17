<template>
    <div class="white-box" v-if="profile">
        <div class="user-bg">
            <div class="overlay-box bg-site-blue">
                <div class="user-content">
                    <a href="javascript:void(0)">
                        <img alt="img" class="thumb-lg img-circle"
                             src="/assets/eliteAdmin/plugins/images/users/varun.jpg">
                    </a>
                    <h4 class="text-white">{{ profile.username }}</h4>
                    <h5 class="text-white">{{ profile.email }}</h5>
                    <div v-if="profile.is_approved" class="text-success"><i class="fa fa-check"></i> Verified</div>
                    <div v-if="!profile.is_approved" class="text-warning"><i class="fa fa-warn"></i> Unverified</div>
                </div>
            </div>
        </div>
        <div class="user-btm-box">
            <div class="row">
                <div class="col-md-6 col-sm-6 text-center">
                    <p class="fg-site-blue"><i class="ti-ticket"></i> active tickets</p>
                    <h3>{{ 0 }}</h3>
                </div>

                <div class="col-md-6 col-sm-6 text-center">
                    <p class="fg-site-green"><i class="fa fa-tasks"></i> active jobs</p>
                    <h3>{{ profile.stats.jobs }}</h3>
                </div>
            </div>

            <div class="row  m-t-20 m-b-0" v-if="profile.primaryRole.name == 'Employer'">
                <div class="col-md-6 col-sm-6 text-center">
                    <p class="fg-site-blue"><i class="fa fa-building"></i> companies</p>
                    <h3>{{ profile.companies.length }}</h3>
                </div>

                <div class="col-md-6 col-sm-6 text-center">

                </div>
                <div class="stats-row col-md-12 text-center">
                    <div class="stat-item">
                        <h6>Contact info</h6> <b><i class="ti-mobile"></i> 123-456-7890</b></div>
                </div>
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
                profile : null
            }
        },
        props : ['user'],
        methods : {
            getUserJobProfile : function (user) {
                const vm = this;

                window.axios.get(`/api/jobs/${user.id}/job-profile`)
                        .then((response) => {
                            this.profile = response.data;
                            console.log('job profile', this.profile);
                        });
            }
        },
        mounted(){

        },
        watch : {
            user : function (newVal, oldVal) {
                if(newVal) this.getUserJobProfile(newVal);
            }
        }
    }
</script>
