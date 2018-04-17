require('../../bootstrap/google-maps');
window.accounting = require('../../../Scripts/accounting/accounting.min');

Vue.filter('currency', function (value) {
    return accounting.formatMoney(value,'£ ');
});

new window.App({
    el: '#app',
    data : function(){
        return {
            feedback_lists : {
                data : [],
                loading : false,
                url : '/api/jobs/auth/active',
                total : 0
            },
            search_keyword : '',
            pagination : null,
        }
    },
    methods : {
        getFeedbacks : function () {
            const vm = this;
            if(!this.feedback_lists.url) return;

            vm.jobs.loading = true;

            window.axios.get(vm.feedback_lists.url)
                .then(function (response) {
                    vm.feedback_lists.data = [];

                    vm.feedback_lists.loading = false;
                    vm.feedback_lists.total = response.data.total;

                    response.data.data.forEach(function (feedback) {

                        var exists = window._.find(vm.feedback_lists.data, function (item) {
                            return item.id === feedback.id;
                        });

                        if(!exists){
                            vm.feedback_lists.data.push(feedback);
                        }
                    });
                    vm.pagination = response.data.links;
                });
        },
        next: function () {
            this.jobs.url = this.pagination.next;

            this.getFeedbacks();
        },
        prev: function () {
            this.jobs.url = this.pagination.prev;

            this.getFeedbacks();
        }
    },
    mounted : function () {
        this.getFeedbacks();
    }
});