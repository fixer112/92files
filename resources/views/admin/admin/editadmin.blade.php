@extends('admin.layout')
@section('subtitle','ADMIN')
@section('title','Edit Admin')
@section('body')
<div class="row no-gutters h-100">
    <div class="col-lg-8 mx-auto mt-4">
        <!-- Edit User Details Card -->
        <div class="card card-small edit-user-details mb-4"
            style="overflow:hidden;box-shadow:inset 0 4px 0 0 #17c671;border-radius:.625rem">
            <form action="{{url('edit_admin/'.request()->user->id)}}" method="POST" enctype="multipart/form-data"
                class="py-4">
                @method('PUT') 
                @csrf
                <div class="card-body p-0">
                    <div class="form-row mx-4 margin-top20 margin-bottom50">
                        <div class="col-lg-12">
                            <label for="userProfilePicture" class="text-center w-100 mb-4 font-weight-bold">New Profile
                                Picture</label>
                            <div class="edit-user-details__avatar m-auto">
                                <img src="{{asset(request()->user->photo())}}" id="pic" alt="User Avatar">
                                <label class="edit-user-details__avatar__change">
                                    <i class="material-icons mr-1">&#xE439;</i>
                                    <input type="file" name="pic" id="userProfilePicture" accept="image/*"
                                        class="d-none">
                                    @error('pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </label>
                            </div>
                            {{-- <button class="btn btn-sm btn-white d-table mx-auto mt-4"><i
                                    class="material-icons">&#xE2C3;</i> Upload Image</button> --}}
                        </div>
                    </div>
                    <div class="form-row mx-4">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstName">First Name</label>
                                    <input type="text" name="fname" id="firstName"
                                        class="form-control @error('fname') is-invalid @enderror"
                                        value="{{ request()->user->fname }}" required>
                                    @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" name="lname" id="lastName"
                                        class="form-control @error('lname') is-invalid @enderror"
                                        value=" {{ request()->user->lname }} " required>
                                    @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value=" {{ request()->user->username }} " required>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value=" {{ request()->user->email }} " required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="state_of_origin">State of Origin</label>
                                    {{-- <input type="text" name="so" id="state_of_origin"
                                        class="form-control @error('so') is-invalid @enderror" value="{{ old('so') }}"
                                    required> --}}
                                    <select class="custom-select @error('so') is-invalid @enderror" name="so">

                                        @foreach($states as $state)
                                        <option {{ request()->user->so == $state ? 'selected' :''}} value="{{$state}}">
                                            {{$state}}</option>
                                        @endforeach
                                    </select>
                                    @error('so')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" name="num" id="phone"
                                        class="form-control @error('num') is-invalid @enderror"
                                        value="{{ request()->user->num }}" required>
                                    @error('num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="type">Type</label>
                                    <select name="type" class="custom-select @error('type') is-invalid @enderror">

                                        <option {{ request()->user->type == 'user' ? 'selected' :''}} value="user">User
                                            Administration</option>
                                        <option {{ request()->user->type == 'company' ? 'selected':'' }}
                                            value="company">
                                            Company Administration</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sex">Sex</label>
                                    <select name="sex" class="custom-select @error('sex') is-invalid @enderror"
                                        required>

                                        <option {{ request()->user->sex == 'male' ? 'selected' : ''}} value="male">Male
                                        </option>
                                        <option {{ request()->user->sex == 'female' ? 'selected' : ''}} value="female">
                                            Female</option>
                                    </select>
                                    @error('sex')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="dob">Date of Birth</label>
                                    <input class="form-control @error('dob') is-invalid @enderror" type="date"
                                        name="dob" value="{{ request()->user->dob }}" />
                                    @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="address">Address</label>
                                    <textarea id="address" name="addr"
                                        class="form-control @error('addr') is-invalid @enderror"
                                        required>{{ request()->user->addr }}</textarea>
                                    {{-- <input type="text"  id="address"> --}}
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pass">New Password</label>
                                    <input type="password" name="password" id="pass"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cpass">Repeat New Password</label>
                                    <input type="password" name="password_confirmation" id="cpass" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top">
                    <button type="submit" class="btn btn-sm btn-accent ml-auto d-table mr-3">Submit</button>
                </div>
            </form>
        </div>
        <!-- End Edit User Details Card -->
    </div>
</div>
@endsection