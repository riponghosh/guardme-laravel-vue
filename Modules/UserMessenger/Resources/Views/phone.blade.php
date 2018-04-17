@extends("app::layouts.app")

@push('scripts')
    <script src="/build/js/backend/profile/phone.min.js"></script>
@endpush

@section('app')
    <div class="row bg-title">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="page-title">
                <i class="fa fa-phone"></i>

                <template v-if="action === 'new'"> Phone verification</template>
                <template v-if="action === 'unbind'"> Remove phone number</template>
                <template v-if="action === 'confirm'"> SMS Confirmation</template>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label">
                                Phone Number <template v-if="action === 'confirm'">(<a href="#" @click.prevent="change">change</a>)</template>
                            </label>
                            <div>
                                <input class="form-control" type="text" v-model="phone"
                                       :disabled="action === 'unbind' || (action === 'confirm' && user.phone_verified)" />
                            </div>
                        </div>

                        <div class="form-group collapse" id="confirmation-code">
                            <label class="control-label">Confirmation code</label>
                            <div>
                                <input class="form-control" type="text" v-model="code" />
                            </div>
                        </div>
                    </form>

                    <a href="#" @click.prevent="send" class="btn btn-default">
                        <template v-if="action === 'confirm'">OK!</template>
                        <template v-else-if="action === 'unbind'">Remove Phone Number</template>
                        <template v-else-if="action === 'new'">Send confirmation code</template>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
