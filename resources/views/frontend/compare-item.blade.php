@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index-2.html">Home</a></li>
            <li>Contact Us</li>
        </ul>
    </div>
</div>
<div class="ps-compare ps-section--shopping">
    <div class="container">
        <div class="ps-section__header">
            <h1>Compare Product</h1>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Success!</strong> {{ $message }}
            </div>
        @endif
        <div class="ps-section__content">
            <div class="table-responsive">
                <table class="table ps-table--compare">
                    <tbody>
                        <tr>
                            <td class="heading" rowspan="2">Product</td>
                        </tr>
                        <tr>
                            @if(session('compare'))
                                @foreach(session('compare') as $key => $value)
                                <td>
                                    <div class="ps-product--compare">
                                        <div class="ps-product__thumbnail"><a href="javascript:void(0);"><img src="{{ asset($value['productpic']) }}" alt=""></a></div>
                                        <div class="ps-product__content"><a href="javascript:void(0);">{{$value['productname']}}</a></div>
                                    </div>
                                </td>
                                @endforeach
                            @else
                                <td colspan="4"><h4>No Product Found</h4></td>
                            @endif
                        </tr>
                        <tr>
                            <td class="heading">Price</td>
                            @if(session('compare'))
                                @foreach(session('compare') as $key => $value)
                                    <td>
                                        <h4 class="price sale">{{env('PRICE_SYMBOL', 'Rs ')}}{{$value['productprice']}} <del>{{env('PRICE_SYMBOL', 'Rs ')}}{{$value['actualProductprice']}}</del> <small></small></h4>
                                    </td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="heading">Availability</td>
                            @if(session('compare'))
                                @foreach(session('compare') as $key => $value)
                                    <td>
                                        <p>{{$value['actualQuantity']}}</p>
                                    </td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="heading">Description</td>
                            @if(session('compare'))
                                @foreach(session('compare') as $key => $value)
                                    <td>
                                        <p>{{strip_tags($value['description'])}}</p>
                                    </td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="heading"></td>
                            @if(session('compare'))
                                @foreach(session('compare') as $key => $value)
                                    <td>
                                        <a onclick="return confirm('Do you want to remove this item from compare ?');" href="{{route('compare-item-remove',$key)}}" class="remove-btn">Remove</a>
                                        <br><br>
                                        <form method="post" action="{{route('add-to-cart',$key)}}">
                                            @csrf
                                        <input type="hidden" name="allQuantity" value="1" class="quantity">
                                            <!-- <a class="ps-btn" href="">Add To Cart</a> -->
                                            <button class="ps-btn">Add To Cart</button>
                                        </form>
                                    </td>
                                @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection