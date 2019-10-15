@extends('user.layout')
@section('subtitle','File')
@section('title','Edit File '.strtoupper(request()->file->filename))

@section('body')
<div id="folder">

    @can('create', App\File::class)
    <div class="row no-gutters h-100">
        <div class="col-md-10 offset-md-4 mx-auto mt-4">
            <!-- Edit User Details Card -->
            <div class="card card-small edit-user-details mb-4 margin-top40"
                style="overflow:hidden;box-shadow:inset 0 4px 0 0 #17c671;border-radius:.625rem">
                <div class="card-body p-0">
                    <form action="{{url('/edit_file/'.request()->file->id)}}" class="py-4" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row mx-4">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="file_name">Name of File</label>
                                        <input type="text" class="form-control @error('filename') is-invalid @enderror"
                                            id="file_name" value="{{ request()->file->filename }}" name="filename"
                                            placeholder="Name of File" required>
                                        @error('filename')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="folder_location">Folder Location</label>
                                        <select class="custom-select @error('type') is-invalid @enderror" name="type"
                                            required>
                                            @foreach ($defaultFolders as $f)
                                            <option {{request()->file->type == $f ? 'selected':''}} value="{{$f}}">
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
                                        <label for="">Company UC</label>
                                        <input type="text" class="form-control @error('uc') is-invalid @enderror"
                                            name="uc" value="{{request()->file->company->uc}}" />
                                        @error('uc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="file_name">Upload File</label>
                                        <div class="custom-file w-100">
                                            <input type="file"
                                                class="custom-file-input @error('file') is-invalid @enderror"
                                                id="customFile" name="file">
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
                        <button class="btn btn-md btn-accent mr-auto d-table ml-3 float-left"><a
                                href="/file/{{request()->file->id}}">View File</a></button>
                        <button class="btn btn-md btn-accent ml-auto d-table mr-3 float-right">Save Changes</button>
                    </form>
                </div>
            </div>
            <!-- End Edit User Details Card -->
        </div>
    </div>
</div>
@endcan
@endsection