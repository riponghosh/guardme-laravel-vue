new window.App({
    el: '#app',

    data() {
        return {
            users: [],
            roles: [],
            text: '',
            role: '*',
            city: '*',
            cities: [],
            subject: '',
            status: '*',
            selected: [],
            type: 'email',
            sending: false,
            registered_after: '',
            registered_before: '',
        }
    },

    watch: {
        role () {
            this.fetch()
        },
        city () {
            this.fetch()
        },
        status () {
            this.fetch()
        },
        registered_after () {
            this.fetch()
        },
        registered_before () {
            this.fetch()
        },
    },

    methods: {
        printStatus(status) {
            switch (status) {
                case 0:
                    return '<a class="label label-rouded label-default">Unverified</a>';
                    break;
                case 1:
                    return '<a class="label label-rouded label-info">Verified</a>';
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

        getFilters() {
            let role              = this.role,
                city              = this.city,
                status            = this.status,
                registered_after  = this.registered_after,
                registered_before = this.registered_before

            return { role, city, registered_after, registered_before, status }
        },

        fetch () {
            window.axios.post('/api/users/filter', this.getFilters())
                .then(response => {
                    this.users = response.data.users
                })
        },

        message(selected) {
            this.selected = selected

            $('#openMessageModal').click()
        },

        bulk() {
            if (this.sending) {
                return false
            }

            let type    = this.type
            let message = this.text
            let subject = this.subject
            let to      = this.selected.length === 1 ? this.selected[0].id : this.getFilters()

            this.sending = true

            window.axios.post('/api/users/bulk', { message, type, subject, to })
                .then(response => {
                    this.sending = false

                    alert('Messages sent completely')
                })
        }
    },

    mounted () {
        window.axios.post('/api/users/init').then(response => {
            Object.assign(this, response.data)
        })

        this.fetch()
    },
})