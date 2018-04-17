class Events {
    constructor() {
        this.vue = new Vue();
    }

    fire(eventName, params) {
        this.vue.$emit(eventName, params);
    }

    on(eventName, callback) {
        this.vue.$on(eventName, callback);
    }
}

window.Events = new Events();

Vue.component('approve-modal', {
    template: `
                <div class="modal" tabindex="-1" role="dialog" :class="{show: show}">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">
                            Do you want to inform the user?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="hide" style="position: absolute; right: 10px; top: 10px;">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        User will get a notification that account has been approved.
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click.prevent="withNotification">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click.prevent="withoutNotification">No</button>
                      </div>
                    </div>
                  </div>
                </div>
    `,

    data() {
        return {
            show: false,
            form: {
                user_id: '',
                with_notification: false
            }
        };
    },

    methods: {
        withNotification() {
            this.form.with_notification = true;

            window.Events.fire('onapprovemodalclose', this.form);

            this.hide();
        },

        withoutNotification() {
            this.form.with_notification = false;

            window.Events.fire('onapprovemodalclose', this.form);

            this.hide();
        },

        hide() {
            this.show = false;
        }
    },

    created() {
        var $this = this;

        window.Events.on('showapprovemodal', function(props) {
            $this.form.user_id = props.user_id;
            $this.show = true;
        });
    }
});

Vue.component('disapprove-modal', {
    template: `
                <div class="modal" tabindex="-1" role="dialog" :class="{show: show}">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">
                            Do you want to inform the user?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="hide" style="position: absolute; right: 10px; top: 10px;">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" v-model="form.title" placeholder="Email Subject"/>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="body" v-model="form.body" placeholder="Email Subject"></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click.prevent="withNotification">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click.prevent="withoutNotification">No</button>
                      </div>
                    </div>
                  </div>
                </div>
    `,

    data() {
        return {
            show: false,
            form: {
                user_id: '',
                title: '',
                body: '',
                with_notification: false
            }
        };
    },

    methods: {
        withNotification() {
            this.form.with_notification = true;

            window.Events.fire('ondisapprovemodalclose', this.form);

            this.hide();
        },

        withoutNotification() {
            this.form.with_notification = false;

            window.Events.fire('ondisapprovemodalclose', this.form);

            this.hide();
        },

        hide() {
            this.show = false;
        }
    },

    created() {
        var $this = this;

        window.Events.on('showdisapprovemodal', function(props) {
            $this.form.user_id = props.user_id;
            $this.show = true;
        });
    }
});

new window.App({
    el: '#app',

    data() {
        return {
            selected_filter: null,

            users: [],

            cities: [],

            date_from: '',

            date_to: '',

            category: '',

            country_id: '',

            city_id: ''
        };
    },

    methods: {
        fetchUsers() {
            window.axios.get(FETCH_USERS_ENDPOINT)
                .then(response => {
                    if (response != undefined && response.statusText == 'OK') {
                        this.users = response.data;
                    }
                });
        },

        filter() {
            var data = {};

            switch (this.selected_filter) {
                case 'new':
                    data = {
                        filter: 'new',
                        date_from: this.date_from,
                        date_to: this.date_to
                    };

                    break;
                case 'verified':
                case 'unverified':
                    data = {
                        filter: this.selected_filter
                    };
                    break;
                case 'city':
                    data = {
                        filter: 'city',
                        country_id: this.country_id,
                        city_id: this.city_id
                    };

                    break;
                case 'category':
                    data = {
                        filter: 'category',
                        category_id: this.category
                    };

                    break;
                default:
                    data = {};
                    break;
            }

            window.axios.post(FETCH_USERS_ENDPOINT, data)
                .then(response => {
                    if (response != undefined && response.statusText == 'OK') {
                        this.users = response.data;
                    }
                });
        },

        printStatus(status) {
            switch (status) {
                case 1:
                    return '<a class="label label-rouded label-default">Unverified</a>';
                    break;
                case 2:
                    return '<a class="label label-rouded label-warning">Suspended</a>';
                    break;
                case 3:
                    return '<a class="label label-rouded label-success">Approved</a>';
                    break;
                case 4:
                    return '<a class="label label-rouded label-danger">Disapproved</a>';
                    break;
            }
        },

        approve(userId) {
            window.Events.fire('showapprovemodal', {user_id: userId});
        },

        onApproveModalClose(props) {
            window.axios.post('/api/account/profile/approve/' + props.user_id, props)
                .then(response => {
                    if (response != undefined && response.statusText == 'OK') {
                        this.updateUserStatus(response.data.user.id, response.data.user.status);
                    }
                });
        },

        disapprove(userId) {
            window.Events.fire('showdisapprovemodal', {user_id: userId});
        },

        onDisapproveModalClose(props) {
            window.axios.post('/api/account/profile/disapprove/' + props.user_id, props)
                .then(response => {
                    if (response != undefined && response.statusText == 'OK') {
                        this.updateUserStatus(response.data.user.id, response.data.user.status);
                    }
                });
        },

        suspend(userId) {
            window.axios.get('/api/account/profile/suspend/' + userId)
                .then(response => {
                    if (response != undefined && response.statusText == 'OK') {
                        this.updateUserStatus(response.data.user.id, response.data.user.status);
                    }
                })
        },

        updateUserStatus(userId, statusId) {
            if (this.users.length > 0) {
                for (var key in this.users) {
                    var user = this.users[key];

                    if (user.id == userId) {
                        user.status = statusId;

                        this.users[key] = user;

                        break;
                    }
                }
            }
        },

        onCountryChange() {
            window.axios.get('/api/app/counties/' + this.country_id + '/cities')
                .then(response => {
                    this.cities = response.data;
                });
        }
    },

    mounted() {
        this.fetchUsers();
    },

    created() {
        var $this = this;

        window.Events.on('onapprovemodalclose', function (props) {
            $this.onApproveModalClose(props);
        });

        window.Events.on('ondisapprovemodalclose', function (props) {
            $this.onDisapproveModalClose(props);
        });
    }
});
