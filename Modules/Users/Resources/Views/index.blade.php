@extends("app::layouts.app")

@push('scripts')
    <script src="/build/js/backend/users/index.min.js"></script>
@endpush

@push('modals')
    <a href="#" data-toggle="modal" data-target="#messageModal" id="openMessageModal" style="opacity: 0;"></a>

    <div aria-labelledby="exampleModalLabel" class="modal fade" id="messageModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">×</span>
                    </button>

                    <h5 class="text-center modal-title" id="exampleModalLabel">
                        Send message to @{{ selected.length }} selected user<template v-if="selected.length > 1">s</template>
                    </h5>
                </div>

                <div class="modal-body">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="email"
                               value="email" v-model="type" />
                        <label class="form-check-label ml-2" for="email">
                            Email
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="sms"
                               value="sms" v-model="type" />
                        <label class="form-check-label ml-2" for="sms">
                            SMS
                        </label>
                    </div>

                    <form>
                        <div class="form-group" v-show="type === 'email'">
                            <label for="subject">Subject</label>
                            <input type="email" class="form-control" id="subject"
                                   placeholder="Enter subject" v-model="subject">
                        </div>

                        <div class="form-group">
                            <label for="text">Message</label>
                            <textarea class="form-control" id="text" v-model="text" rows="5"></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <a href="#" :class="['btn btn-primary', { 'btn-disabled': sending }]" @click.prevent="bulk">
                        <template v-if="sending">Sending...</template>
                        <template v-else>Send</template>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endpush

@section('app')
    <div class="row bg-title">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="page-title"><i class="fa fa-phone"></i> Users</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <h2>Filters</h2>

                    <form class="form-inline">
                        <select class="form-control mb-2 mr-sm-2" v-model="role" id="role">
                            <option value="*">Any role</option>
                            <option :value="role.id" v-for="role of roles">@{{ role.name }}</option>
                        </select>

                        <select class="form-control mb-2 mr-sm-2" v-model="status">
                            <option value="*">Any status</option>
                            <option value="0">Unverified</option>
                            <option value="1">Verified</option>
                            <option value="2">Suspended</option>
                            <option value="3">Approved</option>
                            <option value="4">Disapproved</option>
                        </select>

                        <select class="form-control mb-2 mr-sm-2" v-model="city">
                            <option value="*">Any city</option>
                            <option :value="city.id" v-for="city of cities">
                                @{{ city.name }}, @{{ city.county.name }}
                            </option>
                        </select>

                        <input class="form-control mb-2 mr-sm-2" type="date" id="registered_after"
                               v-model="registered_after" />
                        <input class="form-control mb-2 mr-sm-2" type="date" id="registered_before"
                               v-model="registered_before" />
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Category</th>
                            <th scope="col">City</th>
                            <th scope="col">Phone</th>
                            <th scope="col">E-Mail</th>
                            <th scope="col">
                                <a href="#" class="btn btn-info btn-sm" @click.prevent="message(users)">
                                    <i class="fa fa-envelope"></i> Message to all
                                </a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user of users">
                            <th scope="row">@{{ user.id }}</th>
                            <td>@{{ user.username }}</td>
                            <td v-html="printStatus(user.status)"></td>
                            <td>
                                <template v-for="n in user.roles.length">
                                    @{{ user.roles[n - 1].name }} <template v-if="n !== user.roles.length">, </template>
                                </template>
                            </td>
                            <td>
                                <template v-if="user.city">
                                    @{{ user.city.name }}, @{{ user.city.county.name }}
                                </template>
                            </td>
                            <td>@{{ user.phone }}</td>
                            <td>@{{ user.email }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm" @click.prevent="message([user])">
                                    <i class="fa fa-envelope"></i> Message
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
