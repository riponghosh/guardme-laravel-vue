@extends("app::layouts.app")
<style>
    .profile-picture {
        border-radius: 4px;
        margin-bottom: 5px;
        width: 160px;
        height: 170px;
    }
</style>
@section('app')
    <div class="row bg-title">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="page-title"><i class="fa fa-home"></i> Profile of {{ $user->username }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="profile-picture" src="{{ $user->avatar }}" alt="" />
                        </div>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label">Account Information: </label>
                            <div>
                                <input class="form-control" type="text" value="{{ $user->role }}" disabled="disabled" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Username: </label>
                            <div>
                                <input class="form-control" type="text" name="username" placeholder="Username" value="{{ $user->username }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Email: </label>
                            <div>
                                <input class="form-control" type="text" name="email" placeholder="Email" value="{{ $user->email }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Date of Birth: </label>
                            <div>
                                <input class="form-control" type="text" name="dob" placeholder="mm-dd-yyyy" value="{{ $user->dob }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Address: </label>
                            <div>
                                <input class="form-control" type="text" name="address" placeholder="Address" value="{{ $user->address }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Phone Number: </label>
                            <div>
                                <input class="form-control" type="text" name="phone_number" placeholder="Phone Number" value="{{ $user->phone_number }}"/>
                            </div>
                        </div>

                        @if ($user->security_badge)
                        <div class="form-group">
                            <label class="control-label">Security badge: </label>
                            <div>
                                <a href="{{ $user->security_badge_link }}" target="_blank">View</a>
                            </div>
                        </div>
                        @endif

                        @if ($user->proof_of_work)
                        <div class="form-group">
                            <label class="control-label">Proof of work:</label>
                            <div>
                                <a href="{{ $user->proof_of_work_link }}" target="_blank">View</a>
                            </div>
                        </div>
                        @endif

                        @if ($user->visa)
                        <div class="form-group">
                            <label class="control-label">Visa:</label>
                            <div>
                                <a href="{{ $user->visa_link }}" target="_blank">View</a>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
