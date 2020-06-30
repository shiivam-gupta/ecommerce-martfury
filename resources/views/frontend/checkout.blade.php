@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{route('index')}}">Home</a></li>
            <li>Checkout</li>
        </ul>
    </div>
</div>
<div class="ps-checkout ps-section--shopping">
    <div class="container">
        <div class="ps-section__header">
            <h1>Checkout</h1>
        </div>
        @if (Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Success!</strong> {{ Session::get('success') }}
        </div>
        @endif
        @if (Session::get('error'))
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Error!</strong> {{ Session::get('error') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger login-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <hr>
        <div class="ps-section__content">
            <form class="ps-form--checkout" action="{{route('payment')}}" method="post">
                @csrf
                <input type="hidden" id="state_other" value="{{ old('state_other') }}">
                <input type="hidden" id="city_other" value="{{ old('city_other') }}">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12  ">
                        <div class="ps-form__billing-info">
                            <h3 class="ps-form__heading">Billing Details</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input class="form-control" type="text" name="first_name" value="{{$firstName}}" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input class="form-control" type="text" name="last_name" value="{{$lastName}}" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Email Address<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input class="form-control" type="email" name="email" value="{{$userDetails->email}}" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input class="form-control" type="text" name="phone" value="{{$userDetails->phone_no}}" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input class="form-control" name="country" type="text" value="{{$userDetails->getCountry->name}}" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input class="form-control" name="state" type="text" value="{{$userDetails->getState->name}}" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input class="form-control" type="text" name="city" value="{{$userDetails->getCity->name}}" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address<sup>*</sup>
                                        </label>
                                        <div class="form-group__content">
                                            <input class="form-control" type="text" name="address" value="{{$userDetails->address}}" readonly="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="ps-checkbox">
                                            <input class="form-control" type="checkbox" id="cb01" name="different_address">
                                            <label for="cb01">Ship to a different address?</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">  
                                <div class="col-md-12">  
                                    <!-- second address -->
                                    <div class="secondAddress d-none">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name<sup>*</sup>
                                                    </label>
                                                    <div class="form-group__content">
                                                        <input class="form-control" type="text" name="first_name_other" id="first_name_other" value="" placeholder="Enter First name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name<sup>*</sup>
                                                    </label>
                                                    <div class="form-group__content">
                                                        <input class="form-control" type="text" name="last_name_other" id="last_name_other" value="" placeholder="Enter Last name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email Address<sup>*</sup>
                                                    </label>
                                                    <div class="form-group__content">
                                                        <input class="form-control" type="email" name="email_other" id="email_other" value="" placeholder="Enter Email Address">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone<sup>*</sup>
                                                    </label>
                                                    <div class="form-group__content">
                                                        <input class="form-control" type="text" name="phone_other" id="phone_other" value="" placeholder="Enter Phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Country<sup>*</sup>
                                                    </label>
                                                    <div class="form-group__content">
                                                        <select id="country_other" class="form-control select2-show-search" onchange="getStateCheckout(this)" name="country_other" data-placeholder="Choose one (with searchbox)">
                                                            <option value="">--select here--</option>
                                                            @foreach($country as $key => $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>State<sup>*</sup>
                                                    </label>
                                                    <div class="form-group__content">
                                                        <select class="form-control select2-show-search state-box" onchange="getCityCheckout(this)" name="state_other" data-placeholder="Choose one (with searchbox)">
                                                            <option value="">--select here--</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>City<sup>*</sup>
                                                    </label>
                                                    <select class="form-control select2-show-search city-box" name="city_other" data-placeholder="Choose one (with searchbox)">
                                                        <option value="">--select here--</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Address<sup>*</sup>
                                            </label>
                                            <div class="form-group__content">
                                                <input class="form-control" type="text" name="address_other" id="address_other" value="" placeholder="Enter Address">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- second address -->
                                </div>
                            </div>
                            <h3 class="mt-40"> Addition information</h3>
                                <div class="form-group">
                                    <label>Order Notes</label>
                                    <div class="form-group__content">
                                        <textarea class="form-control" rows="7" placeholder="Notes about your order, e.g. special notes for delivery." name="additional_note"></textarea>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  ">
                                @php 
                                    $subtotal = 0;
                                    $discount = 0;
                                    $total = 0;
                                @endphp
                                @foreach((array) session('cart') as $key => $value)
                                @php 
                                    $subtotal += $value['productprice'] * $value['quantity']
                                @endphp
                                @endforeach
                                @php
                                    $total = $subtotal-$discount; 
                                @endphp

                                
                                <div class="ps-block--shopping-total">
                                    <div class="ps-block__content">
                                        <ul class="ps-block__product">
                                            @if(session('cart'))
                                            @foreach(session('cart') as $key => $value)
                                            <li>
                                                <div class="ps-product--cart">
                                                    <div class="ps-product__content cart-product">
                                                        <a href="javascript:void(0)" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview" data-viewProduct="{{$key}}" class="viewProduct">{{$value['productname']}}</a>
                                                    </div>
                                                </div>
                                                <strong>{{$value['quantity']}} X {{env('PRICE_SYMBOL', 'Rs ')}}{{$value['productprice']}}</strong>
                                                <span class="pull-right">
                                                    <strong>{{env('PRICE_SYMBOL', 'Rs ')}}{{$value['quantity'] * $value['productprice']}}</strong>
                                                </span>
                                            </span>
                                        </li>
                                        @endforeach
                                        @endif

                                        <li>
                                            <div class="input-group mb-12">
                                              <input type="text" class="form-control coupon-code" name="coupon_code" id="coupon_code" placeholder="Enter Coupon Code" aria-label="Enter Coupon Code" aria-describedby="basic-addon2">
                                              <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" id="apply-coupon" type="button">&nbsp;&nbsp;&nbsp;&nbsp;Apply&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                              </div>
                                            </div>
                                            <small id="show-error" class="text-danger"></small>
                                            <small id="show-success" class="text-success"></small>
                                        </li>
                                    </ul>
                                    <h3 class="discount-amount">Subtotal <span>{{env('PRICE_SYMBOL', 'Rs ')}}<span>{{$subtotal}}</span></span></h3>
                                    <h3 class="discount-amount">Tax <span>{{env('PRICE_SYMBOL', 'Rs ')}}<span>0</span></span></h3>

                                    <h3 class="discount-amount">Discount <span>{{env('PRICE_SYMBOL', 'Rs ')}}<span id="discountAmount">{{$discount}}</span></span></h3>
                                    <hr>
                                    <h3>Total <span>{{env('PRICE_SYMBOL', 'Rs ')}}<span id="totalAmount">{{$total}}</span></span></h3>
                                </div>
                                <div class="cnt_full">
                                    <div class="cnt_min">
                                        <input type="radio" name="payby" value="payumoney" checked="" /><img src="{{asset('assets/images/pay-u-money.jpg')}}" alt="Select payment method" class="selected_img" >
                                    </div>
                                    <!-- <div class="cnt_min">
                                        <input type="radio" name="payby" value="razorpay" /><img src="{{asset('assets/images/razorpay.jpg')}}" alt="Select payment method"  class="selected_img" >
                                    </div> -->
                                    <hr>
                                    <button class="ps-btn ps-btn--fullwidth">Proceed to Pay</button>
                                </div>
                                
                            </div>

                            <input type="hidden" name="currency_id" value="1">
                            <input type="hidden" name="subtotal" value="{{$subtotal}}">
                            <input type="hidden" name="total_discount" id="total_discount" value="0">
                            <input type="hidden" name="total_tax" id="total_tax" value="0">
                            <input type="hidden" name="total" id="total" value="{{$total}}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @section('extra-js')

    <script type="text/javascript">
        $(document).ready(function() {
            getState('');
            getCity('');
        });

        function getStateCheckout(e){
            var country_other = e ? e.value : $('#country_other').val();
            var state_other = $('#state_other').val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{route('getstateCheckout')}}",
                data: {'country_other': country_other, 'state_other': state_other},
                success: function(data){
                    $('.state-box').html(data.html);
                    if(e){
                        $('.city-box').html('');
                    }
                }
            });
        }
        
        function getCityCheckout(e){
            var state_other = e ? e.value : $('#state_other').val();;
            var city_other = $('#city_other').val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{route('getcityCheckout')}}",
                data: {'state_other': state_other, 'city_other': city_other},
                success: function(data){
                    $('.city-box').html(data.html);
                }
           });
        }
    </script>
    @endsection