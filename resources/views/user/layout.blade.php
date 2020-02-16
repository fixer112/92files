<!doctype html>
<html class="no-js h-100" lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="{{ asset('assets\app\images\logo.png')}}">
        <link href="{{ asset('assets\app\vendor\font-awesome\5.0.6\css\fontawesome-all.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets\app\vendor\bootstrap\4.3.1\css\bootstrap.min.css')}}">
        <link rel="stylesheet" id="main-stylesheet" data-version="1.3.1"
            href="{{ asset('assets\app\styles\ph-dashboards.1.3.1.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets\app\styles\extras.1.3.1.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets\app\styles\custom.css')}}">
        <script src="{{ asset('assets\app\vendor\buttons\buttons.js')}}"></script>
        <link rel="stylesheet"
            href="{{ asset('assets\app\vendor\DataTables\Responsive-2.2.2/css/responsive.dataTables.min.css')}}">
        <script src="{{ asset('assets\app\vendor\jquery\jquery-3.3.1.min.js')}}"></script>
        @yield('head')
    </head>

    <body class="h-100">
        @php
        $user = isset($user) ? $user : request()->user;
        @endphp
        <div class="container-fluid">
            <div class="row">

                @include('user.sidebar')

                <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                    <div class="main-navbar sticky-top bg-white">

                        @include('user.topnav')


                        <div class="main-content-container container-fluid px-4">

                            <!-- Page Header -->
                            <div class="page-header row no-gutters py-4">
                                <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                                    <span class="text-uppercase page-subtitle">@yield('subtitle')</span>
                                    <h3 class="page-title">@yield('title')</h3>
                                </div>
                            </div>
                            <!-- End Page Header -->


                            @yield('body')

                        </div>


                        <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
                            {{-- <ul class="nav">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Home</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Services</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">About</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Products</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Blog</a>
                                                </li>
                                            </ul> --}}
                            <span class="copyright ml-auto my-auto mr-2">Copyright© {{date('Y')}}
                                {{env('APP_NAME')}}</span>
                        </footer>

                </main>

            </div>
        </div>

        <!-- vendor -->
        <script type="text/javascript" src="{{ asset('assets\app\vendor\charts\loader.js')}}"></script>
        {{-- <script src="{{ asset('assets\app\vendor\jquery\jquery-3.3.1.min.js')}}"></script>
        --}}<script src="{{ asset('assets\app\vendor\popper\1.14.3\umd\popper.min.js')}}"></script>
        <script src="{{ asset('assets\app\vendor\bootstrap\4.3.1\js\bootstrap.min.js')}}"></script>
        <script src="{{ asset('assets\app\vendor\chart.js\2.7.1/Chart.min.js')}}"></script>
        <script src="{{ asset('assets\app\scripts\ph.min.js')}}"></script>
        <script src="{{ asset('assets\app\vendor\Sharrre\2.0.1\jquery.sharrre.min.js')}}"></script>
        <script src="{{ asset('assets\app\scripts\extras.1.3.1.min.js')}}"></script>
        <script src="{{ asset('assets\app\scripts\ph-dashboards.1.3.1.min.js')}}">
            <script src="{{ asset('assets\app\scripts\app\app-analytics-overview.1.3.1.min.js')}}">
        </script>
        <script src="{{ asset('assets\app\vendor\DataTables\1.10.18\js\jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('assets\app\vendor\DataTables\Responsive-2.2.2\js\dataTables.responsive.min.js')}}">
        </script>
        <script src="{{ asset('assets\app\scripts\app\app-transaction-history.1.3.1.min.js')}}"></script>
        <script src="{{ asset('assets\app\scripts\notify.min.js')}}"></script>
        {{--  <script type="text/javascript" src="{{ asset('assets\app\scripts\app\app-file-manager.1.3.1.min.js')}}">
        </script> --}}

        <script>
            $(document).ready(function() {
        var link = $(".nav-wrapper .nav-link");
        Array.from(link).forEach(activeLink);
    
        $("#userProfilePicture").change(function(file) {
    
            $("#pic").attr('src', URL.createObjectURL(file.target.files[0]));
        });
        @if (session('error'))
        $.notify("{{session('error')}}", "error");
        @endif
        
        @if (session('success'))
        $.notify("{{session('success')}}", "success");
        @endif
        
    });
    
    
    
    function activeLink(link) {
        var link = $(link);
        var location =  window.location.origin + window.location.pathname;
        //console.log(location);
        //console.log(link.attr("href"));
        if (link.attr("href") == location) {
            link.addClass('active');
        }
    }
   
       function apiDatatable(api,order,col=null) {
        var data = {
        processing: true,
        serverSide: true,
        ajax: api,
        responsive:!0,
        order:[[order,"desc"]],
        /*columns: [
        
        { data: 'email', name: 'email' },
        ]*/
        };
        if(col){
            data.columns = col; 
        }
        window.table = $(".file-manager-list").DataTable(data);
        $(".file-manager__item").click(function(){(this).toggleClass("file-manager__item--selected")});
        };
    
        </script>
        @yield('script')
    </body>

</html>