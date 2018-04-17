@extends("app::layouts.app")

@section('app')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">
                <i class="fa fa-tasks"></i> Active Job Schedule
            </h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 uk-text-right uk-lead">
            You are logged in as: <span class="fg-site-theme">@{{ $root.app.user ? $root.app.user.primaryRole.name : '' }}</span>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="white-box">
                <div class="d-flex justify-content-between">
                    <h3 class="box-title">&mdash; @{{ job ? job.title : '' }}</h3>
                    <a href="/account/jobs/schedule">
                        <i class="icon reply"></i> Back to list
                    </a>
                </div>

                <ul class="nav customtab nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item">
                        <a href="#details" class="nav-link active"
                           aria-controls="details" role="tab" data-toggle="tab"
                           @click="gotoPage('details')"
                           aria-expanded="true">
                            <span class="visible-xs">
                                <i class="fa fa-home"></i>
                            </span>
                            <span class="hidden-xs"> Details</span>
                        </a>
                    </li>
                    @if(hasRole([
                    config('guardme.acl.Employer'),
                    config('guardme.acl.License_partner')
                    ]))
                        <li role="presentation" class="nav-item">
                            <a href="#applicants" class="nav-link"
                               aria-controls="applicants" role="tab" data-toggle="tab"
                               @click="gotoPage('applicants')"
                               aria-expanded="true">
                            <span class="visible-xs">
                                <i class="fa fa-home"></i>
                            </span>
                                <span class="hidden-xs">
                                Applicants
                                <span v-if="job && job.total_applicants">(@{{ job.total_applicants }})</span>
                            </span>
                            </a>
                        </li>
						 <li role="presentation" class="nav-item">
                                <a href="#employees" class="nav-link"
                                   aria-controls="employees" role="tab" data-toggle="tab"
                                   @click="gotoPage('employees')"
                                   aria-expanded="true">
                            <span class="visible-xs">
                                <i class="icon handshake"></i>
                            </span>
                                    <span class="hidden-xs">
                                Hired Employees
                                <span v-if="job && job.total_employees">(@{{ job.total_employees }})</span>
                            </span>
                                </a>
                            </li>
                        <li role="presentation" class="nav-item">
                            <a href="#feedback" class="nav-link"
                               aria-controls="feedback" role="tab" data-toggle="tab"
                               @click="gotoPage('feedback')"
                               aria-expanded="true">
                            <span class="visible-xs">
                                <i class="fa fa-home"></i>
                            </span>
                                <span class="hidden-xs"> Feedback / Comments</span>
                            </a>
                        </li>
                        <li role="presentation" class="nav-item">
                            <a href="#edit" class="nav-link"
                               aria-controls="edit" role="tab" data-toggle="tab"
                               @click="gotoPage('edit')"
                               aria-expanded="true">
                            <span class="visible-xs">
                                <i class="fa fa-home"></i>
                            </span>
                                <span class="hidden-xs"> Edit</span>
                            </a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="details">
                       <div v-if="page == 'details'">
                           <gm-job-details-tab :job="job"> </gm-job-details-tab>
                       </div>
                    </div>
                    <div class="tab-pane" id="applicants">
                        <div v-if="page == 'applicants'">
                            <gm-job-applicants-tab :job="job"> </gm-job-applicants-tab>
                        </div>
                    </div>
					<div class="tab-pane" id="employees">
                            <div v-if="page == 'employees'">
                                <gm-job-employees-tab :job="job"> </gm-job-employees-tab>
                            </div>
                        </div>
                    <div class="tab-pane" id="feedback">
                        <div v-if="page == 'feedback'">
                            <h3>Feedback on job</h3>
                        </div>
                    </div>
                    <div class="tab-pane" id="edit">
                        <div v-if="page == 'edit'">
                            <h3>Edit</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('styles')
    <style>
        .comment-center .mail-contnet .mail-desc {
            height: 76px;
        }
    </style>
    <meta name="jt" content="{{$job_token}}" >

@endpush

@push('scripts')
    <script src="/build/js/backend/jobs/manage-job-schedule.min.js"></script>
@endpush