@extends('layouts.app')
@section('content')
<div class="slim-mainpanel" style="position: relative;">
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="slim-pagetitle">Dashboard</h6>
        </div>

        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            <strong>Well done!</strong> You successfully Create Offer for Discount.
        </div>
        @endif

<div class="row row-xs">
    <div class="col-sm-6 col-lg-3">
        <div class="card card-status">
            <div class="media">
                <i class="icon ion-ios-cloud-download-outline tx-purple"></i>
                <div class="media-body">
                    <h1>32,604</h1>
                    <p>Total Orders</p>
                </div><!-- media-body -->
            </div><!-- media -->
        </div><!-- card -->
    </div><!-- col-3 -->
    <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
        <div class="card card-status">
            <div class="media">
                <i class="icon ion-ios-bookmarks-outline tx-teal"></i>
                <div class="media-body">
                    <h1>{{$offer_count}}</h1>
                    <p>Total Offers</p>
                </div><!-- media-body -->
            </div><!-- media -->
        </div><!-- card -->
    </div><!-- col-3 -->
    <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
        <div class="card card-status">
            <div class="media">
                <i class="icon ion-ios-cloud-upload-outline tx-primary"></i>
                <div class="media-body">
                    <h1>61,119</h1>
                    <p>Total uploads</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
        <div class="card card-status">
            <div class="media">
                <i class="icon ion-ios-analytics-outline tx-pink"></i>
                <div class="media-body">
                    <h1>2,942</h1>
                    <p>Total analytics</p>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="row mg-t-30">
            <div class="col-3">
                <label class="section-title">Manage Offers</label>
            </div>
            <div class="col-9">
                <div class="section-wrapper">
                    <div class="table-responsive">
                        <table class="table mg-b-0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $offer)
                            <tr>
                                <td>{{$offer->offer_name}}</td>
                                <td>
                                    @if($offer->offer_type == 'vd')
                                    Volume Discount
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button style="padding:2px 10px;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div><!-- dropdown-menu -->
                                    </div>
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
