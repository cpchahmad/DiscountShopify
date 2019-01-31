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
                                <select class="form-control select3 volume_discount_select" placeholder="Choose one">
                                    <option selected="selected" value="">Please select an offer type</option>
                                    <option value="vd">Volume Discount</option>
                                    <option value="spend">Spend Amount - Get Discount</option>
                                    <option value="buy_x_dollars">Buy X for $</option>
                                </select>
                            </div>
                        </div>
                        <p>Apply a discount to selected items for buying in bulk.</p>
                    </div>
                </div>
            </div>


            <div class="select_discount_type"  id="vd" style="display:none;">
                <form action="{{route('discount.save')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="offer_type" value="vd">
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <hr>
            <div class="row">
                <div class="col-3">
                    <label class="section-title">2. Offer Details</label>
                </div>
                <div class="col-9">
                    <div class="section-wrapper">
                        <div class="row mg-b-20">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label">Offer Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="offer_name" placeholder="Offer Name" required>
                                </div>
                            </div>
                        </div>
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
                            <tbody id="volume_discount_data">
                            <tr>
                                <td>
                                <div class="row">
                                    <div class="col-2">
                                            <input class="form-control" type="number" min="1" required name="min_qty[]">
                                    </div>
                                    <div class="col-2 p-0">
                                        <input class="form-control" type="number" min="1" required name="min_qty_value[]">
                                    </div>
                                    <div class="col-4 p-0">
                                        <select name="min_qty_type[]" class="form-control" required="required">
                                            <option value="percent">% off each</option>
                                            <option value="off">USD off each</option>
                                            <option value="fixed">USD each</option>
                                        </select>
                                    </div>
                                    <div class="col-2 delete_addition">
                                        <button class="btn btn-primary btn-icon m-t-2"><div><i class="fa fa-trash"></i></div></button>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="row mg-t-20">
                            <div class="col-3">
                                <button class="btn btn-primary btn-block mg-b-20 volume_discount_addition_btn"><i class="fa fa-plus mg-r-5"></i> Add Tier</button>
                            </div>
                        </div>
                        <hr>

                        <p class="mg-b-10">Select products that will have these volume discounts applied</p>
                        <select class="form-control select2 mg-b-20" data-placeholder="Choose Products" required multiple name="products[]">
                            <option value="">--Choose Products--</option>
                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->title}}</option>
                            @endforeach
                        </select>

                        <p class="mg-b-10">Select collections that will have these volume discounts applied</p>
                        <select class="form-control select2 mg-b-20" data-placeholder="Choose Collections" required multiple name="collections[]">
                            <option value="">--Choose Collections--</option>
                            @foreach($collections as $collection)
                                <option value="{{$collection->id}}">{{$collection->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

                    <button class="btn btn-primary bd-0" type="submit">Save</button>

                </form>
            </div>

            <div class="row select_discount_type" id="spend" style="display:none;">
                <hr>
                <div class="row">

                </div>
            </div>
            <div class="select_discount_type" id="buy_x_dollars" style="display:none;">
                <hr>
                <div class="row">

                </div>
            </div>

            <div class="offer_save_wrapper" style="display:none;"><hr>
            <div class="row">
                <div class="col-3">
                    <label class="section-title">3. Save Settings</label>
                </div>
                <div class="col-9">
                    <div class="section-wrapper">
                        <div class="form-layout-footer">
                            <button class="btn btn-primary bd-0" onClick="$('#vd form').submit();">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </div><!-- form-layout -->
    </div>

    <div class="volume_discount_addition_data" style="display:none;">
        <div class="row">
            <div class="col-2">
                <input class="form-control" type="number" min="1" required name="min_qty[]">
            </div>
            <div class="col-2 p-0">
                <input class="form-control" type="number" min="1" required name="min_qty_value[]">
            </div>
            <div class="col-4 p-0">
                <select name="min_qty_type[]" class="form-control" required="required">
                    <option value="percent">% off each</option>
                    <option value="off">USD off each</option>
                    <option value="fixed">USD each</option>
                </select>
            </div>
            <div class="col-2 delete_addition">
                <button class="btn btn-primary btn-icon m-t-2"><div><i class="fa fa-trash"></i></div></button>
            </div>
        </div>
    </div>
@endsection
