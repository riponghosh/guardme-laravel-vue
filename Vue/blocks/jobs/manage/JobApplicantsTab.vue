<template>
    <div class="" :class="{loading : applicants.loading}">
        <div class="white-box">
            <h3 class="box-title m-b-0">Applicants</h3>
            <p class="text-muted m-b-20">{{ applicants.total }} applicant(s) were found on this job.</p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Bid</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in applicants.data">
                        <td>
                            <a href="javascript:void(0)" @click="viewProfile(user)">
                                {{ user.username }}
                            </a>
                        </td>
                        <td>{{ job.offer | currency }}</td>
                        <td><span class="text-muted"><i class="fa fa-clock-o"></i> {{ user.bid_date }}</span> </td>
                        <td>
                            <a v-if="!user.hired" href="javascript:void(0)"
                               class="label label-table label-success"
                                @click.prevent="hire(user)">
                                Hire <i class="icon handshake"></i>
                            </a>

                            <a v-else class="ui tag green label">Hired!</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="ui modal large profile" style="bottom: unset;">
            <div class="header">Employee' Profile</div>
            <div class="content">

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
                applicants : {
                    data : [],
                    total : 0,
                    loading : false
                },
                pagination : null
            }
        },
        props : ['job'],
        methods : {
            getApplicants() {
                this.applicants.loading = true;
                window.axios.get(`/api/jobs/${this.job.id}/applicants`)
                        .then((response) => {
                            var data = response.data.data;

                            data.forEach((item)=>{
                                this.applicants.data.push(item);
                            });

                            this.applicants.total = response.data.total;
                            this.pagination = response.data.links;

                            this.applicants.loading = false;
                        })
                ;
            },
            hire(user){
                this.applicants.loading = true;
                user.hired = true;
                window.axios.post(`/api/jobs/${this.job.id}/hire`, {
                    user_id : user.id,
                    wages : this.job.offer
                })
                        .then((response) => {
                            this.applicants.loading = false;
                        })
                ;
            },
            viewProfile : function (user) {
                $('.ui.modal.profile')
                        .modal('show')
                ;
            },
        },
        mounted(){
            this.getApplicants();
        }

    }
</script>
