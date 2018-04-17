require('../../bootstrap/google-maps');
window.accounting = require('../../../Scripts/accounting/accounting.min');

Vue.filter('currency', function (value) {
    return accounting.formatMoney(value,'£ ');
});

new window.App({
    el: '#app',
    data : function(){
        return {
            jobs : {
                data : [],
                loading : false,
                url : '/api/jobs/auth/active',
                total : 0
            },
            search_keyword : '',
            pagination : null,
            selected_job : null,
            selected_employee : null,
            employees : {
                data : [],
                loading : false,
                total : 0,
                pagination : null
            },
            feedback : {
                comment : '',
                ratings : []
            },
            ratings : {
                data : [],
                loading : false
            }
        }
    },
    methods : {
        getActiveJobs : function (keyword) {
            const vm = this;
            if(!this.jobs.url) return;

            var params = {};

            if(keyword){
                this.jobs.url = '/api/jobs/auth/active';
                params = {
                    keyword : keyword
                };
            }

            vm.jobs.loading = true;

            window.axios.get(vm.jobs.url, {params : params})
                .then(function (response) {
                    vm.jobs.data = [];

                    vm.jobs.loading = false;
                    vm.jobs.total = response.data.total;

                    response.data.data.forEach(function (job) {

                        var exists = window._.find(vm.jobs.data, function (item) {
                            return item.id === job.id;
                        });

                        if(!exists){
                            vm.jobs.data.push(job);
                        }
                    });
                    vm.pagination = response.data.links;
                });
        },
        filterJobs : _.debounce(function (newVal) {
            this.getActiveJobs(newVal);
        }, 2000),
        next: function () {
            this.jobs.url = this.pagination.next;

            this.getActiveJobs();
        },
        prev: function () {
            this.jobs.url = this.pagination.prev;

            this.getActiveJobs();
        },
        getEmployees: function() {
            const vm = this;
            this.employees.loading = true;
            this.employees.data = [];
            window.axios.get('/api/jobs/' + vm.selected_job.id + '/employees')
                .then(function(response) {
                var data = response.data.data;

            data.forEach(function(item){
                vm.employees.data.push(item);
            });

            vm.employees.total = response.data.total;
            vm.employees.pagination = response.data.links;

            vm.employees.loading = false;
            });
        },
        getRatings: function() {
            const vm = this;
            this.ratings.loading = true;

            window.axios.get('/api/ratings/fetch')
                .then(function(response) {
                    var data = response.data;

                    data.forEach(function(item){
                        vm.ratings.data.push(item);
                    });

                    vm.ratings.loading = false;
                });
        },
        markComplete: function (job) {
            var vm = this;

            vm.selected_job = job;
            vm.selected_employee = null;
            vm.feedback.comment = '';
            vm.feedback.ratings = [];

            vm.updateJobAsCompleted(job);
            vm.getEmployees();
            window.UIkit.modal('#job-complete-modal').show();

        },
        updateJobAsCompleted: function (job) {
            job.completed = true;

            window.axios.get('/api/jobs/' + job.id + '/mark-complete').then(function (response) {

            })
        },
		unMarkComplete: function (job) {
			job.completed = false;

			window.axios.get('/api/jobs/' + job.id + '/unmark-complete').then(function (response) {

			})
		},
        giveFeedback : function (employee) {
            this.selected_employee = employee;
            const vm = this;

            setTimeout(function () {
                $('.rating.skills_rating')
                    .rating({
                        onRate : function (value) {
                            var ratingId = $(this).data('rating-id');

                            var existing = window._.find(vm.feedback.ratings, function (item) {
                                return item.ratingId === ratingId
                            })

                            if(existing){
                                existing.value = value;
                            } else {
                                vm.feedback.ratings.push({
                                    ratingId : ratingId,
                                    value : value
                                });
                            }
                        }
                    })
                ;
            },500);
        },
        cancelFeedback : function () {
            this.selected_job = null;
            this.selected_employee = null;
            this.feedback.comment = '';
            this.feedback.ratings = [];
            window.UIkit.modal('#job-complete-modal').hide();
        },
        submitFeedback: function () {
            const vm = this;

            vm.$root.ukNotify('Submitting feedback...');

            window.axios.post('/api/feedback/submit',{
                feedback : vm.feedback,
                user : vm.selected_employee.id,
                job : vm.selected_job.id
            }).then(function (response) {
                vm.selected_employee = null;

                vm.$root.ukNotify('Feedback submitted!!!');

            });
        }
    },
    mounted : function () {
        this.getActiveJobs();
        this.getRatings();
    },
    watch : {
        search_keyword : function (newVal, oldVal) {
            this.filterJobs(newVal);
        }
    }
});