<template>
    <div :class="[{'error' : message.errors.length}, 'ui form uk-position-right uk-position-medium']"
         style="z-index: 100000">
        <div class="ui message error">
            <div class="header">Oops! We encountered some errors</div>
            <ul class="list">
                <li v-for="error in message.errors">{{ error }}</li>
            </ul>
        </div>
    </div>
</template>
<style>

</style>
<script type="text/babel">

    export default{
        data(){
            return{
                message : {
                    errors : []
                }
            }
        },
        props : ['response_errors'],
        created(){
            var vm = this;

            window.bus.$on('RESPONSE_ERRORS', function (errors) {
                for (var prop in errors) {
                    if (errors.hasOwnProperty(prop)) {
                        var messages = errors[prop];
                        vm.message.errors = [];
                        messages.forEach(function (message) {
                            vm.message.errors.push(message);
                        })
                    }
                }
            })
        }
    }
</script>
