@extends('backend.admin.layouts.app')

@section('content')
    <div class="row mt-2rm">
        <div class="col-md-3">
            <div class="info-box vendorbox card">
                <span class="info-box-icon  elevation-1 text-purple"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">subscribers</span>
                    <span class="info-box-number fz-22">4</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box vendorbox card">
                <span class="info-box-icon  elevation-1 text-purple"><i class="fab fa-gg"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">revenue</span>
                    <span class="info-box-number fz-22">3</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box vendorbox card">
                <span class="info-box-icon  elevation-1 text-purple"><i class="fab fa-shopify"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">vendor</span>
                    <span class="info-box-number fz-22">5</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Revenue</h5>
                    <canvas id="monthlyRevenueChart" class="h-400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">subscribers</h5>
                    <canvas id="monthlySubscriberChart" class="h-400"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
