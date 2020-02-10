<!-- Main Sidebar -->
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">

            <!-- logo -->
            <a class="navbar-brand w-100 mr-0" href="/" style="line-height: 25px;">
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
                <a class="nav-link" href="{{url('/user/'.$user->id)}}">
                    <i class="material-icons">&#xE3EC;</i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <h6 class="main-sidebar__nav-title">Other Pages</h6>
        <ul class="nav nav--no-borders flex-column">
            <li class="nav-item">
                <a class="nav-link " href="{{url('/logout')}}">
                    <i class="material-icons">&#xE879;</i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>
        @can('create', App\Folder::class)

        <h6 class="main-sidebar__nav-title">FOLDER</h6>
        <ul class="nav nav--no-borders flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/user/'.$user->id.'/add_folder')}}">
                    <i class="material-icons">add</i>
                    <span>Add Folder</span>
                </a>
            </li>
        </ul>
        @endcan
        <div class="mt-3">
            {{Auth::user()->isAdmin() ? 'User is ': 'You are '}} {{$user->active ? 'Active': 'Suspended'}} and
            {{date('Y') - $user->dob->format('Y') >= 18 ? 'above 18 years': 'below 18 years'}}
        </div>
        @if(Auth::user()->isAdmin())

        <div class="row">
            <a href="{{url('/switch_status/'.$user->id)}}"><button
                    class="btn btn-pill {{$user->active ? 'btn-danger' : 'btn-primary'}} mx-auto mt-3">{{$user->active ? 'Suspend User' :'Activate User'}}</button></a>
            <a href="{{url('/admin')}}"><button class="btn btn-pill btn-primary mx-auto mt-3">Go to Admin</button></a>
        </div>
        @endif

    </div>
</aside>
<!-- End Main Sidebar -->