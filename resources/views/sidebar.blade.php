<div id="sidebar" class="sidebar-offcanvas">
    <div class="list-group">
        <a href="{{ url('/home') }}" class="text-decoration-none list-group-item {{ (request()->is('home')) ? 'active' : '' }}">
            <i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;&nbsp; Dashboard
        </a>
        <?php if(in_array('admin', Auth::user()->roles->pluck('slug')->toArray())): ?>
            <a href="{{ url('/users') }}" class="text-decoration-none list-group-item {{ (request()->is('users*')) ? 'active' : '' }}">
                <i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp; Users
            </a>
            <a href="{{ url('/roles') }}" class="text-decoration-none list-group-item {{ (request()->is('roles*')) ? 'active' : '' }}">
                <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp; Roles
            </a>
            <a href="{{ url('/permissions') }}" class="text-decoration-none list-group-item {{ (request()->is('permissions*')) ? 'active' : '' }}">
                <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp; Permissions
            </a>
        <?php endif; ?>
        <a href="{{ url('/contacts') }}" class="text-decoration-none list-group-item {{ (request()->is('contacts*')) ? 'active' : '' }}">
            <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp; Contacts
        </a>
    </div>
</div>