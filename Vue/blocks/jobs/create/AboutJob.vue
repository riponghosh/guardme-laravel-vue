<template>
    <div>
        <div class="card nobottommargin">
            <div class="card-body ui form" style="padding: 40px;">
                <form @submit.prevent="validateForm('new-job-form')" data-vv-scope="new-job-form"
                      class="nobottommargin">

                    <h2 class="mb-5">
                        About The Job
                    </h2>


                    <div class="col_full">
                        <label for="job_title">Job Title:</label>
                        <input type="text" id="job_title" name="title"
                               v-model="job.title"
                               class="form-control" />
                        <span v-show="errors.has('new-job-form.title')" class="d-inline-block uk-text-small uk-text-danger">
                            {{ errors.first('new-job-form.title') }}
                        </span>
                    </div>

                    <div class="col_full">
                        <label>Job description</label>
                        <textarea placeholder="Enter a brief job description" name="description"
                                  v-validate="'required'" rows="3"
                                  v-model="job.description"></textarea>
                        <span v-show="errors.has('new-job-form.description')"
                              class="d-inline-block uk-text-small uk-text-danger">
                             {{ errors.first('new-job-form.description') }}
                           </span>
                    </div>

                    <div class="col_full">
                        <div class="row my-3">
                            <div class="col-5">
                                <div class="fluid mb-5">
                                    <label>Your company:</label>
                                    <div class="fluid">
                                        <select class="selectpicker" v-model="job.company">
                                            <option>Select your company...</option>
                                            <option :value="company.id" v-for="company in companies.data">{{ company.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="">
                                    <label>Job location:</label>

                                    <div class=" fluid">
                                        <input type="text" name="postcode" v-model.lazy="job.postcode"
                                               placeholder="Your postcode:">
                                        <span v-show="errors.has('new-job-form.postcode')"
                                              class="d-inline-block uk-text-small uk-text-danger">
                                        {{ errors.first('new-job-form.postcode') }}
                                     </span>
                                    </div>

                                    <div class=" fluid">
                                        <input type="text" name="houseNumber" v-model="job.address.houseNumber"
                                               placeholder="House number:">
                                        <span v-show="errors.has('new-job-form.houseNumber')"
                                              class="d-inline-block uk-text-small uk-text-danger">
                                            {{ errors.first('new-job-form.houseNumber') }}
                                        </span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-7">
                                <div class="field">
                                    <label>Google map:</label>
                                    <div class="fluid">
                                        <google-map name="job_address" :height="210"
                                                    :loading="job.loadingAddress"
                                                    :markers="[{latitude: job.address.coord.latitude, longitude: job.address.coord.longitude}]">
                                        </google-map>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col_full">
                        <div class="">
                            <label>Category: <small class="uk-text-meta">(Choose all that apply)</small></label>
                            <div class="fluid d-flex justify-content-between row">
                                <div class="inline field col-6" v-for="category in categories.data">
                                    <div class="ui checkbox">
                                        <input type="checkbox" :value="category.id" name="job.categories"
                                               v-model="job.categories" tabindex="0" class="hidden">
                                        <label>{{ category.name }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col_full">
                        <div class="">
                            <label>Sectors: <small class="uk-text-meta">(Choose all that apply)</small></label>
                            <div class="fluid d-flex justify-content-between row">
                                <div class="inline field col-6" v-for="sector in sectors.data">
                                    <div class="ui checkbox">
                                        <input type="checkbox" :value="sector.id" name="job.sectors"
                                               v-model="job.sectors" tabindex="0" class="hidden">
                                        <label>{{ sector.name }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col_full nobottommargin">
                        <button class="button button-3d button-green nomargin" type="submit">Continue</button>
                    </div>

                </form>
            </div>
        </div>
        <!--<div class="ui modal small new-company" style="bottom: unset;">
            <div class="header">Add New Company / Organization</div>
            <div class="content">
                <form @submit.prevent="validateNewCompanyForm('new-company-form')"
                      :class="[{'loading' : company.saving}, 'ui form']"
                      data-vv-scope="new-company-form">
                    <div :class="[{error : errors.has('new-company-form.name')}, 'field']">
                        <label>Name of company / organization:</label>
                        <input type="text" name="name" v-model="company.data.name"
                               placeholder="Your company name:"
                               v-validate="'required'">
                        <span v-show="errors.has('new-company-form.name')"
                              class="d-inline-block uk-text-small uk-text-danger">
                            {{ errors.first('new-company-form.name') }}
                        </span>
                    </div>

                    <div class="row my-3">
                        <div class="col-5">
                            <div class="field">
                                <label>Company address:</label>

                                <div class=" fluid">
                                    <input type="text" name="postcode" v-model.lazy="company.data.postcode"
                                           placeholder="Your company postcode:" >
                                    <span v-show="errors.has('new-company-form.postcode')"
                                          class="d-inline-block uk-text-small uk-text-danger">
                                        {{ errors.first('new-company-form.postcode') }}
                                     </span>
                                </div>

                                <div class=" fluid">
                                    <input type="text" name="houseNumber" v-model="company.data.houseNumber"
                                           placeholder="Building number:">
                                    <span v-show="errors.has('new-company-form.houseNumber')"
                                          class="d-inline-block uk-text-small uk-text-danger">
                                        {{ errors.first('new-company-form.houseNumber') }}
                                    </span>
                                </div>

                                <div :class="[{error : errors.has('new-company-form.company_email')}, 'my-3']">
                                    <label>Corporate Email:</label>
                                    <input type="text" name="company_email" v-model="company.data.email"
                                           placeholder="Your company email:"
                                           v-validate="'required|email'">
                                    <span v-show="errors.has('new-company-form.company_email')"
                                          class="d-inline-block uk-text-small uk-text-danger">
                                        {{ errors.first('new-company-form.company_email') }}
                                     </span>
                                </div>

                                <div :class="[{error : errors.has('new-company-form.company_phone')}, 'my-3']">
                                    <label>Corporate Phone:</label>
                                    <input type="text" name="company_phone" v-model="company.data.phone"
                                           placeholder="Your company phone:"
                                           v-validate="'required'">
                                    <span v-show="errors.has('new-company-form.company_phone')"
                                          class="d-inline-block uk-text-small uk-text-danger">
                                        {{ errors.first('new-company-form.company_phone') }}
                                     </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-7">
                            <div class="field">
                                <label>Google map:</label>
                                <div class="fluid">
                                    <google-map name="company_address" :height="300"
                                                :loading="company.loadingAddress"
                                                :markers="[{latitude: company.data.address.coord.latitude,
                                                longitude: company.data.address.coord.latitude}]">
                                    </google-map>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field my-3">
                        <button class="ui button primary float-none mini" type="submit">
                            Create <i class="icon check circle"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>-->
    </div>
</template>
<style scoped>

</style>
<script type="text/babel">

    export default{
        data(){
            return{
                company : {
                    data : {
                        name : '',
                        email : '',
                        phone : '',
                        postcode : '',
                        houseNumber : '',
                        address : {
                            line1 : '',
                            line2 : '',
                            line3 : '',
                            line4 : '',
                            locality : '',
                            city : '',
                            county : '',
                            coord : {
                                latitude : '',
                                longitude : ''
                            },
                            houseNumber : '',
                        }

                    },
                    saving : false,
                    loadingAddress : false
                },
                companies : {
                    data : [],
                    loading : false
                },
                job : {
                    title: '',
                    description : '',
                    address : {
                        line1 : '',
                        line2 : '',
                        line3 : '',
                        line4 : '',
                        locality : '',
                        city : '',
                        county : '',
                        coord : {
                            latt : '',
                            long : ''
                        },
                        houseNumber : '',
                    },
                    county : 0,
                    city : 0,
                    postcode : '',
                    date : {
                        start : '',
                        end : ''
                    },
                    wages : 0,
                    rating : 0,
                    company : null,
                    categories : [],
                    sectors : [],
                    broadcastsConfig : [],
                    loadingAddress : false
                },
                categories : {
                    data : [],
                    loading : false
                },
                sectors : {
                    data : [],
                    loading : false
                },
            }
        },
        methods : {
            continue(){
                this.$emit('submitted', this.job)
            },
            validateForm: function(scope) {
                var vm = this;

                this.$validator.validateAll(scope).then(function(result) {
                    if (result) {
                        vm.continue();
                    } else {
                        alert('You have provided invalid data. Please check again!')
                    }
                });
            },
            validateNewCompanyForm: function(scope) {
                var vm = this;

                this.$validator.validateAll(scope).then(function(result) {
                    if (result) {
                        vm.saveCompany();
                    } else {
                        alert('You have provided invalid data. Please check again!')
                    }
                });
            },
            saveCompany: function () {
                var vm = this;

                vm.company.saving = true;



                window.axios.post('/api/companies/new', vm.company.data)
                        .then(
                                function (response) {
                                    vm.$root.ukNotify(response.data.name + ' has been successfully created!');
                                    alert(response.data.name + ' has been successfully created!');

                                    vm.companies.data.push(response.data);

                                    $('.ui.modal.new-company')
                                            .modal('hide')
                                    ;

                                    vm.company.saving = false;

                                    vm.company.data = {
                                        name : '',
                                        email : '',
                                        phone : '',
                                        postcode : '',
                                        houseNumber : '',
                                        address : {
                                            line1 : '',
                                            line2 : '',
                                            line3 : '',
                                            line4 : '',
                                            locality : '',
                                            city : '',
                                            county : '',
                                            coord : {
                                                latt : '',
                                                long : ''
                                            },
                                            houseNumber : '',
                                        }
                                    };

                                }
                        )
                        .catch((e) => {
                            vm.company.saving = false;

                        });
            },
            newCompanyModal : function () {
                $('.ui.modal.new-company')
                        .modal('show')
                ;
            },
            loadCompanies : function () {
                var vm = this;
                vm.companies.loading = true;

                window.axios.get('/api/companies/auth')
                        .then(function (response) {

                            response.data.forEach(function (company) {
                                vm.companies.data.push(company);
                            });

                            vm.companies.loading = false;
                        });
            },
            getAddress: _.debounce(function(postcode, houseNumber){
                const vm = this;

                if(postcode && houseNumber){
                    var url = 'https://api.getAddress.io/find/'
                            + postcode + '/'
                            + houseNumber
                            + '?api-key='
                            + process.env.MIX_GET_ADDRESS_KEY;

                    vm.job.loadingAddress = true;

                    vm.$root.customUrlRequest(url, 'get').then(
                            function (response) {
                                const addresses = response.addresses[0].split(',');

                                vm.job.address.line1 = addresses[0].trim();
                                vm.job.address.line2 = addresses[1].trim();
                                vm.job.address.line3 = addresses[2].trim();
                                vm.job.address.line4 = addresses[3].trim();
                                vm.job.address.locality = addresses[4].trim();
                                vm.job.address.city = addresses[5].trim();
                                vm.job.address.county = addresses[6].trim();
                                vm.job.address.coord.latitude = response.latitude;
                                vm.job.address.coord.longitude = response.longitude;

                                vm.job.loadingAddress = false;
                            }
                    ).catch(function (e) {
                        vm.job.address.line1 = '';
                        vm.job.address.line2 = '';
                        vm.job.address.line3 = '';
                        vm.job.address.line4 = '';
                        vm.job.address.locality = '';
                        vm.job.address.city = '';
                        vm.job.address.county = '';
                        vm.job.address.coord.latt = '';
                        vm.job.address.coord.long = '';
                    });
                } else {
                    console.log('INVALID', postcode, houseNumber);
                }
            }, 1500),
            getCompanyAddress: _.debounce(function (postcode, houseNumber) {
                const vm = this;

                if(postcode && houseNumber){
                    var url = 'https://api.getAddress.io/find/'
                            + postcode + '/'
                            + houseNumber
                            + '?api-key='
                            + process.env.MIX_GET_ADDRESS_KEY;

                    vm.company.loadingAddress = true;

                    vm.$root.customUrlRequest(url, 'get').then(
                            function (response) {
                                const addresses = response.addresses[0].split(',');

                                vm.company.data.address.line1 = addresses[0].trim();
                                vm.company.data.address.line2 = addresses[1].trim();
                                vm.company.data.address.line3 = addresses[2].trim();
                                vm.company.data.address.line4 = addresses[3].trim();
                                vm.company.data.address.locality = addresses[4].trim();
                                vm.company.data.address.city = addresses[5].trim();
                                vm.company.data.address.county = addresses[6].trim();
                                vm.company.data.address.coord.latitude = response.latitude;
                                vm.company.data.address.coord.longitude = response.longitude;

                                vm.company.loadingAddress = false;

                            }
                    ).catch(function (e) {
                        vm.resetCompanyAddress();
                    });
                } else {
                    console.log('INVALID', postcode, houseNumber);
                }

            }, 1500),
            loadCategories : function () {
                var vm = this;
                vm.categories.loading = true;

                window.axios.get('/api/app/categories')
                        .then(function (response) {

                            response.data.forEach(function (category) {
                                vm.categories.data.push(category);
                            });

                            setTimeout(function () {
                                $('.ui.checkbox')
                                        .checkbox()
                                ;
                            }, 1000);

                            vm.categories.loading = false;
                        });
            },
            loadSectors : function () {
                var vm = this;
                vm.sectors.loading = true;

                window.axios.get('/api/app/sectors')
                        .then(function (response) {

                            response.data.forEach(function (sector) {
                                vm.sectors.data.push(sector);
                            });

                            setTimeout(function () {
                                $('.ui.checkbox')
                                        .checkbox()
                                ;
                            }, 1000);

                            vm.sectors.loading = false;
                        });
            },

            resetCompanyAddress : function () {
                const vm = this;

                vm.company.data.address.line1 = '';
                vm.company.data.address.line2 = '';
                vm.company.data.address.line3 = '';
                vm.company.data.address.line4 = '';
                vm.company.data.address.locality = '';
                vm.company.data.address.city = '';
                vm.company.data.address.county = '';
                vm.company.data.address.coord.latitude = '';
                vm.company.data.address.coord.longitude = '';
            }
        },
        mounted(){
            this.loadCompanies();
            this.loadCategories();
            this.loadSectors();
        },
        watch : {
            'job.company' : function(newValue, oldValue){
                if(newValue == 'new'){
                    this.job.company = null;
                    this.newCompanyModal();
                } else {
                    this.job.company = newValue;
                }
            },
            'job.postcode' : function (newPostcode, oldPostCode) {
                this.getAddress(newPostcode, this.job.address.houseNumber);
            },
            'job.address.houseNumber' : function (newHouseNumber, oldHouseNumber) {
                this.getAddress(this.job.postcode, newHouseNumber);
            },
            'company.data.postcode' : function (newPostcode, oldPostCode) {
                this.getCompanyAddress(newPostcode, this.company.data.houseNumber)
            },
            'company.data.houseNumber' : function (newHouseNumber, oldHouseNumber) {
                this.getCompanyAddress(this.company.data.postcode, newHouseNumber);
            }
        }
    }
</script>
