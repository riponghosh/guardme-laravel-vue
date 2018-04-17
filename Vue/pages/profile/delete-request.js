new window.App({
    el: '#app',
    data : function(){
        return {
            reasons: [],
            more_info: '',
            alertMessage: ''
        }
    },
    methods : {
        onSubmitDeleteRequest() {
            const fd = new FormData();
            fd.append('reasons', this.reasons);
            fd.append('more_info', this.more_info);
            window.axios.post(`/api/account/profile/delete-request`, fd)
                .then((response) => {
                    if (response.data.errors.length == 0) {
                        this.reasons = [];
                        this.more_info = '';
                        this.alertMessage = 'We have received your request to close your account. The process will take up to 72 hours. After closure, you will still have access to your privacy dashboard. We wish you all the best. <br><br> From your friends at GuardME';
                    }
                });
        }
    },
    components : {

    },
    mounted: function () {
    },
    created : function() {

    }
});