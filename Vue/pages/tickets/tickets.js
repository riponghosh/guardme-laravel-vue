
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

    },
    watch : {

    },
    mounted : function(){

    }
});