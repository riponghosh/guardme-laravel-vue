require('../../bootstrap/google-maps');

new window.App({
    el: '#app',
    data : function(){
        return {
            jobs : {
                data : [],
                loading : false
            },
            pagination : null,
            categories : {
                data : [],
                loading : false
            },
            filter : {
                offer : {
                    min : 0,
                    max : 0
                },
                categories : [],
            },
            selectedJob : null,
            application : {
                job_id : null,
                bid : 0,
            }
        }
    },
    methods : {
        getJobListings : function (filter) {
            const vm = this;

            var url = '/api/jobs/listings';

            var params = {};

            if(filter){
                params = {
                    categories : filter.categories,
                    min_offer : filter.offer.min,
                    max_offer : filter.offer.max,
                };
            }

            vm.jobs.loading = true;

            window.axios.get(url, {params : params})
                .then(function (response) {
                    if(filter) vm.jobs.data = [];
                    vm.jobs.loading = false;

                    response.data.data.forEach(function (job) {

                        var exists = window._.find(vm.jobs.data, function (item) {
                            return item.id === job.id;
                        });

                        if(!exists){
                            vm.jobs.data.push(job);
                        }
                    });
                    vm.pagination = response.data.links;
                })
            ;
        },
        loadCategories : function () {
            var vm = this;
            vm.categories.loading = true;

            window.axios.get('/api/app/categories')
                .then(function (response) {

                    response.data.forEach(function (category) {
                        vm.categories.data.push(category);
                    });

                    setTimeout(function () {
                        $('.ui.checkbox')
                            .checkbox()
                        ;
                    }, 1000);

                    vm.categories.loading = false;
                });
        },
        filterJobs : _.debounce(function (newVal) {
            this.getJobListings(newVal)
        }, 2000),
        applyToJob : function (job) {
            if(!this.$root.app.user){
                alert('Please login to place bid');
                window.location.href = window.location.href + '?action=login';
                return;
            }
            this.selectedJob = job;
            this.application.job_id = job.id;

            $('.ui.modal.application')
                .modal('show')
            ;
        },
        submitApplication : function (job) {
            const vm = this;

            this.selectedJob = job;
            this.application.job_id = job.id;
            vm.$root.ukNotify('submitting application...');


            window.axios.post('/api/jobs/' + vm.selectedJob.id + '/apply', vm.application)
                .then(function (response) {
                    vm.deselectJob();
                    vm.$root.ukNotify('Application successfully submitted!');
                });

            var applied_job = window._.find(vm.jobs.data, function (item) {
                return item.id === vm.selectedJob.id;
            });
            applied_job.applied = true;
        },
        deselectJob : function () {

           /* $('.ui.modal.application')
                .modal('hide')
            ;*/
            this.selectedJob = null;
            this.application.job_id = null;
            this.application.bid = 0;
        }
    },
    components : {

    },
    watch : {
        filter : {
            handler : function (newVal, oldVal) {
                this.filterJobs(newVal);
            },
            deep : true
        }
    },
    mounted : function(){
        const vm = this;
        this.loadCategories();
        this.getJobListings();

        $(".offer_range_slider").ionRangeSlider({
            type: "double",
            prefix: "£",
            min: 0,
            max: 15,
            onChange: function (data) {
                vm.filter.offer.min = data.from;
                vm.filter.offer.max = data.to;
            },
        });

        
          $('input[name="daterange"]').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY h:mm A'
                }
            });
    }
});