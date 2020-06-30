@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="{{route('index')}}">Home</a></li>
            <li>Orders Reviews</li>
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
                            <h3>My Reviews</h3>
                        </div>
                        <div class="ps-tabs">
                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-shopping-product">
                                    <div class="ps-section__content">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  ">
                                            <div class="ps-form__total">
                                                <div class="content">
                                                    <div class="ps-block--checkout-total">
                                                        <div class="ps-block__content">
                                                            <table class="table ps-block__products">
                                                                <tbody>
                                                                    @foreach($reviewsDetails as $allDetails)
                                                                    <tr>
                                                                        <td>
                                                                            <p>{{$allDetails->review_rate}} Rating</p>
                                                                            <a href="javascript:void(0);" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview" data-viewProduct="{{$allDetails->orderDetails->product_id}}" class="viewProduct"> {{$allDetails->orderDetails->productDetails->product_title}} </a>
                                                                            <p>Comment:<strong> {{$allDetails->comment}}</strong></p>
                                                                            <p>Date: {{$allDetails->created_at}}</p>
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