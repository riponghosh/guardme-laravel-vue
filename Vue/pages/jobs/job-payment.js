require('../../bootstrap/google-maps');

new window.App({
    el: '#app',
    data : function(){
        return {
            step : 3,
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
        //'gm-job-payment' : require('../../blocks/jobs/create/Payment.vue'),
    },
    watch : {

    },
    mounted : function(){
		const job_token = document.head.querySelector('meta[name="jt"]').content;

		this.job = this.$root.decodeToken(job_token).entity;
    }
});