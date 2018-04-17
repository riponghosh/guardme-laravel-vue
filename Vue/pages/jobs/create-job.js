require('../../bootstrap/google-maps');

new window.App({
    el: '#app',
    data : function(){
        return {
            step : 1,
            job : null
        }
    },
    methods : {
        goto2: function (job) {
            this.job = job;
            this.step = 2;
        }
    },
    components : {
        'gm-about-new-job' : require('../../blocks/jobs/create/AboutJob.vue'),
        'gm-job-work-details' : require('../../blocks/jobs/create/JobWorkDetails.vue'),
       // 'gm-job-payment' : require('../../blocks/jobs/create/Payment.vue'),
    },
    watch : {

    },
    mounted : function(){

    }
});