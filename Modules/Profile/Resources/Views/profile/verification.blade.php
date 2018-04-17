@extends("app::layouts.app")
<style>
    .badges-row {
        margin-top: 10px;
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
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" :style="{width: uploadProgress }" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row badges-row">
                        <div class="col-md-4">Security badge</div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" @click="$refs.securityBadgeFileInput.click()">Upload</button>
                            <input type="file" @change="onVerificationDocumentUpload($event, 'security_badge')" ref="securityBadgeFileInput" style="display: none;" name="security_badge">
                        </div>
                        <div class="col-md-4"><a class="security-badge-preview" @click="onDocumentPreview('security_badge')">Preview Document</a><i v-if="profile.security_badge" class="text-success fa fa-check"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-danger" v-text="formErrors.get('security_badge')"></span>
                        </div>
                    </div>
                    <div class="row badges-row">
                        <div class="col-md-4">Proof of work</div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" @click="$refs.proofofWorkFileInput.click()">Upload</button>
                            <input type="file" @change="onVerificationDocumentUpload($event, 'proof_of_work')" ref="proofofWorkFileInput" style="display: none;" name="proof_of_work">
                        </div>
                        <div class="col-md-4"><a class="proof-of-work-preview" @click="onDocumentPreview('proof_of_work')">Preview Document</a> <i v-if="profile.proof_of_work" class="text-success fa fa-check"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-danger" v-text="formErrors.get('proof_of_work')"></span>
                        </div>
                    </div>
                    <div class="row badges-row">
                        <div class="col-md-4">Visa Page</div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" @click="$refs.visa.click()">Upload</button>
                            <input type="file" @change="onVerificationDocumentUpload($event, 'visa')" ref="visa" style="display: none;" name="visa">
                        </div>
                        <div class="col-md-4"><a class="visa-preview" @click="onDocumentPreview('visa')">Preview Document</a><i v-if="profile.visa" class="text-success fa fa-check"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-danger" v-text="formErrors.get('visa')"></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" id="document_preview_modal" tabindex="-1" role="dialog" aria-labelledby="security_badge_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Security Badge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" v-html="previewDocument">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')
    <script src="/build/js/backend/profile/profile.min.js"></script>
@endpush