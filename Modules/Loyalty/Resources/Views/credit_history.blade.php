@extends("app::layouts.app")

@section('app')
    <h1>Credit History</h1>
    <div class="col-md-4" style="margin-bottom: 10px;">
        <div class="panel panel-success">
            <div class="panel-heading text-center" style="height: 20px;padding:0">Credit Balance</div>
            <div class="panel-body text-center"><b>{{ $total_credit }}</b></div>
        </div>
    </div>
    <div class="col-md-4 pull-right">
        <div style="bottom: 0">
            <label for="">Filter : </label>
            <select onchange="location = this.value" class="form-control">
                <option value="{{ route('loyalty.index') }}">Select</option>
                <option {{ request('filter') == 'newest' ? 'selected' : '' }} value="{{ route('loyalty.creditHistory', ['filter' => 'newest']) }}">Newest</option>
                <option {{ request('filter') == 'oldest' ? 'selected' : '' }} value="{{ route('loyalty.creditHistory', ['filter' => 'oldest']) }}">Oldest</option>
            </select>
        </div>
    </div>
        <table class="ui table">
            <thead>
            <tr>
                <th>Username</th>
                <th>Credit Amount</th>
                <th>Redeemed</th>
                <th>Item Redeemed</th>
                <th>Date Redeemed</th>
            </tr>
            </thead>
            <tbody>
                @foreach($credit_history as $item)
                    <tr>
                        <td>{{ $item->user->username }}</td>
                        <td style="text-align: right">{{ $item->credit }}</td>
                        <td style="text-align: right">{{ $item->credit }}</td>
                        <td>{{ $item->job->title }}</td>
                        <td>{{ $item->date_redeemed }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{--        {{ $credit-history->links() }}--}}
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
    <script src="/build/js/backend/loyalty/credit-history.min.js"></script>
@endpush