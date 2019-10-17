@extends('admin.layout')
@section('subtitle','Statistics')
@section('title','All Statistics')

@section('body')
<div id="folder">
    <div class="row no-gutters h-100">
        <div class="col-md-10 offset-md-4 mx-auto mt-4">

            <div class="card card-small edit-user-details mb-4 margin-top40"
                style="overflow:hidden;box-shadow:inset 0 4px 0 0 #17c671;border-radius:.625rem">
                <div class="card-body p-0">
                    <form action="{{url('/stats')}}" class="py-4 form-horizontal">

                        <div class="form-row mx-4">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="">From</label>
                                        <input type="date" class="form-control @error('from') is-invalid @enderror"
                                            name="from" value="{{$from->format('Y-m-d')}}" />
                                        @error('from')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <label for="">To</label>
                                        <input type="date" class="form-control @error('to') is-invalid @enderror"
                                            name="to" value="{{$to->format('Y-m-d')}}" />
                                        @error('to')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">State</label>
                                        <select class="custom-select @error('state') is-invalid @enderror" name="state">
                                            <option {{ $selectedState == 'All' ? 'selected' :''}} value="All">All State
                                            </option>
                                            @foreach($states as $state)
                                            <option {{ $selectedState == $state ? 'selected' :''}} value="{{$state}}">
                                                {{$state}}</option>
                                            @endforeach
                                        </select>

                                        @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>



                                    <button class="btn btn-md btn-accent ml-auto float-right">Submit</button>

                                </div>
                            </div>
                        </div>
                    </form>

                    <div id="folder">
                        <table class="file-manager file-manager-list d-none table-responsive">
                            <thead>
                                <tr>
                                    {{-- <th style="width: 10px;" class="hide-sort-icons"></th> --}}

                                    <th>Id</th>
                                    <th>By</th>
                                    <th>State of Origin</th>
                                    <th>Summary</th>
                                    <th>Role</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $activity )
                                <tr>
                                    <td>
                                        {{$activity->id}}
                                    </td>
                                    <td>
                                        @if ($activity->user->isAdmin())
                                        {{$activity->user->username}}

                                        @else

                                        <a href="/user/{{$activity->user->id}}">{{$activity->user->username}}</a>
                                        @endif

                                    </td>
                                    <td>
                                        {{$activity->user->so}}
                                    </td>
                                    <td>
                                        {!!$activity->summary !!}
                                    </td>
                                    <td>
                                        {{$activity->user->role}}
                                    </td>

                                    <td>
                                        {{$activity->created_at }}
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
            $(".file-manager-list").DataTable();
            $(".file-manager__item").click(function(){(this).toggleClass("file-manager__item--selected")});
    });
</script>
@endsection