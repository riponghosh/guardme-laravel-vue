@extends("app::layouts.app")
<style>
    .profile-picture {
        border-radius: 4px;
        margin-bottom: 5px;
        width: 160px;
        height: 170px;
    }
    .select-image {
        color: #fff;
        background: rgba(0, 0, 0, 0.5);
        height: 30px;
        position: relative;
        text-align: center;
        top: -35px;
        cursor: pointer;
    }
    .upload-btn {
        position: relative;
        top: -30px;
    }
</style>
@section('app')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-home"></i> Profile </h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 uk-text-right uk-lead">
            You are logged in as: <span class="fg-site-theme">@{{ $root.app.user ? $root.app.user.primaryRole.name : '' }}</span>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="alert alert-success" role="alert" v-if="alertMessage" v-text="alertMessage"></div>
                <div class="panel-body">
                    @if (auth()->user()->isApproved())
                    <div class="row">
                        <div class="col-md-2">
                            <div class="text-center text-success"><i class="fa fa-check"></i> Approved</div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-2">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" :style="{width: uploadProgress }" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <img class="profile-picture" :src="profile.profilePicture" alt="">
                            <input type="file" ref="fileInput" @change="onFileSelected" style="display: none;">
                            <div class="select-image" @click="$refs.fileInput.click()">
                                Choose Profile Picture
                            </div>
                            <button v-if="showUploadBtn" class="btn btn-primary upload-btn" @click="onUpload">Upload</button>
                        </div>
                        <div class="col-md-10">
                            <span class="text-danger" v-text="formErrors.get('profile_picture')"></span>
                        </div>
                    </div>

                    <div class="row choose-account-type">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            @if (!auth()->user()->hasRole('Job Seeker') && !auth()->user()->hasRole('Employer') && !auth()->user()->hasRole('Admin'))
                            <a href="/account/profile/gotoemployer" class="btn btn-primary">Apply for an employer account</a>
                            <a href="/account/profile/gotosecurity" class="btn btn-success">Apply for a security personnel account</a>
                            @endif

                            @if (auth()->user()->hasRole('Job Seeker'))
                            <a href="/account/profile/gotoemployer" class="btn btn-primary">Switch to employer</a>
                            @endif

                            @if (auth()->user()->hasRole('Employer'))
                            <a href="/account/profile/gotosecurity" class="btn btn-success">Switch to security personnel</a>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('profile.save') }}" method="POST" enctype="multipart/form-data" @submit.prevent="onProfileSubmit">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label">Account Information: </label>
                            <div>
                                <input class="form-control" type="text" :value="profile.role_name" disabled/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Username: </label>
                            <div>
                                <input class="form-control" type="text" name="username" placeholder="Username" v-model="profile.username"/>
                            </div>
                            <span class="text-danger" v-text="formErrors.get('username')"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Email (<a href="/confirm/email">change</a>): </label>
                            <div>
                                <input class="form-control" type="text" name="email" placeholder="Email"
                                       v-model="profile.email" disabled="disabled"/>
                            </div>
                            <span class="text-danger" v-text="formErrors.get('email')"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Date of Birth: </label>
                            <div>
                                <input class="form-control" type="text" name="dob" placeholder="mm-dd-yyyy" v-model="profile.dob"/>
                            </div>
                            <span class="text-danger" v-if="formErrors.get('dob')" v-text="formErrors.get('dob')"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Country</label>
                            <div>
                                <select class="form-control" name="country" v-model="profile.country_id" @change="onCountryChange">
                                    <option v-for="country in countries" :value="country.id" v-text="country.name"></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" v-if="cities.length > 0">
                            <label class="control-label">City</label>
                            <div>
                                <select class="form-control" name="city" v-model="profile.city_id">
                                    <option v-for="city in cities" :value="city.id" v-text="city.name"></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Address: </label>
                            <div>
                                <input class="form-control" type="text" name="address" placeholder="Address" v-model="profile.address"/>
                            </div>
                            <span class="text-danger" v-text="formErrors.get('address')"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Phone Number (<a href="/confirm/phone">change</a>): </label>
                            <div>
                                <input class="form-control" type="text" name="phone_number" placeholder="Phone Number"
                                       v-model="profile.phone" disabled="disabled" />
                            </div>
                            <span class="text-danger" v-text="formErrors.get('phone_number')"></span>
                        </div>

                        @if (auth()->user()->hasRole('Employer'))
                        <div class="form-group">
                            <label class="control-label">Business category</label>
                            <div>
                                <select name="category_id" class="form-control" v-model="profile.category_id">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label class="control-label">Password: </label>
                            <div>
                                <input class="form-control" type="password" name="password" placeholder="Password" v-model="password"/>
                            </div>
                            <span class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .choose-account-type {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .choose-account-type a.btn {
            margin-right: 10px;
        }
    </style>
@endpush

@push('scripts')
    <script src="/build/js/backend/profile/profile.min.js"></script>
@endpush
