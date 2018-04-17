new window.App({
    el: '#auth',
    data: {
      page: 'login'
    },
/*    data : function(){
        return {
            page: 'login'
        }
    },*/
    methods : {
        togglePage: function () {
            if(this.page === 'login'){
                this.page = 'register';
            } else {
                this.page = 'login';
            }
        }
    },
    components : {
        'gm-login' : require('../blocks/auth/Login.vue'),
        'gm-register' : require('../blocks/auth/Register.vue'),
    },
    created : function(){

    },
    mounted : function () {
        var vm = this;

        var action = vm.$root.getUrlVars()['action'];

        const $body = $('body');

        if(action === 'login'){
            this.page = 'login';
            $body.toggleClass("side-panel-open");
            if( $body.hasClass('device-touch') && $body.hasClass('side-push-panel') ) {
                $body.toggleClass("ohidden");
            }
        }



    }
});