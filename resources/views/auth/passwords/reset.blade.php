@extends('auth.layout')
@section('title')
Reset Password
@endsection
@section('info')
Reset Password
@endsection
@section('body')
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus id="email"
            aria-describedby="emailHelp" placeholder="Enter email">
        @error('email')
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
    <div class="form-group">
        <label for="password-confirm">Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"
            id="password-confirm" placeholder="Confirm Password">

    </div>

    <button type="submit" class="btn btn-pill btn-accent d-table mx-auto">Reset Password</button>
</form>
@endsection
@section('buttom')
<a href="{{route('password.request')}}">Forgot your password?</a>
<a class="ml-auto" href="{{route('login')}}">Sign In</a>
@endsection