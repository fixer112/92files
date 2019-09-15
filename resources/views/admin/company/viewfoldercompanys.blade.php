@extends('admin.layout')
@section('subtitle','ORGANIZATION')
@section('title','View Organizations ' .ucfirst(request()->folder))
@section('body')
<table class="file-manager file-manager-list d-none table-responsive">
    <thead>
        <tr>
            {{-- <th style="width: 10px;" class="hide-sort-icons"></th> --}}
            <th>photo</th>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Type</th>
            <th>State</th>
            <th>Addr</th>
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
{ data: 'name'},
{ data: 'email'},
{ data: 'num'},
{ data: 'type'},
{ data: 'state'},
{ data: 'addr'},
{ data: 'action'},
];
apiDatatable("{{url('/view_companys/'.request()->folder.'?api_token='.Auth::user()->api_token)}}",1,col);

function del(id){
    var myhtml = document.createElement("div");
    var del = '<form action="/delete_company/'+id+'" method="POST">@csrf<button type="submit" class="btn btn-danger"><i class="material-icons">&#xE872;</i> Delete Company</button>';
    
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