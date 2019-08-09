@extends('auth.layout')
@section('title')
Reset Password
@endsection
@section('info')
Reset Password
@endsection
@section('body')
<form method="POST" action="{{ route('password.email') }}">
    @csrf
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
    <button type="submit" class="btn btn-pill btn-accent d-table mx-auto">Send Password Reset Link</button>
</form>
@endsection
@section('buttom')
<a class="ml-auto" href="{{route('login')}}">Sign In</a>
@endsection