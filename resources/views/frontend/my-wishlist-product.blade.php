@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="{{route('index')}}">Home</a></li>
            <li>Wish List</li>
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
                @include('frontend.includes.sidemenu')
            </div>
            <div class="ps-layout__right">

                <div class="ps-block--vendor-dashboard">
                    <div class="ps-block__header">
                        <h3>My Wishlist</h3>
                    </div>
                    <div class="ps-tabs">
                            <div class="ps-shopping-product">
                                <div class="row">

                                    @forelse($wishList as $allwishList)
                                    <div class="col-md-4 col-sm-6">
                                        <div class="ps-product">
                                            <div class="ps-product__thumbnail">
                                                <a href="{{ route('product-detail',$allwishList->wishlistProduct->slug) }}">
                                                    @foreach($allwishList->wishlistProduct->getProductImages->take(1) as $allImage)
                                                    <img src="{{URL::to($allImage->product_image)}}" alt="">
                                                    @endforeach
                                                </a>
                                                <ul class="ps-product__actions">
                                                    <li>
                                                        <a href="{{ route('product-detail',$allwishList->wishlistProduct->slug) }}" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview" data-viewProduct="{{$allwishList->wishlistProduct->id}}" class="viewProduct"><i class="icon-eye"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('my-wishlist',$allwishList->wishlistProduct->id)}}" data-toggle="tooltip" data-placement="top" title="Remove from wish list" class="wishList" data-wishid=""><i class="icon-heart-pulse"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('add-to-compare',['id' => $allwishList->wishlistProduct->id])}}" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__container"><a class="ps-product__vendor" href="{{ route('product-detail',$allwishList->wishlistProduct->slug) }}">{{$allwishList->wishlistProduct->product_title}}</a>
                                                <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product-detail',$allwishList->wishlistProduct->slug) }}">{{$allwishList->wishlistProduct->product_sku}}</a>
                                                    <p class="ps-product__price">{{$allwishList->wishlistProduct->actual_price}}</p>
                                                </div>
                                                <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('product-detail',$allwishList->wishlistProduct->slug) }}">{{$allwishList->wishlistProduct->product_sku}}</a>
                                                    <p class="ps-product__price">{{$allwishList->wishlistProduct->actual_price}}</p>
                                                </div>
                                            </div>{{$allwishList->wishlistProduct->description}}
                                        </div>
                                    </div>

                                    @empty
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <div class="alert alert-info" role="alert">
                                          Item not found!!!
                                      </div>
                                  </div>
                                  @endforelse
                              </div>


                          <div class="ps-pagination">

                            <ul class="pagination">
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
    @endsection