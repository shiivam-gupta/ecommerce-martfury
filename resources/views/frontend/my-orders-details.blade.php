@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="{{route('index')}}">Home</a></li>
            <li>Orders Details</li>
        </ul>
    </div>
</div>
<div class="ps-page--shop">
    <div class="ps-container">
        <div class="ps-shop-banner">
        </div>
        <div class="ps-layout--shop">
            <div class="ps-layout__left">
                @include('frontend.includes.sidemenu')
            </div>
            <div class="ps-layout__right">
                <div class="ps-shopping ps-tab-root">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Success!</strong> {{ $message }}
                        </div>
                    @endif
                    <div class="ps-block--vendor-dashboard">
                            <div class="ps-block__header">
                                <h3>My Order Detail</h3>
                            </div>
                        <div class="ps-tabs">
                        <div class="ps-tab active" id="tab-1">
                            <div class="ps-shopping-product">
                                <div class="ps-section__content">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  ">
                                            <div class="ps-form__total">
                                                <div class="content">
                                                    <div class="ps-block--checkout-total">
                                                        <div class="">
                                                            <p><strong>Trasaction Id:</strong> {{$orders->transaction_id}}
                                                            <span class="pull-right"><strong>Order date:</strong> {{$orders->created_at}}</span></p>
                                                        </div>
                                                        <div class="ps-block__content">
                                                            <table class="table ps-table ps-table--vendor">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product Info</th>
                                                                        <th>Quantity</th>
                                                                        <th>Price</th>
                                                                        <th>Subtotal</th>
                                                                        <th>Review</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($orders->ordersDetails as $allorderdetails)
                                                                    <tr>
                                                                        <td>{{$allorderdetails->productDetails->product_title}}</td>
                                                                        <td>{{$allorderdetails->quantity}}</td>
                                                                        <td>{{env('PRICE_SYMBOL', 'Rs ')}}{{$allorderdetails->product_price}}</td>
                                                                        <td>{{env('PRICE_SYMBOL', 'Rs ')}}{{$allorderdetails->total_amount}}</td>
                                                                        <td>
                                                                            <a href="{{ route('product-detail',$allorderdetails->productDetails->slug) }}" class="ps-btn view-order tooltips" data-placement="top">Review</a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <div class="invoice-table">
                                                                <table class="table ps-table ps-table--vendor">
                                                                    <tr>
                                                                        <th class="invoice-table-th" width="70%">Subtotal</th>
                                                                        <td>{{env('PRICE_SYMBOL', 'Rs ')}}{{$orders->subtotal}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="invoice-table-th">Total Tax</th>
                                                                        <td>{{env('PRICE_SYMBOL', 'Rs ')}}{{$orders->total_tax}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="invoice-table-th">Total Discount</th>
                                                                        <td>{{env('PRICE_SYMBOL', 'Rs ')}}{{$orders->total_discount}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="invoice-table-th">Total</th>
                                                                        <td><strong>{{env('PRICE_SYMBOL', 'Rs ')}}{{$orders->total}}</strong></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-js')

@endsection