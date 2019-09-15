@extends('user.layout')
@section('subtitle','MY ACCOUNT')
@section('title','Dashboard')
@section('body')
<!-- File Manager - Cards -->
<div class="file-manager file-manager-cards">
    <div class="card card-small mb-3">

        {{-- <div class="row no-gutters p-2">
            <div class="col-md-6 offset-md-3">
                <form action="POST">
                    <div class="input-group input-group-seamless">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="material-icons">&#xE8B6;</i>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Search files">
                        <input type="submit" class="btn btn-md btn-accent " value="Search">
                    </div>
                </form>
            </div>
        </div> --}}


    </div>

    <div class="row">
        <div class="col">
            <span class="file-manager__group-title text-uppercase text-light">Default Folders</span>
        </div>
        <div class="col">
            @can('create', App\Folder::class)
            <a href="{{url('/user/'.request()->user->id.'/add_folder')}}" class="btn btn-sm btn-accent text-white"
                style="float: right;"><i class="material-icons">&#xE145;</i> Add New Folder</a>
            @endcan
        </div>
    </div>

    <div class="row">

        <div class="col-lg-3">
            <a href="{{url('user/'.request()->user->id.'/folder/education')}}" style="text-decoration: none">
                <div class="file-manager__item card card-large mb-3">
                    <div class="card-footer">
                        <span class="file-manager__item-icon">
                            <h5 class=" font-weight-bold text-center">Education</h5>
                            <i class="material-icons">&#xE2C7;</i>
                        </span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="{{url('user/'.request()->user->id.'/folder/health')}}" style="text-decoration: none">
                <div class="file-manager__item card card-large mb-3">
                    <div class="card-footer">
                        <span class="file-manager__item-icon">
                            <h5 class=" font-weight-bold text-center">Health</h5>
                            <i class="material-icons">&#xE2C7;</i>
                        </span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="{{url('user/'.request()->user->id.'/folder/others')}}" style="text-decoration: none">
                <div class="file-manager__item card card-large mb-3">
                    <div class="card-footer">
                        <span class="file-manager__item-icon">
                            <h5 class=" font-weight-bold text-center">Others</h5>
                            <i class="material-icons">&#xE2C7;</i>
                        </span>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col">
            <span class="file-manager__group-title text-uppercase text-light">Custom Folders</span>
        </div>
        {{--  <div class="col">
            @can('create', App\Folder::class)
            <a href="{{url('add_folder')}}" class="btn btn-sm btn-accent text-white" style="float: right;"><i
            class="material-icons">&#xE145;</i> Add New Folder</a>
        @endcan
    </div> --}}
</div>
<div class="row">
    @if(count($folders)>0)
    @foreach ($folders as $folder)
    <div class="col-lg-3">
        <a href="{{url('/custom_folder/'.$folder->id)}}" style="text-decoration: none">
            <div class="file-manager__item card card-large mb-3">
                <div class="card">
                    <div class="card-footer">
                        <span class="file-manager__item-icon">
                            <h5 class=" font-weight-bold text-center">{{$folder->foldername}}</h5>
                            <i class="material-icons">&#xE2C7;</i>

                        </span>
                    </div>
                    <div class="user-details__user-data border-top border-bottom p-4">
                        <div class="row mb-3">
                            <div class="col col-6 w-50">
                                <span>Unique Code</span>
                                <span>{{$folder->uc}}</span>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Date Created</span>
                                <span>{{$folder->created_at->format('d-m-y')}} </span>
                            </div>
                            <div class="col w-50">
                                <span>Date Modified</span>
                                <span>{{$folder->updated_at->format('d-m-y')}}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </a>
    </div>
    @endforeach
    @endif
</div>
</div>
<!-- End File Manager - Cards -->
@endsection