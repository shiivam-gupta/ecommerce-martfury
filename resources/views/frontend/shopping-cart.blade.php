@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{route('index')}}">Home</a></li>
            <li><a href="javascript:void(0);">Shop</a></li>
        </ul>
    </div>
</div>
<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
        <div class="ps-section__header">
            <h1>Shopping Cart</h1>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Success!</strong> {{ $message }}
            </div>
        @endif
        @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ $message }}
            </div>
        @endif
        <form class="cartForm" action="{{route('my-cart-update')}}" method="post">
        @csrf
        <div class="ps-section__content">
            <div class="table-responsive">
                <table class="table ps-table--shopping-cart">
                    <thead>
                        <tr>
                            <th>Product name</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                            <th>TOTAL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('cart'))
                            @foreach(session('cart') as $key => $value)
                            <input type="hidden" name="cartProduct[{{ $key }}][id]" class="form-control" type="text" placeholder="1" value="{{$key}}">
                                <tr>
                                    <td>
                                        <div class="ps-product--cart">
                                            <div class="ps-product__thumbnail"><a href="{{ route('product-detail',$value['slug'])}}"><img src="{{ asset($value['productpic']) }}" alt=""></a></div>
                                            <div class="ps-product__content"><a href="{{ route('product-detail',$value['slug'])}}">{{$value['productname']}}</a>
                                                <!-- <p>Sold By:<strong> YOUNG SHOP</strong></p> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price">{{env('PRICE_SYMBOL', 'Rs ')}}{{$value['productprice']}}</td>
                                    <td>
                                        <div class="form-group--number">
                                            <button type="button" class="up">+</button>
                                            <button type="button" class="down">-</button>
                                            <input name="cartProduct[{{ $key }}][quantity]" class="form-control quantity" type="text" placeholder="1" value="{{$value['quantity']}}" readonly="">
                                        </div>
                                    </td>
                                    <td>{{env('PRICE_SYMBOL', 'Rs ')}}{{$value['productprice'] * $value['quantity']}}</td>
                                    <td><a href="javascript:void();" data-cart="{{$key}}" class="removeCart"><i class="icon-cross "></i></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>No Product</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="ps-section__cart-actions">
                <a class="ps-btn" href="{{url()->previous()}}"><i class="icon-arrow-left"></i> Back to Shop</a>
                <!-- <a class="ps-btn ps-btn--outline button submitCart" href="#"></i> Update cart</a> -->
                <button class="ps-btn ps-btn--outline btn submitCart">Update cart</button>
            </div>
        </div>
        </form>
        <div class="ps-section__footer">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                    <a href="{{route('checkout')}}" class="ps-btn ps-btn--fullwidth">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-js')
@endsection