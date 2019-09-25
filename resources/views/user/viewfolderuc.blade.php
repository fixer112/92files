<!doctype html>
<html class="no-js h-100" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{strtoupper($folder->foldername).'-'.$folder->uc}}</title>
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

</head>

<body class="h-100 bg-white">

    <div class="container-fluid">
        <div class="row">
            <main class=" main-content col-12">
                {{-- <div class="main-navbar sticky-top bg-white">
                    <div class="main-content-container container-fluid px-4"> --}}

                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                        <span class="text-uppercase page-subtitle">Unique Folder</span>
                        <h3 class="page-title">{{strtoupper($folder->foldername).'-'.$folder->uc}}</h3>
                    </div>
                </div>
                <!-- End Page Header -->
                <div id="folder">
                    <table class="file-manager file-manager-list d-none table-responsive">
                        <thead>
                            <tr>
                                {{-- <th style="width: 10px;" class="hide-sort-icons"></th> --}}

                                <th>Id</th>
                                <th>Filename</th>
                                <th>File Format</th>
                                <th>Date Created</th>
                                <th>Date Modified</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file )
                            <tr>
                                <td>
                                    {{$file->id}}
                                </td>
                                <td>
                                    {{$file->filename}}
                                </td>
                                <td>
                                    {{$file->format}}
                                </td>
                                <td>
                                    {{$file->created_at}}
                                </td>
                                <td>
                                    {{$file->updated_at}}
                                </td>
                                <td>
                                    <button class="btn btn-success"><a href="/file/{{$folder->id}}/{{$file->id}}">
                                            <i class="material-icons">cloud</i>
                                        </a></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </main>

        </div>
    </div>


    {{-- <script type="text/javascript" src="{{ asset('assets\app\vendor\charts\loader.js')}}"></script>
    <script src="{{ asset('assets\app\vendor\popper\1.14.3\umd\popper.min.js')}}"></script> --}}
    <script src="{{ asset('assets\app\vendor\bootstrap\4.3.1\js\bootstrap.min.js')}}"></script>
    {{-- <script src="{{ asset('assets\app\vendor\chart.js\2.7.1/Chart.min.js')}}"></script>
    <script src="{{ asset('assets\app\scripts\ph.min.js')}}"></script>
    <script src="{{ asset('assets\app\vendor\Sharrre\2.0.1\jquery.sharrre.min.js')}}"></script>
    <script src="{{ asset('assets\app\scripts\extras.1.3.1.min.js')}}"></script>
    <script src="{{ asset('assets\app\scripts\ph-dashboards.1.3.1.min.js')}}">
        <script src="{{ asset('assets\app\scripts\app\app-analytics-overview.1.3.1.min.js')}}">
    </script> --}}
    <script src="{{ asset('assets\app\vendor\DataTables\1.10.18\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets\app\vendor\DataTables\Responsive-2.2.2\js\dataTables.responsive.min.js')}}"></script>
    {{-- <script src="{{ asset('assets\app\scripts\app\app-transaction-history.1.3.1.min.js')}}"></script>
    <script src="{{ asset('assets\app\scripts\notify.min.js')}}"></script> --}}
    <script>
        $(document).ready(function() {
            $(".file-manager-list").DataTable();
            $(".file-manager__item").click(function(){(this).toggleClass("file-manager__item--selected")});
    });
    </script>
</body>

</html>