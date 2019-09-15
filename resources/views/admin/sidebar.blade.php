<!-- Main Sidebar -->
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">

            <!-- logo -->
            <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <div class="d-table m-auto">
                    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;"
                        src="{{ asset('assets\app\images\logo.png')}}" alt="logo">
                    <span class="d-none d-md-inline ml-1">{{env('APP_NAME')}}</span>
                </div>
            </a>
            <!-- logo -->

            <!-- SidEbar Toogle -->
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
            <!-- SidEbar Toogle -->

        </nav>
    </div>

    <!-- Searchbar form -->
    {{-- <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
        <div class="input-group input-group-seamless ml-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <input class="navbar-search form-control" type="text" placeholder="Search for something..."
                aria-label="Search">
        </div>
    </form> --}}
    <!-- Searchbar form -->

    <div class="nav-wrapper">

        <h6 class="main-sidebar__nav-title">MY ACCOUNT</h6>
        <ul class="nav nav--no-borders flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/admin')}}">
                    <i class="material-icons">&#xE3EC;</i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        @if(Auth::user()->isSuperAdmin())
        <h6 class="main-sidebar__nav-title">Admin</h6>
        <ul class="nav nav--no-borders flex-column">
            <li class="nav-item">
                <a class="nav-link " href="{{url('/view_admins')}}">
                    <i class="material-icons">&#xE417;</i>
                    <span>View Admins</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{url('/add_admin')}}">
                    <i class="material-icons">&#xE89C;</i>
                    <span>Add Admin</span>
                </a>
            </li>

        </ul>
        @endif

        @if(Auth::user()->isSuperAdmin() ||Auth::user()->type == 'company' )
        <h6 class="main-sidebar__nav-title">Organization</h6>
        <ul class="nav nav--no-borders flex-column">
            <li class="nav-item">
                <a class="nav-link " href="{{url('/view_companys')}}">
                    <i class="material-icons">&#xE417;</i>
                    <span>View Organizations</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{url('/add_company')}}">
                    <i class="material-icons">&#xE89C;</i>
                    <span>Add Organization</span>
                </a>
            </li>

        </ul>
        @endif

        @if(Auth::user()->isSuperAdmin() ||Auth::user()->type == 'user' )
        <h6 class="main-sidebar__nav-title">Users</h6>
        <ul class="nav nav--no-borders flex-column">
            <li class="nav-item">
                <a class="nav-link " href="{{url('/view_users')}}">
                    <i class="material-icons">&#xE417;</i>
                    <span>View Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{url('/add_user')}}">
                    <i class="material-icons">&#xE227;</i>
                    <span>Add User</span>
                </a>
            </li>

        </ul>
        @endif

        <h6 class="main-sidebar__nav-title">Other Pages</h6>
        <ul class="nav nav--no-borders flex-column">
            <li class="nav-item">
                <a class="nav-link " href="{{url('/logout')}}">
                    <i class="material-icons">&#xE879;</i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>

    </div>
</aside>
<!-- End Main Sidebar -->