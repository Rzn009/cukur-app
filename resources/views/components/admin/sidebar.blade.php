<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-hand-scissors"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PotongBoss</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Interface</div>

    <!-- Category Menu -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
            aria-expanded="true" aria-controls="collapseCategory">
            <i class="fas fa-fw fa-hand-scissors"></i>
            <span>Category</span>
        </a>
        <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('manage barber')
                    <a class="collapse-item" href="{{ route('admin.barbers.index') }}">Barber</a>
                @endcan
                <a class="collapse-item" href="{{ route('bookings.index') }}">Bookings</a>

            </div>
        </div>
    </li>


    <!-- User Management -->
    @if (auth()->user()->hasRole('super_admin') || auth()->user()->can('manage user') || auth()->user()->can('manage roles'))
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUserMgmt"
                aria-expanded="true" aria-controls="collapseUserMgmt">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>User Management</span>
            </a>
            <div id="collapseUserMgmt" class="collapse" aria-labelledby="headingUserMgmt"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @if (auth()->user()->hasRole('super_admin') || auth()->user()->can('manage user'))
                        <a class="collapse-item" href="{{ route('admin.users.index') }}">User</a>
                    @endif
                    @if (auth()->user()->hasRole('super_admin') || auth()->user()->can('manage role'))
                        <a class="collapse-item" href="{{ route('admin.roles.index') }}">Role</a>
                    @endif
                </div>
            </div>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Addons</div>

    <!-- Schedule -->
    @if (auth()->user()->hasRole('super_admin') || auth()->user()->can('manage schedule'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.schedules.index') }}">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Schedule</span>
            </a>
        </li>
    @endif

    <!-- Services -->
    @if (auth()->user()->hasRole('super_admin') || auth()->user()->can('manage services'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.services.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Customer Services</span>
            </a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('backend/asset/img/undraw_rocket.svg') }}"
            alt="...">
        <a class="btn btn-success btn-sm" href="{{ route('admin.dashboard') }}">Admin</a>
    </div>

</ul>
