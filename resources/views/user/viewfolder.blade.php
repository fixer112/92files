@extends('user.layout')
@section('subtitle','Folder')
@section('title',strtoupper(request()->type))
@section('head')
<script src="{{ asset('assets\app\scripts\axios.js')}}"></script>
@endsection
@section('body')
{{-- <div class="col">
    @can('create', App\File::class)
    <a href="{{url('add_file')}}" class="btn btn-sm btn-accent text-white mt-2" style="float: right;"><i
    class="material-icons">&#xE145;</i> Add New File</a>
@endcan
</div> --}}
<table class="file-manager file-manager-list d-none table-responsive">
    <thead>
        <tr>
            {{-- <th style="width: 10px;" class="hide-sort-icons"></th> --}}

            <th>Id</th>
            <th>Filename</th>
            <th>File Format</th>
            <th>UC</th>
            <th>Company</th>
            <th>Custom Folders</th>
            <th>Date Created</th>
            <th>Date Modified</th>
            <th>Actions</th>

            {{-- <th class="text-right">Actions</th> --}}
        </tr>
    </thead>

</table>
@can('create', App\File::class)
<div class="row no-gutters h-100">
    <div class="col-md-10 offset-md-4 mx-auto mt-4">
        <!-- Edit User Details Card -->
        <div class="card card-small edit-user-details mb-4 margin-top40"
            style="overflow:hidden;box-shadow:inset 0 4px 0 0 #17c671;border-radius:.625rem">
            <div class="card-body p-0">
                <form action="{{url('/user/'.request()->user->id.'/add_file')}}" class="py-4" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-row mx-4">
                        <div class="col-lg-12">
                            <div class="form-row">
                                {{-- <div class="form-group col-md-12">
                                    <label for="file_name">Name of File</label>
                                    <input type="text" class="form-control @error('filename') is-invalid @enderror"
                                        id="file_name" value="{{ old('filename') }}" name="filename"
                                placeholder="Name of File" required>
                                @error('filename')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> --}}
                            <div class="form-group col-md-12">
                                <label for="folder_location">Folder Location</label>
                                <select class="custom-select @error('type') is-invalid @enderror" name="type" required>
                                    <option selected="">--| Choose Option |--</option>
                                    @foreach ($defaultFolders as $f)
                                    <option value="{{$f}}">{{ucfirst($f)}}</option>
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
                                <input type="text" class="form-control @error('uc') is-invalid @enderror" name="uc" />
                                @error('uc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="file_name">Upload File</label>
                                <div class="custom-file w-100">
                                    <input type="file" class="custom-file-input @error('files') is-invalid @enderror"
                                        id="customFile" name="files[]" required multiple>
                                    <label class="custom-file-label" for="customFile">Choose
                                        file...</label></div>
                                @error('files.*')
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
            <button class="btn btn-md btn-accent ml-auto d-table mr-3">Add File</button>
            </form>
        </div>
    </div>
    <!-- End Edit User Details Card -->
</div>
</div>
@endcan
@endsection
@section('script')
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script src="{{ asset('assets\app\scripts\app\sweetalert.min.js')}}"></script>
<script>
    var col = [

{ data: 'id'},
{ data: 'filename'},
{ data: 'format'},
{ data: 'uc'},
{ data: 'company'},
{ data: 'custom_folders'},
{ data: 'created_at'},
{ data: 'updated_at'},
{ data: 'action'},
];
apiDatatable("{{url('user/'.request()->user->id.'/folder/'.request()->type.'/?api_token='.Auth::user()->api_token)}}",1,col);

function del(id){
    var myhtml = document.createElement("div");
    var del = '<form action="/delete_file/'+id+'" method="POST">@csrf<button type="submit" class="btn btn-danger"><i class="material-icons">&#xE872;</i> Delete File</button>';
    
    myhtml.innerHTML = del;
    swal({
    title: "Are you sure?",
    content:myhtml,
    icon: "warning",
    buttons: true,
    dangerMode: true,
    buttons: {
    cancel: true,
    confirm: false,
    },
    
    })
}
function checkFolder(fileId,folderId){
var url = '/file/'+fileId+'/folder/'+folderId+'/?api_token='+'{{Auth::user()->api_token}}';
var folders = $('.folder-check');

reverseChecks(folders);

axios.post(url)
.then(response => {
$.notify(response.data.success, "success");
reverseChecks(folders);
window.table.destroy();
apiDatatable("{{url('user/'.request()->user->id.'/folder/'.request()->type.'/?api_token='.Auth::user()->api_token)}}",1,col);
console.log(response.data)

})
.catch((error)=>{
    console.log(error.response);
$.notify(error.response.data.message, "error");
reverseChecks(folders);
window.table.destroy();
apiDatatable("{{url('user/'.request()->user->id.'/folder/'.request()->type.'/?api_token='.Auth::user()->api_token)}}",1,col);
//console.log(error.response.data)
})

//console.log(folders);
}
function reverseChecks(checks){
Array.from(checks).forEach(function(check){
$(check)[0].disabled = !$(check)[0].disabled
//console.log($(check)[0].disabled);
});

}
</script>
@endsection