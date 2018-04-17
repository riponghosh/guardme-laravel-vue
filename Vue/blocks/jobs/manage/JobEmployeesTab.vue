<template>
    <div class="" :class="{loading : employees.loading}">
        <div class="white-box">
            <h3 class="box-title m-b-0">Hired Personnel</h3>
            <p class="text-muted m-b-20">{{ employees.total }} employees(s) hired on this job.</p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Wages</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in employees.data">
                        <td>{{ user.username }}</td>
                        <td>
                            <span class="text-muted">
                                <i class="fa fa-clock-o"></i> {{ user.hired_at }}
                            </span>
                        </td>
                        <td>
                            <a class="ui green large label">{{ job.offer | currency }}</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
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
                employees : {
                    data : [],
                    total : 0,
                    loading : false
                },
                pagination : null
            }
        },
        props : ['job'],
        methods : {
            getEmployees() {
                this.employees.loading = true;
                window.axios.get(`/api/jobs/${this.job.id}/employees`)
                        .then((response) => {
                            var data = response.data.data;

                            data.forEach((item)=>{
                                this.employees.data.push(item);
                            });

                            this.employees.total = response.data.total;
                            this.pagination = response.data.links;

                            this.employees.loading = false;
                        })
                ;
            },

        },
        mounted(){
            this.getEmployees();
        }

    }
</script>
