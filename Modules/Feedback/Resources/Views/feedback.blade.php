@extends("app::layouts.app")

@section('app')
    @php
    $pageTitle = 'Feedback'
    @endphp


    <div id="job-complete-modal">
        <div class="uk-modal-dialog" v-if="$root.selected_job">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <div class="uk-modal-header">
                <h2 class="uk-modal-title">
                    <span >Job Feedback:</span>
                    <small class="fg-site-blue">
                        <br>
                        @{{ $root.selected_job.title }}
                    </small>
                </h2>
            </div>

            <div class="uk-modal-body pt-2" uk-overflow-auto>
                <div class="ui active centered inline loader" v-show="$root.employees.loading"></div>
                <table class="uk-table uk-table-divider" v-if="$root.employees.data.length">
                    <thead>
                    <tr>
                        <th>Personnel</th>
                        <th>Date</th>
                        <th>Wages</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in employees.data">
                        <td>@{{ user.username }}</td>
                        <td>
                            <span class="text-muted">
                                <i class="fa fa-clock-o"></i> @{{ user.hired_at }}
                            </span>
                        </td>
                        <td>
                            @{{ selected_job.offer | currency }}
                        </td>
                        <td class="uk-text-right">
                            <a class="ui blue image label tiny" href="javascript:void(0);"
                               @click.prevent="giveFeedback(user)">
                               <i class="icon reply"></i>
                                Give Feedback
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="uk-placeholder uk-text-center" v-else>No employee(s) found</div>
            </div>

            <div class="uk-modal-footer animated fadeInDown uk-background-muted"
                 v-if="selected_employee">
                <div>
                    <h3 class="uk-h2 mt-0 mb-3">
                        <i class="fa fa-bullhorn"></i>
                        Feedback to security personnel
                        <small class="fg-site-blue">
                            (@{{ selected_employee.username }})
                        </small>
                    </h3>
                </div>

                <div class="mb-4">
                    <div class="fluid d-block" v-for="rating in ratings.data">
                        <div class="ui star rating skills_rating huge float-none"
                             :data-rating-id="rating.id"
                             data-max-rating="5"></div> @{{ rating.name }}
                    </div>
                </div>

                <div class="ui fluid left small icon input">
                    <i class="comment icon"></i>
                    <input type="text" placeholder="Share your experience about this personnel...." v-model="feedback.comment">
                </div>

                <div class="mt-3">
                    <button class="ui button icon" @click="cancelFeedback()">
                        Cancel
                    </button>
                    <button class="ui button icon green" @click="submitFeedback()">
                        Submit feedback
                    </button>
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
@endpush

@push('scripts')
    <script src="/build/js/backend/jobs/active-schedule.min.js"></script>
@endpush