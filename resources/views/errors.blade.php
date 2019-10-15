<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets\app\vendor\bootstrap\4.3.1\css\bootstrap.min.css')}}">
    <title>Errors</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto bg-danger mt-5 rounded p-3">
                {!! session('fail') !!}
            </div>
        </div>
    </div>
</body>

</html>