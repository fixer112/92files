@extends('admin.layout')
@section('subtitle','USER')
@section('title','View Users')
@section('body')
<table class="file-manager file-manager-list d-none table-responsive">
    <thead>
        <tr>
            {{-- <th style="width: 10px;" class="hide-sort-icons"></th> --}}
            <th>photo</th>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>ParentName</th>
            <th>Number</th>
            <th>Type</th>
            <th>SO</th>
            <th>Addr</th>
            <th>Dob</th>
            <th>Actions</th>

            {{-- <th class="text-right">Actions</th> --}}
        </tr>
    </thead>

</table>
@endsection
@section('script')
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script src="{{ asset('assets\app\scripts\app\sweetalert.min.js')}}"></script>
<script>
    var col = [
{ data: 'photo'},
{ data: 'id'},
{ data: 'username'},
{ data: 'email'},
{ data: 'fname'},
{ data: 'lname'},
{ data: 'parent_name'},
{ data: 'num'},
{ data: 'type'},
{ data: 'so'},
{ data: 'addr'},
{ data: 'dob'},
{ data: 'action'},
];
apiDatatable("{{url('/view_users?api_token='.Auth::user()->api_token)}}",1,col);

function del(id){
    var myhtml = document.createElement("div");
    var del = '<form action="/delete_user/'+id+'" method="POST">@csrf<button type="submit" class="btn btn-danger"><i class="material-icons">&#xE872;</i> Delete User</button>';
    
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
</script>
@endsection