@extends("app::layouts.app")

@section('app')
    <h1>Referrals</h1>
    <div class="col-md-8" style="margin-bottom: 10px;">
        <form class="form-inline">
            <div class="form-group">
                <input id="linkUrl" readonly type="text" class="form-control" placeholder="Referral Code" value="{{ config('app.url') }}?ref={{ $referral_code }}">
                <button type="button" data-toggle="modal" @click="copyUrl()" class="btn btn-primary">@{{ copyText }}</button>
            </div>
        </form>
{{--        <div style="margin-top: 10px;">
            <b>Link : </b>
            <span id="linkUrl">{{ config('app.url') }}?ref=@{{ url }}</span>
            <button v-show="copyBtn" class="btn btn-sm btn-info" @click="copyUrl('{{ config('app.url') }}?ref=')">@{{ copyText }}</button>
        </div>--}}
    </div>
    <div class="col-md-4">
        <div style="margin-bottom: 10px;" class="pull-right">
            <select onchange="location = this.value" class="form-control">
                <option value="{{ route('loyalty.index') }}">Select</option>
                <option {{ request('filter') == 'newest' ? 'selected' : '' }} value="{{ route('loyalty.index', ['filter' => 'newest']) }}">Newest</option>
                <option {{ request('filter') == 'oldest' ? 'selected' : '' }} value="{{ route('loyalty.index', ['filter' => 'oldest']) }}">Oldest</option>
                {{--<option {{ request('filter') == 'expired' ? 'selected' : '' }} value="{{ route('loyalty.index', ['filter' => 'expired']) }}">Expired Invitation</option>--}}
            </select>
        </div>
    </div>
    @if (!empty($loyalties))
        <table class="ui table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Signup Date</th>
                    <th>First Job Date</th>
                    <th>Credit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loyalties as $loyalty)
                <tr>
                    <td>{{ $loyalty->username }}</td>
                    <td>{{ implode(",", array_column($loyalty->roles->toArray(), "name")) }}</td>
                    <td align="center">{{ $loyalty->registered_date->format('Y-m-d') }}</td>
                    <td align="center">{{ optional($loyalty->firstJobsApplications->first())->hired_at }}</td>
                    <td align="center">{{ $loyalty->loyalties->sum('credit') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $loyalties->links() }}
    @endif

    @if(!empty($expired_lists))
        <table class="ui table">
            <thead>
            <tr>
                <th>Url</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($expired_lists as $value)
                <tr>
                    <td>{{ config('app.url') }}?ref={{ $value->code }}</td>
                    <td>{{ $value->updated_at->format('Y-m-d') }}</td>
                    <td align="center"><a href="" class="btn btn-primary">Reactivate</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $expired_lists->links() }}
    @endif
@endsection

@push('styles')
    <style>
        #page-wrapper {
            position: relative;
        }

        .footer {
            left: 0 !important;
        }

        h1 {
            padding-top: 20px !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="/build/js/backend/loyalty/loyalty.min.js"></script>
@endpush