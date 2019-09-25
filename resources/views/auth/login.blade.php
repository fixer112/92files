@extends('auth.layout')
@section('title')
Sign In
@endsection
@section('info')
Access your account
@endsection
@section('body')
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
            value="{{ $email ?? old('username') }}" required autocomplete="username" autofocus id="username"
            placeholder="Username">
        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required
            autocomplete="new-password" id="password" placeholder="Password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group mb-3 d-table mx-auto">
        <div class="custom-control custom-checkbox mb-1">
            <input type="checkbox" name="remember" class="custom-control-input @error('remember') is-invalid @enderror"
                id="customCheck2">
            <label class="custom-control-label" for="customCheck2">Remember me for 30 days.</label>
        </div>
        @error('remember')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-pill btn-accent d-table mx-auto">Access
        Account</button>
</form>
@endsection
@section('buttom')
{{-- <a href="{{route('password.request')}}">Forgot your password?</a> --}}
<a href="{{url('password/reset')}}">Forgot your password?</a>
<a class="ml-auto" href="{{route('homepage')}}">Homepage</a>
@endsection