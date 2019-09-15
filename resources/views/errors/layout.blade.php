<!doctype html>
<html class="no-js h-100" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('assets\app\images\logo.png')}}">
    <link href="{{ asset('assets\app\vendor\font-awesome\5.0.6\css\fontawesome-all.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets\app\vendor\bootstrap\4.3.1\css\bootstrap.min.css')}}">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.3.1"
        href="{{ asset('assets\app\styles\ph-dashboards.1.3.1.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets\app\styles\custom.css')}}">
    <script src="{{ asset('assets\app\vendor\buttons\buttons.js')}}"></script>
</head>

<body class="h-100">
    <div class="container-fluid">
        <div class="row">
            <main class="main-content col-12 mt-4">
                <div class="main-navbar bg-white">

                    <div class="main-content-container container-fluid px-4">

                        <div class="error">
                            <div class="error__content">
                                <h2>@yield('code')</h2>
                                <h3>@yield('message')</h3>
                                <p>There was a problem on our end. Please try again later.</p>
                                @if(url()->previous())
                                <a href="{{url()->previous()}}" class="btn btn-primary btn-pill">&larr; Go Back</a>
                                @else
                                <a href="url('/')" class="btn btn-primary btn-pill">&larr; Go Home</a>
                                @endif
                            </div>
                        </div>


                    </div>
            </main>

        </div>
    </div>


</body>

</html>