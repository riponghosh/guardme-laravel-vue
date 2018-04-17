@push("sidebar.menu")
    <li class="{{ isPath('account/users/invite') ? 'active' : '' }}">
        <a href="/">
            <i class="fa fa-share-alt"></i> <span>Invite Users</span>
        </a>
    </li>

    @if(auth()->user()->hasRole(config('guardme.acl.License_partner')))
        <li class="{{ isPath('account/users') ? 'active' : '' }}">
            <a href="/">
                <i class="fa fa-users"></i> <span>Manage Users</span>
            </a>
        </li>

        <li class="{{ isPath('account/staffs') ? 'active' : '' }}">
            <a href="/">
                <i class="fa fa-users"></i> <span>Staff Verification</span>
            </a>
        </li>
    @endif
@endpush