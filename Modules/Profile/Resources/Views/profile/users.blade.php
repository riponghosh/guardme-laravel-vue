@extends("app::layouts.app")

@section('app')
    <div class="row bg-title">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="page-title"><i class="fa fa-users"></i> All Users</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading users-list">
                    <div class="row">
                        <div class="col-lg-2 col-md-12 col-sm-12 filtr-title">
                            Filter Users:
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <select id="filter" name="filter" class="form-control" v-model="selected_filter">
                                <option value="all">All</option>
                                <option value="new">New Accounts</option>
                                <option value="verified">Verified Accounts</option>
                                <option value="unverified">Unverified Accounts</option>
                                <option value="city">City</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="row" v-if="selected_filter == 'new'">
                                <div class="col-lg-5 col-md-12 col-sm-12">
                                    <input type="text" name="date_from" id="date_from" v-model="date_from" class="form-control" placeholder="From YYYY-MM-DD" />
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12">
                                    <input type="text" name="date_to" id="date_to" v-model="date_to" class="form-control" placeholder="To YYYY-MM-DD" />
                                </div>
                                <div class="col-lg-2 col-md-12 col-sm-12 text-center">
                                    <button class="btn btn-success" @click.prevent="filter">Filter</button>
                                </div>
                            </div>
                            <div class="row" v-if="selected_filter == 'verified' || selected_filter == 'unverified'">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button class="btn btn-success" @click.prevent="filter">Filter</button>
                                </div>
                            </div>
                            <div class="row" v-if="selected_filter == 'city'">
                                <div class="col-lg-5 col-md-12 col-sm-12">
                                    <select name="country_id" id="country_id" class="form-control" v-model="country_id" @change="onCountryChange">
                                        <option>Select Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12">
                                    <select name="city_id" id="city_id" class="form-control" v-model="city_id">
                                        <option v-for="city in cities" :value="city.id" v-text="city.name"></option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-12 col-sm-12 text-center">
                                    <button class="btn btn-success" @click.prevent="filter">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table" v-if="users.length > 0">
                        <thead>
                            <th style="width: 5%;">#</th>
                            <th style="width: 30%;">Email</th>
                            <th style="width: 15%;" class="text-center">Status</th>
                            <th style="width: 35%;"></th>
                        </thead>
                        <tbody>
                            <tr v-for="user in users" v-if="user.status != 2">
                                <td>@{{ user.id }}</td>
                                <td><a :href="'/account/profile/' + user.id">@{{ user.email }}</a></td>
                                <td class="text-center" v-html="printStatus(user.status)"></td>
                                <td class="actions text-right">
                                    <button class="btn btn-success waves-effect waves-light" @click.prevent="approve(user.id)" title="Approve"><i class="fa fa-thumbs-up"></i></button>
                                    <button class="btn btn-warning waves-effect waves-light" @click.prevent="disapprove(user.id)" title="Disapprove"><i class="fa fa-thumbs-down"></i></button>
                                    <button class="btn btn-danger waves-effect waves-light" @click.prevent="suspend(user.id)" title="Suspend"><i class="fa fa-pause"></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <approve-modal></approve-modal>
    <disapprove-modal></disapprove-modal>
@endsection

@push('scripts')
    <script>
        var FETCH_USERS_ENDPOINT = '/api/account/profile/users';
    </script>

    <script src="/build/js/backend/profile/users.min.js"></script>
@endpush
