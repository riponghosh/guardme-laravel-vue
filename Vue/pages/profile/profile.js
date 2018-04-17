class Errors{
    constructor() {
        this.formErrors = { };
    }
    get(field) {
        if(this.formErrors[field]) {
            return this.formErrors[field][0];
        }
    }
    record(errors) {
        this.formErrors = errors;
    }
}

new window.App({
    el: '#app',
    data : function(){
        return {
            profile: {
                id: '',
                email: '',
                username: '',
                phone: '',
                dob: '',
                address: '',
                password: '',
                profilePicture: '/assets/img/profile-default.png',
                role_name: '',
                security_badge: '',
                proof_of_work: '',
                visa: '',
                category_id: '',
                country_id: '',
                city_id: ''
            },
            password: null,
            alertMessage: '',
            selectedFile: null,
            uploadProgress: '',
            showUploadBtn: '',
            previewDocument: '',
            formErrors: new Errors(),
            countries: [],
            cities: []
        }
    },
    methods : {
        getUserJobProfile : function (user) {

            window.axios.get(`/api/account/profile/get-user-profile`)
                .then((response) => {
                this.profile.id = response.data.id;
                this.profile.email = response.data.email;
                this.profile.username = response.data.username;
                this.profile.phone = response.data.phone;
                this.profile.dob = response.data.dob;
                this.profile.address = response.data.address;
                this.profile.role_name = response.data.role_name;
                this.profile.security_badge = response.data.security_badge;
                this.profile.proof_of_work = response.data.proof_of_work;
                this.profile.visa = response.data.visa;
                this.profile.category_id = response.data.category_id;
                this.profile.country_id = response.data.country_id;
                this.profile.city_id = response.data.city_id;
                this.countries = response.data.countries;
                this.cities = response.data.cities;
                if (response.data.profile_picture) {
                    this.profile.profilePicture = response.data.profile_picture;
                }
                /*if (response.data.security_badge) {
                    var field = this.getFieldByDocumentType(document_type);
                    var type = this.getFileExtension(response.data.security_badge);
                    if (type != '') {
                        type = type.toLowerCase();
                        if (type == 'jpg' || type == 'png' || type == 'gif' || type == 'jpeg') {
                            this.previewDocument = '<img src="/storage/verification-documents/'+ field +'">'
                        }
                    }
                }*/
        });
        },
        onProfileSubmit : function () {
            this.profile.password = this.password;
            window.axios.post(`/api/account/profile/save-profile-data`, this.profile)
                .then((response) => {
                    console.log(response.data);
                    this.password = '';
                    if (response.data.errors.length == 0) {
                        this.formErrors.record(response.data.errors);
                        this.alertMessage = 'Data has been updated Successfully';
                    } else {
                        this.formErrors.record(response.data.errors);
                    }
                });
        },
        onFileSelected(event) {
            this.showUploadBtn = true;
            this.selectedFile = event.target.files[0];
            this.uploadProgress = 0;
            this.previewThumbnail(event);
        },
        onUpload() {
            const fd = new FormData();
            fd.append('profile_picture', this.selectedFile, this.selectedFile.name);
            axios.post('/api/account/profile/upload-profile-picture', fd, {
                onUploadProgress: uploadEvent => {
                    this.uploadProgress = Math.round(uploadEvent.loaded / uploadEvent.total * 100) + '%';

                }
            })
                .then((response) => {
                    this.formErrors.record(response.data.errors);
                })

        },
        onVerificationDocumentUpload(event, field_name) {
            var selectedDocument = event.target.files[0];
            const fd = new FormData();
            fd.append(field_name, selectedDocument, selectedDocument.name);
            axios.post('/api/account/profile/upload-verification-document', fd, {
                    onUploadProgress: uploadEvent => {
                        this.uploadProgress = Math.round(uploadEvent.loaded / uploadEvent.total * 100) + '%';
                    }
                })
                .then((response) => {
                    this.formErrors.record(response.data.errors);
                    location.reload();
                })
        },
        previewThumbnail: function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var vm = this;

                reader.onload = function(e) {
                    vm.profile.profilePicture = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        },
        getFileExtension: function(file_name) {
            var extension = '';
            var pieces = file_name.split('.');
            if (pieces.length > 0) {
                extension = pieces[(pieces.length) - 1];
            }
            return extension;
        },
        onDocumentPreview(document_type) {
            var field = this.getFieldByDocumentType(document_type);
            var typ = this.getFileExtension(field);
            typ = typ.toLowerCase();
            if(typ == 'pdf') {
                window.open('/storage/verification-documents/'+ field, '_blank');
            } else {
                if (typ != '') {
                    if (typ == 'jpg' || typ == 'png' || typ == 'gif' || typ == 'jpeg') {
                        this.previewDocument = '<img src="/storage/verification-documents/'+ field +'">'
                    }
                }
                $("#document_preview_modal").modal('show');
            }
        },
        getFieldByDocumentType(document_type) {
            var field = '';
            if (document_type == 'security_badge') {
                field = this.profile.security_badge;
            } else if (document_type == 'proof_of_work') {
                field = this.profile.proof_of_work;
            } else if (document_type == 'visa') {
                field = this.profile.visa;
            }
            return field;
        },
        onCountryChange() {
            window.axios.get('/api/app/counties/' + this.profile.country_id + '/cities')
                .then(response => {
                    this.cities = response.data;
                });
        }
    },
    components : {

    },
    mounted: function () {
        this.getUserJobProfile();
    },
    created : function(){

    }
});
