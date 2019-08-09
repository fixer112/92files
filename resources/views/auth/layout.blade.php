<!doctype html>
<html class="no-js h-100" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('assets\app\images\logo.png')}}">
    <link href="{{ asset('assets\app\assets\app\vendor\font-awesome\5.0.6\css\fontawesome-all.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets\app\vendor\bootstrap\4.3.1\css\bootstrap.min.css')}}">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.3.1"
        href="{{ asset('assets\app\styles\ph-dashboards.1.3.1.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets\app\styles\extras.1.3.1.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets\app\styles\custom.css')}}">
    <script src="{{ asset('assets\app\vendor\buttons\buttons.js')}}"></script>
    <link rel="stylesheet"
        href="{{ asset('assets\app\vendor\DataTables\Responsive-2.2.2/css/responsive.dataTables.min.css')}}">
</head>

<body class="h-100">
    <div class="container-fluid icon-sidebar-nav h-100">
        <div class="row h-100">

            <main class="main-content col">
                <div class="main-content-container container-fluid px-4 my-auto h-100">
                    <div class="row no-gutters h-100">
                        <div class="col-lg-3 col-md-5 auth-form mx-auto my-auto">
                            <div class="card">
                                <div class="card-body">
                                    <img class="auth-form__logo d-table mx-auto mb-3"
                                        src="{{ asset('assets\app\images\logo.png')}}" alt="logo">
                                    <h5 class="auth-form__title text-center mb-4">@yield('info')</h5>
                                    @yield('body')
                                </div>
                                {{-- <div class="card-footer border-top">
                                    <ul class="auth-form__social-icons d-table mx-auto">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-github"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                    </ul>
                                </div> --}}
                            </div>
                            <div class="auth-form__meta d-flex mt-4">
                                @yield('buttom')
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- vendor -->
    <script src="{{ asset('assets\app\vendor\jquery\jquery-3.3.1.min.js')}}">
    </script>
    {{--  <script type="text/javascript" src="assets\app\vendor\charts\loader.js"></script>
    <script src="assets\app\vendor\popper\1.14.3\umd\popper.min.js"></script>
    <script src="assets\app\vendor\bootstrap\4.3.1\js\bootstrap.min.js"></script>
    <script src="assets\app\vendor\chart.js\2.7.1/Chart.min.js"></script>
    <script src="assets\app\scripts\ph.min.js"></script>
    <script src="assets\app\vendor\Sharrre\2.0.1\jquery.sharrre.min.js"></script>
    <script src="assets\app\scripts\extras.1.3.1.min.js"></script>
    <script src="assets\app\scripts\ph-dashboards.1.3.1.min.js"></script>
    <script src="assets\app\scripts\app\app-analytics-overview.1.3.1.min.js"></script>
    <script src="assets\app\vendor\DataTables\1.10.18\js\jquery.dataTables.min.js"></script>
    <script src="assets\app\vendor\DataTables\Responsive-2.2.2\js\dataTables.responsive.min.js"></script>
    <script src="assets\app\scripts\app\app-transaction-history.1.3.1.min.js"></script> --}}
</body>

</html>