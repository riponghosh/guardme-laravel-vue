@extends("app::layouts.app")

@section('app')
    <h1>Redeem Credit</h1>
    <table class="ui table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Points to Redeem</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($redeem_credit as $item)
                <tr>
                    <td>{{ $item->job->title }}</td>
                    <td>{{ $item->job->description }}</td>
                    <td>{{ $item->credit }}</td>
                    <td>
                        <button data-toggle="modal" data-target="#redeem-credit-modal" @click="redeemBtn('{{ route('loyalty.getRedeemCreditById', $item->id) }}', {{ $item->id }})" class="btn btn-primary btn-sm">Redeem</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $redeem_credit->links() }}

    <!--the modal, needs to be on an outside div of the link to open/close properly-->
    <div class="modal fade" id="redeem-credit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="text-center modal-title">Redeem Details</h5>
                </div>

                <form action="{{ route('loyalty.submitRedeemCredit') }}" method="POST">
                    <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="total-points">Total Points :</label>
                                <input type="text" readonly class="form-control" id="total-points" :value="total">
                            </div>
                            <div class="form-group">
                                <label for="points-after-redeemed">Points after Redeemed :</label>
                                <input type="text" readonly class="form-control" id="points-after-redeemed" :value="after">
                            </div>
                            <div class="form-group">
                                <label for="postage-address">Postage Address :</label>
                                <input name="postage_address" type="text" class="form-control" id="postage-address">
                            </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="referral_credit_id" :value="referral_credit_id">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--/the modal-->
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
    <script src="/build/js/backend/loyalty/redeem-credit.min.js"></script>
@endpush