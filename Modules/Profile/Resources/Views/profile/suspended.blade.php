
@extends("app::layouts.app")

@section('app')
    <div class="row bg-title">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="page-title"><i class="fa fa-users"></i> Suspended Users</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <table class="table" v-if="users.length > 0">
                        <thead>
                            <th style="width: 5%;">#</th>
                            <th style="width: 30%;">Email</th>
                            <th style="width: 15%;" class="text-center">Status</th>
                            <th style="width: 35%;"></th>
                        </thead>
                        <tbody>
                            <tr v-for="user in users" v-if="user.status == 2">
                                <td>@{{ user.id }}</td>
                                <td><a :href="'/account/profile/' + user.id">@{{ user.email }}</a></td>
                                <td class="text-center" v-html="printStatus(user.status)"></td>
                                <td class="actions text-right">
                                    <button class="btn btn-success waves-effect waves-light" @click.prevent="approve(user.id)" title="Approve"><i class="fa fa-thumbs-up"></i></button>
                                    <button class="btn btn-warning waves-effect waves-light" @click.prevent="disapprove(user.id)" title="Disapprove"><i class="fa fa-thumbs-down"></i></button>
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
        var FETCH_USERS_ENDPOINT = '/api/account/profile/users/suspended';
    </script>

    <script src="/build/js/backend/profile/users.min.js"></script>
@endpush
