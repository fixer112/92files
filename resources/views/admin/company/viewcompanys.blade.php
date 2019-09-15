@extends('admin.layout')
@section('subtitle','ORGANIZATION')
@section('title','View Organization')
@section('body')
<div class="file-manager file-manager-cards">


    <div class="row">
        <div class="col">
            <span class="file-manager__group-title text-uppercase text-light">Available Folders</span>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-3">
            <a href="{{url('/view_companys/education')}}" style="text-decoration: none">
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
            <a href="{{url('/view_companys/health')}}" style="text-decoration: none">
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
            <a href="{{url('/view_companys/others')}}" style="text-decoration: none">
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


</div>
@endsection