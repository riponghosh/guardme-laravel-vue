new window.App({
    el: '#app',

    data() {
        return {
            user : {},
            phone: null,
            code : null,
            action: 'new',
        }
    },

    watch: {
        action: (value) => {
            $('#confirmation-code').collapse(value === 'confirm' ? 'show' : 'hide')
        }
    },

    methods: {
        getUser () {
            window.axios.get(`/api/user`)
                .then((response) => {
                    this.user = response.data

                    if (this.user.phone) {
                        this.phone  = this.user.phone
                        this.action = this.user.phone_verified ? 'unbind' : 'confirm'
                    }
                });
        },

        send() {
            let code  = this.code
            let phone = this.phone
            let url   = '/api/verify/' + (this.action === 'confirm' ? 'confirm' : 'otp')

            window.axios.post(url, { code, phone }).then(response => {
                if (! response.data.hasOwnProperty('error')) {
                    this.callback()
                } else {
                    alert(response.data.error)
                }
            })
        },

        change() {
            this.action = 'new'
        },

        callback() {
            switch (true) {
                case this.action === 'new':
                    this.action = 'confirm'
                    break

                case this.action === 'unbind':
                    this.action = 'confirm'
                    break

                case this.action === 'confirm':
                    this.code = ''

                    if (this.user.phone_verified) {
                        this.phone  = ''
                        this.action = 'new'
                        alert(`Now you can bind another phone.`)
                    } else {
                        this.action = 'unbind'
                        alert(`Phone number ${this.phone} successfully confirmed!`)
                    }

                    this.getUser()

                    break
            }
        }
    },

    mounted: function () {
        this.getUser()
    },
})