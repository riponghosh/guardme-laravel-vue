@extends("app::layouts.app")

@section('app')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-home"></i> Dashboard </h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 uk-text-right uk-lead">
            You are logged in as: <span class="fg-site-theme">@{{ $root.app.user ? $root.app.user.primaryRole.name : '' }}</span>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="white-box">
                <h3 class="box-title">
                    Account / Transactions
                </h3>
                <div class="row sales-report">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p>BALANCE</p>
                        <h2>£230.87</h2>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <p>ESCROW</p>
                        <h2>£30.87</h2>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Transactions</th>
                            <th>STATUS</th>
                            <th>DATE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td class="txt-oflo">Credit to Wallet</td>
                            <td><span class="label label-success label-rouded">SALE</span> </td>
                            <td class="txt-oflo">April 18, 2017</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="txt-oflo">Transfer to Escrow</td>
                            <td><span class="label label-info label-rouded">EXTENDED</span></td>
                            <td class="txt-oflo">April 19, 2017</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="txt-oflo">Debit: Payment for subscription</td>
                            <td><span class="label label-danger label-rouded">TAX</span></td>
                            <td class="txt-oflo">April 20, 2017</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <gm-user-profile :user="$root.app.user ? $root.app.user : null"></gm-user-profile>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')
    <script src="/build/js/backend/dashboard.min.js"></script>
@endpush