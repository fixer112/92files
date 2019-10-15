@extends('admin.layout')
@section('subtitle','ORGANIZATION')
@section('title','Edit Organization')
@section('body')
<div class="row no-gutters h-100">
    <div class="col-lg-8 mx-auto mt-4">
        <!-- Edit User Details Card -->
        <div class="card card-small edit-user-details mb-4"
            style="overflow:hidden;box-shadow:inset 0 4px 0 0 #17c671;border-radius:.625rem">
            <form action="{{url('edit_company/'.request()->company->id)}}" method="POST" enctype="multipart/form-data"
                class="py-4">
                @csrf
                @method('PUT')
                <div class="card-body p-0">
                    <div class="form-row mx-4 margin-top20 margin-bottom50">
                        <div class="col-lg-12">
                            <label for="userProfilePicture" class="text-center w-100 mb-4 font-weight-bold">New Profile
                                Picture</label>
                            <div class="edit-user-details__avatar m-auto">
                                <img src="{{asset(request()->company->photo())}}" id="pic" alt="User Avatar">
                                <label class="edit-user-details__avatar__change">
                                    <i class="material-icons mr-1">&#xE439;</i>
                                    <input type="file" name="logo" id="userProfilePicture" accept="image/*"
                                        class="d-none">
                                    @error('logo')
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
                                    <label for="name">Organization Name</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ request()->company->name }}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="location">Location</label>
                                    <input type="text" name="location" id="location"
                                        class="form-control @error('location') is-invalid @enderror"
                                        value="{{ request()->company->location }}" required>
                                    @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ request()->company->email }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" name="num" id="phone"
                                        class="form-control @error('num') is-invalid @enderror"
                                        value="{{ request()->company->num }}" required>
                                    @error('num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="state">State</label>

                                    <select class="custom-select @error('state') is-invalid @enderror" name="state"
                                        required>
                                        @foreach($states as $state)
                                        <option {{request()->company->state == $state ? 'selected':''}}
                                            value="{{$state}}">{{$state}}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="grn">Govt Reg Number</label>
                                    <input type="text" name="grn" id="grn"
                                        class="form-control @error('grn') is-invalid @enderror"
                                        value="{{ request()->company->grn }}" required>
                                    @error('grn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="type">Type of Document</label>
                                    <select name="type" class="custom-select @error('type') is-invalid @enderror"
                                        required>
                                        @foreach ($defaultFolders as $f)
                                        <option {{request()->company->type == $f ? 'selected':''}} value="{{$f}}">
                                            {{ucfirst($f)}}</option>
                                        @endforeach

                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="address">Address</label>
                                    <textarea id="address" name="addr"
                                        class="form-control @error('addr') is-invalid @enderror"
                                        required>{{ request()->company->addr }}</textarea>
                                    {{-- <input type="text"  id="address"> --}}
                                </div>


                                <input type="hidden" value="{{Auth::id()}}" name="admin_id" />
                                <div class="card-footer border-top">
                                    <button type="submit"
                                        class="btn btn-sm btn-accent ml-auto d-table mr-3">Submit</button>
                                </div>
            </form>
        </div>
        <!-- End Edit User Details Card -->
    </div>
</div>
@endsection