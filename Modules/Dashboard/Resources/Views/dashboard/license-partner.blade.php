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
        <div class="col-md-3">
            <div class="white-box">
                <h3 class="box-title fg-site-maroon">Active Tickets</h3>
                <ul class="list-inline two-part">
                    <li><i class="icon-people fg-site-maroon"></i></li>
                    <li class="text-right"><span class="counter">23</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box">
                <h3 class="box-title fg-site-green">Active Jobs</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-tasks fg-site-green"></i></li>
                    <li class="text-right"><span class="counter">23</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box">
                <h3 class="box-title text-warning">Pending Reviews</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-clock-o text-warning"></i></li>
                    <li class="text-right"><span class="counter">23</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="white-box">
                <h3 class="box-title">Escrow</h3>
                <ul class="list-inline two-part">
                    <li><i class="ti-wallet text-success"></i></li>
                    <li class="text-right">
                        <sup>£</sup>
                        <span class="counter">117</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')
    <script src="/build/js/backend/dashboard.min.js"></script>
@endpush