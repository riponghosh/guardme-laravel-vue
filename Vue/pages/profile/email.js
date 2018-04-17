new window.App({
    el: '#app',

    data() {
        return {
            user : {},
            email: null,
            code_old: null,
            code_new: null,
            change: null,
            action: 'none',
        }
    },

    watch: {
        action: (value) => {
            $('#new-email').collapse(value === 'change' || value === 'confirm' ? 'show' : 'hide')
            $('#confirmation-code').collapse(value === 'confirm' ? 'show' : 'hide')
        }
    },

    methods: {
        getUser () {
            window.axios.get(`/api/user`)
                .then((response) => {
                    this.user = response.data

                    if (this.user.email) {
                        this.email = this.user.email
                    }
                });
        },

        act () {
            let change   = this.change
            let code_old = this.code_old
            let code_new = this.code_new

            switch (this.action) {
                case 'none':
                    this.action = 'change'
                    break

                case 'change':
                    window.axios.post('/api/verify/change', { change }).then(response => {
                        if (! response.data.hasOwnProperty('error')) {
                            alert('We have sent confirmation letter to your old email address.')
                        } else {
                            alert(response.data.error)
                        }
                    })
                    break
            }
        },
    },

    mounted: function () {
        this.getUser()
    },
})