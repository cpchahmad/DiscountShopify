@extends('layouts.app')

@section('content')
    <div class="slim-mainpanel" style="position: relative;">
        <div class="container">
            <div class="slim-pageheader">
                <ol class="breadcrumb slim-breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Discount</li>
                </ol>
                <h6 class="slim-pagetitle">Create Discount</h6>
            </div>

            <div class="row">
                <div class="col-3">
                    <label class="section-title">1. Offer Type</label>
                    <p class="mg-b-20 mg-sm-b-40">Select the type of discount offer.</p>
                </div>
                <div class="col-9">
                    <div class="section-wrapper">
                        <div class="row">
                            <div class="col-6 mg-b-20">
                                <select class="form-control" data-placeholder="Choose one" tabindex="-1" aria-hidden="true">
                                    <option value="">Please select an offer type</option>
                                    <option selected="selected" value="vd">Volume Discount</option>
                                    <option value="spend">Spend Amount - Get Discount</option>
                                    <option value="buy_x_dollars">Buy X for $</option>
                                </select>
                            </div>
                        </div>
                        <p>Apply a discount to selected items for buying in bulk.</p>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-3">
                    <label class="section-title">2. Offer Details</label>
                </div>
                <div class="col-9">
                    <div class="section-wrapper">

                        <table class="table table-striped mg-b-0">
                            <thead>
                            <tr>
                                <th>
                                    <div class="row">
                                    <div class="col-2">
                                        Min Qty.
                                    </div>
                                    <div class="col-6">
                                        Discount
                                    </div>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                <div class="row">
                                    <div class="col-2">
                                            <input class="form-control" type="number">
                                    </div>
                                    <div class="col-2 p-0">
                                        <input class="form-control" type="number">
                                    </div>
                                    <div class="col-4 p-0">
                                        <select name="" class="form-control" required="required">
                                            <option value="percent">% off each</option>
                                            <option value="off">USD off each</option>
                                            <option value="fixed">USD each</option>
                                        </select>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="row mg-t-20">
                            <div class="col-3">
                                <button class="btn btn-primary btn-block mg-b-20"><i class="fa fa-plus mg-r-5"></i> Add Tier</button>
                            </div>
                        </div>
                        <hr>

                        <p class="mg-b-10">Select products that will have these volume discounts applied</p>
                        <select class="form-control select2 mg-b-20" data-placeholder="Choose Browser">
                            <option value="Firefox">Firefox</option>
                            <option value="Chrome selected">Chrome</option>
                            <option value="Safari">Safari</option>
                            <option value="Opera" selected="">Opera</option>
                            <option value="Internet Explorer">Internet Explorer</option>
                        </select>

                        <p class="mg-b-10">Select collections that will have these volume discounts applied</p>
                        <select class="form-control select2 mg-b-20" data-placeholder="Choose Browser">
                            <option value="Firefox">Firefox</option>
                            <option value="Chrome selected">Chrome</option>
                            <option value="Safari">Safari</option>
                            <option value="Opera" selected="">Opera</option>
                            <option value="Internet Explorer">Internet Explorer</option>
                        </select>

                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-3">
                    <label class="section-title">3. Save Settings</label>
                </div>
                <div class="col-9">
                    <div class="section-wrapper">
                        <div class="form-layout-footer">
                            <button class="btn btn-primary bd-0">Submit Form</button>
                            <button class="btn btn-secondary bd-0">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- form-layout -->
    </div>
@endsection
