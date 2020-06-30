@extends('frontend.layouts.frontend')
@section('content')
<header class="header header--mobile header--mobile-categories" data-sticky="true">
        <nav class="navigation--mobile">
            <div class="navigation__left"><a class="header__back" href="{{ url()->previous() }}"><i class="icon-chevron-left"></i><strong>Back</strong></a></div>
            <div class="navigation__right">
                <div class="header__actions">
                    <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>@if(session('cart')) {{sizeof(session('cart'))}} @else 0 @endif</i></span></a>
                        <div class="ps-cart__content">
                            <div class="ps-cart__items">
                                @if(session('cart'))
                                    @foreach(session('cart') as $key => $value)
                                    <div class="ps-product--cart-mobile">
                                        <div class="ps-product__thumbnail"><a href="#">
                                            <img src="{{ asset($value['productpic']) }}" alt=""></a>
                                        </div>
                                        <div class="ps-product__content"><a class="ps-product__remove removeCart" data-cart="{{$key}}" href="javascript:void(0);"><i class="icon-cross"></i>
                                        </a><a href="#">{{$value['productname']}}</a>
                                            <p><strong></strong></p>
                                            <small>{{$value['quantity']}} x {{env('PRICE_SYMBOL', 'Rs ')}}{{$value['productprice']}}</small>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <p>Empty Cart</p>
                                @endif
                                <?php $total = 0 ?>
                                @foreach((array) session('cart') as $key => $value)
                                    <?php $total += $value['productprice'] * $value['quantity'] ?>
                                @endforeach
                                <div class="ps-cart__footer">
                                    <h3>Sub Total:<strong>{{env('PRICE_SYMBOL', 'Rs ')}}{{$total}}</strong></h3>
                                    <figure><a class="ps-btn" href="{{route('shopping-cart')}}">View Cart</a><a class="ps-btn" href="javascript:void(0);">Checkout</a></figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ps-block--user-header">
                        <div class="ps-block__left"><i class="icon-user"></i></div>
                        @if(auth()->user())
                            <div class="ps-block__right"><a href="{{ route('my-profile') }}">My Profile</a><a href="{{ URL::to('logout') }}">Logout</a></div>
                        @else
                            <div class="ps-block__right"><a href="{{ route('account.login') }}">Login</a><a href="{{ route('account.register') }}">Register</a></div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        <div class="header__filter">
            <button class="ps-shop__filter-mb" id="filter-sidebar"><i class="icon-equalizer"></i><span>Filter</span></button>
        </div>
    </header>
    <div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li><a href="{{route('index')}}">Home</a></li>
                <li>Shop</li>
            </ul>
        </div>
    </div>

    <div class="ps-page--shop">
        <div class="ps-container">
            <div class="ps-shop-banner">
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong></strong> {{ $message }}
                </div>
            @endif
            <div class="ps-layout--shop">
                <div class="ps-layout__left">
                    @include('frontend.includes.filters')
                </div>

                <div class="ps-layout__right">
                   
                    <div class="ps-shopping ps-tab-root">
                        <div class="ps-shopping__header">
                            <p><strong>Products</strong></p>
                        </div>
                        <strong><p class="likeStatus"></strong>
                        <div class="ps-tabs">
                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-shopping-product">
                                    <div class="row">
                                    @if(isset($product))
                                    @foreach($product as $allproduct)
                                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail">
                                                    <a href="{{ route('product-detail',$allproduct->slug) }}">
                                                        <img src="{{ asset(isset($allproduct->getProductImages['0']->product_image) ? $allproduct->getProductImages['0']->product_image : 'products/no-image-icon.png') }}" alt="{{ $allproduct->product_title }}">
                                                    </a>
                                                    <ul class="ps-product__actions">
                                                        <li>
                                                            <a href="{{ route('product-detail',$allproduct->slug) }}" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview" data-viewProduct="{{$allproduct->id}}" class="viewProduct"><i class="icon-eye"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('my-wishlist',$allproduct->id)}}" data-toggle="tooltip" data-placement="top" title="Add to wishlist" class="" data-wishid=""><i class="icon-heart"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('add-to-compare',['id' => $allproduct->id])}}" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="{{ route('product-detail',$allproduct->slug) }}">{{$allproduct->product_title}}</a>
                                                    <div class="ps-product__content">
                                                        <a class="ps-product__title" href="{{ route('product-detail',$allproduct->slug) }}">{{$allproduct->product_sku}}</a>
                                                        @if($allproduct->actual_price == $allproduct->discounted_price)
                                                            <p class="ps-product__price">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $allproduct->discounted_price }}</p>
                                                        @else
                                                            <p class="ps-product__price sale">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $allproduct->discounted_price }}<del>{{env('PRICE_SYMBOL', 'Rs ')}}{{ $allproduct->actual_price }}</del></p>
                                                        @endif
                                                    </div>
                                                    <div class="ps-product__content hover">
                                                        <a class="ps-product__title" href="{{ route('product-detail',$allproduct->slug) }}">{{$allproduct->product_sku}}</a>
                                                        @if($allproduct->actual_price == $allproduct->discounted_price)
                                                            <p class="ps-product__price">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $allproduct->discounted_price }}</p>
                                                        @else
                                                            <p class="ps-product__price sale">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $allproduct->discounted_price }}<del>{{env('PRICE_SYMBOL', 'Rs ')}}{{ $allproduct->actual_price }}</del></p>
                                                        @endif
                                                            </div>
                                                </div>
                                                {!! strip_tags(Str::words($allproduct->description, 10,'....'))  !!}
                                            </div>
                                        </div>
                                    @endforeach
                                    @else
                                    <p>No data found</p>
                                    @endif
                                    </div>
                                </div>


                                <div class="ps-pagination">

                                    <ul class="pagination">
                                        @isset($product)
                                        {{$product->appends(request()->input())->links()}}
                                        @endisset
                                        <!-- <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">Next Page<i class="icon-chevron-right"></i></a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="ps-filter--sidebar">
    <div class="ps-filter__header">
        <h3>Filter Products</h3><a class="ps-btn--close ps-btn--no-boder" href="#"></a>
    </div>
    <div class="ps-filter__content">
        <aside class="widget widget_shop">
            <h4 class="widget-title">Categories</h4>
            @if($getAllCat)
                <ul class="ps-list--categories">
                    @foreach($getAllCat as $key => $value)
                        <li class="current-menu-item @if($value->getActiveSubcategory) menu-item-has-children @endif">
                            <a href="{{ asset('search-product?searchCategory='.$value->slug) }}">{{ $value->name }}</a>
                            @if($value->getActiveSubcategory->count()>0)
                            <span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                                <ul class="sub-menu">
                                    @foreach($value->getActiveSubcategory as $keySub => $valueSub)
                                        <li class="current-menu-item menu-item-has-children "><a href="{{ asset('search-product?searchCategory='.$value->slug.'_'.$valueSub->slug) }}">{{ $valueSub->name }}</a>
                                            @if($valueSub->getActiveChildCategory->count()>0)
                                            <span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                                                <ul class="sub-menu">
                                                    @foreach($valueSub->getActiveChildCategory as $keyChild => $valueChild)
                                                        <li class="current-menu-item "><a href="{{ asset('search-product?searchCategory='.$value->slug.'_'.$valueSub->slug.'_'.$valueChild->slug) }}">{{ $valueChild->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif  
        </aside>
        <aside class="widget widget_shop">
            <h4 class="widget-title">BY BRANDS</h4>
            <figure class="ps-custom-scrollbar" data-height="250">
                @foreach($brandlists as $allbrandName)
                <div class="ps-checkbox">
                    <a href="{{ asset('search-product?serchbrand='.$allbrandName->name) }}">{{ $allbrandName->name }}</a>
                </div>
                @endforeach
            </figure>
        </aside>
    </div>
</div>


@endsection