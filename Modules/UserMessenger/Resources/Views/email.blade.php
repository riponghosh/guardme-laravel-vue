@extends("app::layouts.app")

@push('scripts')
    <script src="/build/js/backend/profile/email.min.js"></script>
@endpush

@section('app')
    <div class="row bg-title">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="page-title">
                <i class="fa fa-envelope"></i>

                <template v-if="action === 'none'"> Change email</template>
                <template v-if="action === 'change'"> Enter new email address</template>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label">Email</label>

                            <div>
                                <input class="form-control" type="text" v-model="email"
                                       disabled="disabled" />
                            </div>
                        </div>

                        <div class="form-group collapse" id="new-email">
                            <label class="control-label">New email</label>

                            <div>
                                <input class="form-control" type="text" v-model="change" />
                            </div>
                        </div>
                    </form>

                    <a href="#" @click.prevent="act" class="btn btn-default">
                        <template v-if="action === 'none'">Change email</template>
                        <template v-if="action === 'change'">Send confirmation letter</template>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
