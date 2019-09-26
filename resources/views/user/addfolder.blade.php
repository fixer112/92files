@extends('user.layout')
@section('subtitle','Folder')
@section('title','Add Folder')
@section('body')
<div class="row no-gutters h-100">
    <div class="col-md-4 offset-md-4 mx-auto mt-4">
        <div class="card card-small edit-user-details mb-4 margin-top60"
            style="overflow:hidden;box-shadow:inset 0 4px 0 0 #17c671;border-radius:.625rem">
            <div class="card-body p-0">
                <form action="{{url('/user/'.request()->user->id.'/add_folder/')}}" method="POST" class="py-4">
                    @csrf
                    <div class="form-row mx-4">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="folder_name">Name of Folder</label>
                                    <input type="text" class="form-control @error('foldername') is-invalid @enderror"
                                        id="folder_name" value="{{ old('foldername') }}" name="foldername">
                                    @error('foldername')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <input name="user_id" value="{{request()->user->id}}" hidden>
                                <input name="admin_id" value="{{Auth::id()}}" hidden>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-accent ml-auto d-table mr-3">Add Folder</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection