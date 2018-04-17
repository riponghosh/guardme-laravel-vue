new window.App({
    el: '#app',
    data : function(){
        return {

        }
    },
    methods : {
        previewMember : function () {
            // todo: hide preview box before continuing

            // todo: fetch required data before showing preview box
            window.$('div.table-container div.table-details-preview').addClass('opened');
        },
        closePreview : function () {
            window.$('div.table-container div.table-details-preview').removeClass('opened');

        }
    },
    components : {

    },
    created : function(){

    },
    mounted : function () {

    }
});