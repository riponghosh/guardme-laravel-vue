declare var require:any;
declare var window:any;
declare var Vue:any;

import './bootstrap';

let request_user:any = document.head.querySelector('meta[name="_aut"]');
let api_token:any = document.head.querySelector('meta[name="api-token"]');
var VeeValidate =  require('vee-validate');
const config = {
    errorBagName: 'errors', // change if property conflicts.
    delay: 0,
    locale: 'en',
    messages: null,
    strict: true
};
Vue.use(VeeValidate, config);

Vue.filter('moment', function (value: any, format: any) {
    if(format == undefined) format = "dddd, MMM Do YYYY, h:mmA";
    return window.moment(value).format(format);
});

Vue.filter('dateDiff', function (value: any) {
    return window.moment(value).fromNow();
});

Vue.filter('slugify', function(value: any) {
    value = value.replace(/^\s+|\s+$/g, ''); // trim
    value = value.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
    var to   = "aaaaaeeeeeiiiiooooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        value = value.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    value = value.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return value;
});


// require('./common/init');

export interface UploadableData {
    name: string;
    value: any;
}


window.App = Vue.extend({
    data(){
        return {
            app : {
                loading : true,
                user : null,
                errors : [],
                splashscreen : {
                    show : false,
                    message : ''
                }
            },
            progressIndicator : {
                show : false,
                finite : false,
                progress : 0
            }
        }
    },
    methods : {
        toggleSidebar(){
            window.$('.ui.sidebar.main-sidebar')
                .sidebar('toggle');
        },
        shareFacebook(url: string){
            window.FB.ui({
                method: 'share',
                href: url,
            }, (response: any) =>{

            });
        },
        indicateProgress(show = true, finite = false, progress = 0){
            var vm: any = this;

            vm.progressIndicator.show = show;
            vm.progressIndicator.finite = finite;
            vm.progressIndicator.progress = progress;

        },
        getAuthUser() {
            const vm:any = this;
            const page: any = window.location.pathname;

            if(api_token.content.length){
                window.axios.get('/api/account/auth-user-profile?page='+page)
                    .then(
                        (response: any)=> {
                            vm.app.user = response.data;


                            // todo: subscribe to client channel
                            window.WebApp.socket.subscribe(`/topic/clients.${vm.$root.app.user.id}.#`,
                                (response: any) => {
                                    var received = JSON.parse(response.body);

                                    var data = received.data,
                                        event = received.meta.emit_event;

                                    if(event) window.bus.$emit(event, data);
                                });

                            vm.app.loading = false;
                            window.$('#splashscreen').fadeOut();
                        }
                    )
                    .catch((err: any) => {
                        console.log(err);
                    })
            } else {

            }

        },
        decodeToken(token: any = null){
            if(token){
                const base64Url = token.split('.')[1];
                const base64 = base64Url.replace('-','+').replace('_','/');
                return JSON.parse(window.atob(base64));
            }

            return null;
        },
        byteToMB(byte: number){
            return window._.round((byte / 1024 / 1024), 2);
        },
        readImage(file: any){
            return new Promise((resolve, reject) => {
                if(file){
                    const reader = new FileReader();

                    if(file.type.indexOf('image') !== -1) {
                        reader.onload = (e: any) => {
                            resolve({
                                preview : e.target.result,
                                file : file
                            });
                        }
                    } else {
                        reject(null);
                    }

                    reader.readAsDataURL(file);
                }
            });

        },
        customUrlRequest(url: string, method: string = 'post', data?: Array<UploadableData>) {
            return new Promise((resolve, reject) => {
                const formData: any = new FormData();

                if(data && data.length){
                    data.forEach((dt: any) => {
                        formData.append(dt.name, dt.value);
                    });
                }

                const xhr = new XMLHttpRequest();

                xhr.onreadystatechange = () => {
                    {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                resolve(JSON.parse(xhr.responseText));
                            } else {
                                reject(xhr.response);
                            }
                        }
                    }
                }

                xhr.open(method, url, true);
                xhr.send(formData);
            });
        },
        fetchBlogs(limitPerPage = 6, page = 1){
            var vm:any = this;
            const url = `//blog.talkstuff.com/wp-json/wp/v2/posts?per_page=${limitPerPage}&page=${page}`;
            return vm.customUrlRequest(url, 'get');
        },
        setAppErrors(data:any){
            var vm:any = this;

            if(data.hasError) {
                vm.app.errors.push(data.message);
            } else {
                window._.forIn(data, function(val:any, key:any) {
                    vm.app.errors.push(val[0]);
                });
            }
        },
        getUrlVars() {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        },
        ukNotify(message: string, type: string = 'success'){
            window.UIkit.notification.closeAll();

            window.UIkit.notification({
                message : message,
                status: type,
                pos: 'top-center',
                timeout: 5000
            });
        },
        ukCloseModal(modalId: string){
            window.UIkit.modal(`#${modalId}`).hide();
        },
        ukOpenModal(modalId: string){
            window.UIkit.modal(`#${modalId}`).show();
        },
        init(){
            const vm:any = this;

            if(request_user){
                var user_token = request_user.content;

                if(user_token.length){
                    vm.app.user = vm.decodeToken(user_token).user;

                    //window.WebApp.socket.connect();

                    window.bus.$emit('auth-user', vm.app.user);
                }
            }

            vm.app.loading = false;
            vm.hideSplashScreen();
        },
        greetPerson(name:string){
            var d = new Date();
            var hour = d.getHours();
            var greeting = '';
            const vm:any = this;

            if(hour <= 11){
                greeting = 'Good morning ';
            } else if(hour <= 15){
                greeting = 'Good afternoon ';
            } else if(hour >= 16){
                greeting = 'Good evening ';
            }

            if(!name) name = vm.$root.app.user ? vm.$root.app.user.username : '';
            greeting += name + '!';

            return greeting;
        },
        showSplashScreen(message:string = ''){
            const vm:any = this;

            // if splashscreen has not been shown,
            // then show it
            // otherwise, just skip to setting splashscreen message
            if(!vm.app.splashscreen.show){
                vm.app.splashscreen.show = true;
                window.$(vm.$root.$el).find('#splashscreen').dimmer('show');
            }

            //
            if(message.length) {
                vm.app.splashscreen.message = message;
            }
        },
        hideSplashScreen(){
            const vm:any = this;

            window.$(vm.$root.$el).find('#splashscreen').dimmer('hide');
            vm.app.splashscreen.message = '';
            vm.app.splashscreen.show = false;
        },
    },
    created(){
        const vm:any = this;

        vm.showSplashScreen();
        /*window.WebApp.on('connected', ()=>{
            window.WebApp.socket.subscribe(`${token.content}`,
                (response: any) => {
                    var received = JSON.parse(response.body);

                    console.log('RECEIVED', received);

                    var data = received.data,
                        event = received.meta.emit_event;

                    if(event) window.bus.$emit(event, data);
                });

            window.WebApp.socket.subscribe(`/topic/clients.${vm.app.user.id}.#`,
                (response: any) => {
                    var received = JSON.parse(response.body);

                    var data = received.data,
                        event = received.meta.emit_event;

                    if(event) window.bus.$emit(event, data);
                });

            window.WebApp.socket.subscribe(`/topic/clients.public.#`,
                (response: any) => {
                    var received = JSON.parse(response.body);

                    var data = received.data,
                        event = received.meta.emit_event;

                    if(event) window.bus.$emit(event, data);
                });
        });*/

        window.$(window).scroll(function () {
            if (window.$(window).scrollTop() >= window.$(document).height() - window.$(window).height() - 300) {
                window.bus.$emit('auto-scroll');
            }
        });


    },
    computed : {
        isLoggedIn(){
            var vm:any = this;
            if(vm.app.user && vm.app.user.id){
                return true;
            } else {
                return false;
            }
        },
        userProfileImage(){
            var vm:any = this;
            if(vm.app.user && vm.app.user.id){
                return vm.app.user.profileImage;
            } else {
                return '/assets/images/img_placeholder.png';
            }
        }
    },
    mounted(){
        this.init();
    }
});

Vue.component('gm-response-messenger', require('../blocks/shared/ResponseMessage.vue'));
window.accounting = require('../../Scripts/accounting/accounting.min');

Vue.filter('currency', function (value:any) {
    return window.accounting.formatMoney(value,'£ ');
});
