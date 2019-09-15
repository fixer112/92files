@extends('admin.layout')
@section('subtitle','MY ACCOUNT')
@section('title','Admin Dashboard')
@section('body')
<!-- Small Stats Blocks -->
<div class="row">
    <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="stats-small card card-small">
            <div class="card-body px-0 pb-0">
                <div class="d-flex px-3">
                    <div class="stats-small__data">
                        <span class="stats-small__label mb-1 text-uppercase">Admin</span>
                        <h6 class="stats-small__value count m-0">@number($admins)</h6>
                    </div>
                    <div class="stats-small__data text-right align-items-center">
                        <span class="stats-small__percentage stats-small__percentage--increase">12.4%</span>
                    </div>
                </div>
                <canvas height="60" class="analytics-overview-stats-small-1"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="stats-small card card-small">
            <div class="card-body px-0 pb-0">
                <div class="d-flex px-3">
                    <div class="stats-small__data">
                        <span class="stats-small__label mb-1 text-uppercase">Organization</span>
                        <h6 class="stats-small__value count m-0">@number($companys)</h6>
                    </div>
                    <div class="stats-small__data text-right align-items-center">
                        <span class="stats-small__percentage stats-small__percentage--increase">7.21%</span>
                    </div>
                </div>
                <canvas height="60" class="analytics-overview-stats-small-2"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="stats-small card card-small">
            <div class="card-body px-0 pb-0">
                <div class="d-flex px-3">
                    <div class="stats-small__data">
                        <span class="stats-small__label mb-1 text-uppercase">Users</span>
                        <h6 class="stats-small__value count m-0">@number($users)</h6>
                    </div>
                    <div class="stats-small__data text-right align-items-center">
                        <span class="stats-small__percentage stats-small__percentage--decrease">2.71%</span>
                    </div>
                </div>
                <canvas height="60" class="analytics-overview-stats-small-3"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- End Small Stats Blocks -->
@endsection