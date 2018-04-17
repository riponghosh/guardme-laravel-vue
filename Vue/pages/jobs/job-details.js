require('../../bootstrap/google-maps');

new window.App({
    el: '#app',
    data : function(){
        return {
            job : null
        }
    },
    methods : {
    },
    components : {

    },
    watch : {

    },
    mounted : function(){
        const job_token = document.head.querySelector('meta[name="jt"]').content;

        this.job = this.$root.decodeToken(job_token).entity;
    }
});