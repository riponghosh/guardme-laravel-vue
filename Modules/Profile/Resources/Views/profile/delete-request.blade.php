@extends("app::layouts.app")
<style>
.form-check-label {
    padding-left: 20px !important;
}
</style>
@section('app')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-home"></i> Profile Delete </h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 uk-text-right uk-lead">
            You are logged in as: <span class="fg-site-theme">@{{ $root.app.user ? $root.app.user.primaryRole.name : '' }}</span>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="alert alert-success" role="alert" v-if="alertMessage" v-html="alertMessage"></div>
                <div class="panel-body">
                    <form method="POST" @submit.prevent="onSubmitDeleteRequest">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Why do you want to close your account? </label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Lorem Ipsum is simply dummy text of the" id="reason1" v-model="reasons">
                                <label class="form-check-label" for="reason1">
                                    Lorem Ipsum is simply dummy text of the
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Neque porro quisquam est qui dolorem ipsum" id="reason2" v-model="reasons">
                                <label class="form-check-label" for="reason2">
                                    Neque porro quisquam est qui dolorem ipsum
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Contrary to popular belief, Lorem Ipsum is not simply random text." id="reason3" v-model="reasons">
                                <label class="form-check-label" for="reason3">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="It is a long established fact that a reader will be distracted" id="reason4" v-model="reasons">
                                <label class="form-check-label" for="reason4">
                                    It is a long established fact that a reader will be distracted
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="There are many variations of passages of Lorem Ipsum available" id="reason5" v-model="reasons">
                                <label class="form-check-label" for="reason5">
                                    There are many variations of passages of Lorem Ipsum available
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="The standard chunk of Lorem Ipsum used since" id="reason6" v-model="reasons">
                                <label class="form-check-label" for="reason6">
                                    The standard chunk of Lorem Ipsum used since
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">More information (Optional) </label>
                            <div>
                                <textarea class="form-control" rows="6" name="more_info" placeholder="" v-model="more_info"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Delete My Account" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')
    <script src="/build/js/backend/profile/delete-request.min.js"></script>
@endpush