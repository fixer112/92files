@extends('admin.layout')
@section('subtitle','USER')
@section('title','Add Bulk Users')
@section('body')
<div class="row no-gutters h-100">

    <div class="col-md-10 offset-md-4 mx-auto mt-4">

        <!-- Edit User Details Card -->
        <div class="card card-small edit-user-details mb-4 margin-top40"
            style="overflow:hidden;box-shadow:inset 0 4px 0 0 #17c671;border-radius:.625rem">
            <div class="card-body p-0">
                <form action="{{url('/bulk_user')}}" class="py-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row mx-4">
                        <div class="col-lg-12">



                            <div class="form-group col-md-12">
                                <label for="file_name">Upload Excel</label>
                                <div class="custom-file w-100">
                                    <input type="file" class="custom-file-input @error('file') is-invalid @enderror"
                                        id="customFile" name="file" required multiple>
                                    <label class="custom-file-label" for="customFile">Choose
                                        file...</label></div>
                                @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>
            </div>
            <button class="btn btn-md btn-accent ml-auto d-table mr-3">Add File</button>
            </form>
        </div>
    </div>
    <!-- End Edit User Details Card -->
</div>

@endsection