@extends('frontend.layouts.frontend')
@section('content')
    <div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ asset('search-product?searchCategory='.$product->getCategory->slug) }}">{{ $product->getCategory->name }}</a></li>
                @if($product->getSubCategory)
                    <li><a href="{{ asset('search-product?searchCategory='.$product->getCategory->slug.'_'.$product->getSubCategory->slug) }}">{{ $product->getSubCategory->name }}</a></li>
                @endif
                @if($product->getChildCategory)
                    <li><a href="{{ asset('search-product?searchCategory='.$product->getCategory->slug.'_'.$product->getSubCategory->slug.'_'.$product->getChildCategory->slug) }}">{{ $product->getChildCategory->name }}</a></li>
                @endif
                <li>{{ $product->product_title }}</li>
            </ul>
        </div>
    </div>
    <div class="ps-page--product">
        <div class="ps-container">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong></strong> {{ $message }}
                </div>
            @endif
            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    {{ $message }}
                </div>
            @endif
            <div class="ps-page__container">
                <div class="ps-page__left">
                    <div class="ps-product--detail ps-product--fullwidth">
                        <div class="ps-product__header">
                            <div class="ps-product__thumbnail" data-vertical="true">
                                <figure>
                                    <div class="ps-wrapper">
                                        <div class="ps-product__gallery" data-arrow="true">
                                            @if($product->getProductImages)
                                                @foreach($product->getProductImages as $key => $value)
                                                    <div class="item">
                                                        <a href="{{ asset($value->product_image) }}">
                                                            <img src="{{ asset($value->product_image) }}" alt="{{ $product->product_title }}">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </figure>
                                <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
                                    @if($product->getProductImages)
                                        @foreach($product->getProductImages as $key => $value)
                                            <div class="item"><img src="{{ asset($value->product_image) }}" alt="{{ $product->product_title }}"></div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="ps-product__info">
                                <h1>{{ $product->product_title }}</h1>
                                <div class="ps-product__meta">
                                    <p>Brand:<a href="javascript:void(0);">{{ $product->getBrand->name }}</a></p>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="0" @if(isset($product)) {{ $product->review_rate == 'null' ? 'selected' : '' }} @endif>1</option>
                                            <option value="1" @if(isset($product)) {{ $product->review_rate == '1' ? 'selected' : '' }} @endif>1</option>
                                            <option value="2" @if(isset($product)) {{ $product->review_rate == '2' ? 'selected' : '' }} @endif>2</option>
                                            <option value="3" @if(isset($product)) {{ $product->review_rate == '3' ? 'selected' : '' }} @endif>3</option>
                                            <option value="4" @if(isset($product)) {{ $product->review_rate == '4' ? 'selected' : '' }} @endif>4</option>
                                            <option value="5" @if(isset($product)) {{ $product->review_rate == '5' ? 'selected' : '' }} @endif>5</option>
                                        </select><span>({{$product->total_review ? $product->total_review : '0'}} review)</span>
                                    </div>
                                </div>
                                <h4 class="ps-product__price">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $product->discounted_price }}<del>{{env('PRICE_SYMBOL', 'Rs ')}}{{ $product->actual_price }}</del></h4>
                                
                                <div class="ps-product__shopping">
                                    
                                    <figure>
                                        <figcaption>Quantity</figcaption>
                                        
                                        <div class="form-group--number">
                                            <button class="up"><i class="fa fa-plus"></i></button>
                                            <button class="down"><i class="fa fa-minus"></i></button>
                                            <input name="quantity" value="1" class="form-control quantity" type="text" placeholder="1" readonly="">
                                        </div>  
                                    </figure>
                                    <form method="post" action="{{route('add-to-cart',['id' => $product->id])}}">
                                        @csrf
                                        <input type="hidden" name="allQuantity" value="1" class="quantity">
                                        <button class="ps-btn ps-btn--black" type="submit" name="buy_now" value="Add to cart">Add to cart</button>
                                        @if(auth()->user())
                                        <button class="ps-btn" name="buy_now" value="Buy Now" type="submit">Buy Now</button>
                                        @endif
                                    </form>
                                    <div class="ps-product__actions">
                                        <a href="{{route('my-wishlist',$product->id)}}" class="" data-wishid=""><i class="icon-heart"></i>
                                    </a>
                                    <a href="{{route('add-to-compare',['id' => $product->id])}}"><i class="icon-chart-bars"></i></a></div>
                                </div>
                                <div class="ps-product__specification">
                                    <p><strong>SKU:</strong> {{ $product->product_sku }}</p>
                                    <p class="categories"><strong> Categories:</strong>
                                        <a href="{{ asset('search-product?searchCategory='.$product->getCategory->slug) }}">{{ $product->getCategory->name }}</a>
                                        @if($product->getSubCategory)
                                            ,<a href="{{ asset('search-product?searchCategory='.$product->getCategory->slug.'_'.$product->getSubCategory->slug) }}"> {{ $product->getSubCategory->name }}</a>
                                        @endif
                                        @if($product->getChildCategory)
                                            ,<a href="{{ asset('search-product?searchCategory='.$product->getCategory->slug.'_'.$product->getSubCategory->slug.'_'.$product->getChildCategory->slug) }}">{{ $product->getChildCategory->name }}</a></p>
                                        @endif
                                        
                                </div>
                                <div class="ps-product__sharing">
                                    <a href="javascript:;" class="facebook" onClick="shareonFb('{{$product->slug}}','{{@$product->getProductImages[0]->product_image}}')"><i class="fa fa-facebook"></i></a>

                                    <a href="javascript:;" class="google" onClick="return googleplusbtn('{{ route('product-detail',[$product->slug]) }}')"><i class="fa fa-google-plus"></i></a>

                                    <a target="_blank" class="twitter" href="https://twitter.com/intent/tweet?text={{$product->product_title}}&amp;url={{ route('product-detail',[$product->slug]) }}&amp;via={{ $appsetting->app_name }}"><i class="fa fa-twitter"></i></a>

                                    <a href="whatsapp://send?text={{ route('product-detail',[$product->slug]) }}" class="linkedin"><i class="fa fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product__content ps-tab-root">
                            <ul class="ps-tab-list">
                                <li class="active"><a href="#tab-1">Description</a></li>
                                {{-- <li><a href="#tab-2">Specification</a></li> --}}
                                {{-- <li><a href="#tab-3">Vendor</a></li> --}}
                                <li><a href="#tab-4">Reviews ({{$product->total_review ? $product->total_review : '0'}})</a></li>
                                {{--  <li><a href="#tab-5">Questions and Answers</a></li> --}}
                                {{--  <li><a href="#tab-6">More Offers</a></li>  --}}
                            </ul>
                            <div class="ps-tabs">
                                <div class="ps-tab active" id="tab-1">
                                    <div class="ps-document">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                                <div class="ps-tab" id="tab-4">
                                    <div class="row">
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 ">
                                            <div class="ps-block--average-rating">
                                                <div class="ps-block__header">
                                                    <h3>
                                                        @if(isset($product->total_review))
                                                        {{$product->total_review}}.00
                                                        @else
                                                        0.00
                                                        @endif
                                                    </h3>
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="0" @if(isset($product)) {{ $product->review_rate == 'null' ? 'selected' : '' }} @endif>1</option>
                                                        <option value="1" @if(isset($product)) {{ $product->review_rate == '1' ? 'selected' : '' }} @endif>1</option>
                                                        <option value="2" @if(isset($product)) {{ $product->review_rate == '2' ? 'selected' : '' }} @endif>2</option>
                                                        <option value="3" @if(isset($product)) {{ $product->review_rate == '3' ? 'selected' : '' }} @endif>3</option>
                                                        <option value="4" @if(isset($product)) {{ $product->review_rate == '4' ? 'selected' : '' }} @endif>4</option>
                                                        <option value="5" @if(isset($product)) {{ $product->review_rate == '5' ? 'selected' : '' }} @endif>5</option>
                                                    </select><span>{{$product->total_review}} Review</span>
                                                </div>
                                                <div class="ps-block__star"><span>5 Star</span>
                                                    <div class="ps-progress" data-value="{{$fiveStar}}"><span></span></div><span>{{$fiveStar}}</span>
                                                </div>
                                                <div class="ps-block__star"><span>4 Star</span>
                                                    <div class="ps-progress" data-value="{{$fourStar}}"><span></span></div><span>{{$fourStar}}</span>
                                                </div>
                                                <div class="ps-block__star"><span>3 Star</span>
                                                    <div class="ps-progress" data-value="{{$threeStar}}"><span></span></div><span>{{$threeStar}}</span>
                                                </div>
                                                <div class="ps-block__star"><span>2 Star</span>
                                                    <div class="ps-progress" data-value="{{$twoStar}}"><span></span></div><span>{{$twoStar}}</span>
                                                </div>
                                                <div class="ps-block__star"><span>1 Star</span>
                                                    <div class="ps-progress" data-value="{{$oneStar}}"><span></span></div><span>{{$oneStar}}</span>
                                                </div>
                                            </div><br>
                                            <div>
                                                @foreach($totalReview as $allreview)
                                                    <p>{{$allreview->usersDetails->fullname}}
                                                        <select class="ps-rating" data-read-only="true">
                                                        <option value="0" @if(isset($allreview)) {{ $allreview->review_rate == 'null' ? 'selected' : '' }} @endif>1</option>
                                                        <option value="1" @if(isset($allreview)) {{ $allreview->review_rate == '1' ? 'selected' : '' }} @endif>1</option>
                                                        <option value="2" @if(isset($allreview)) {{ $allreview->review_rate == '2' ? 'selected' : '' }} @endif>2</option>
                                                        <option value="3" @if(isset($allreview)) {{ $allreview->review_rate == '3' ? 'selected' : '' }} @endif>3</option>
                                                        <option value="4" @if(isset($allreview)) {{ $allreview->review_rate == '4' ? 'selected' : '' }} @endif>4</option>
                                                        <option value="5" @if(isset($allreview)) {{ $allreview->review_rate == '5' ? 'selected' : '' }} @endif>5</option>
                                                    </select>
                                                        <p>{{$allreview->comment}}</p>
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                        @if($checkReview)
                                            <p></p>
                                        @else
                                            @if($OrderDetails)
                                                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                                                    <form class="ps-form--review" action="{{route('my-reviews-save')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        <h4>Submit Your Review</h4>
                                                        <div class="form-group form-group__rating">
                                                            <label>Your rating of this product</label>
                                                            <select name="review_rate" class="ps-rating" data-read-only="false">
                                                                <option value="0">0</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea name="comment" class="form-control" rows="6" placeholder="Write your review here"></textarea>
                                                        </div>
                                                        <div class="form-group submit">
                                                            <button class="ps-btn">Submit Review</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-page__right">
                    <aside class="widget widget_ads"><a href="#"><img src="{{asset('frontend/img/ads/product-ads.png')}}" alt=""></a></aside>
                    <aside class="widget widget_same-brand">
                        <h3>Similar Brand</h3>
                        <div class="widget__content">
                            @if($similarBrandProd)
                                @foreach($similarBrandProd as $key => $value)
                                    @php $totalDisc = (($value->actual_price - $value->discounted_price) / $value->actual_price)*100; @endphp
                                    <div class="ps-product">
                                        <div class="ps-product__thumbnail"><a href="{{ route('product-detail',$value->slug) }}"><img src="{{ asset(isset($value->getProductImages['0']->product_image) ? $value->getProductImages['0']->product_image : '') }}" alt=""  height="100px" width="100px"></a>
                                            @if($value->actual_price != $value->discounted_price)
                                                <div class="ps-product__badge">-{{ round($totalDisc) }}%</div>
                                            @endif
                                            <ul class="ps-product__actions">
                                                <li><a href="{{ route('product-detail',$value->slug) }}" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                                <li><a href="javascript:void(0);" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview" data-viewProduct="{{$value->id}}" class="viewProduct"><i class="icon-eye"></i></a></li>
                                                <li><a href="{{route('my-wishlist',$value->id)}}" data-toggle="tooltip" data-placement="top" title="Add to wishlist" class="" data-wishid=""><i class="icon-heart"></i></a></li>
                                                <li><a href="{{route('add-to-compare',['id' => $value->id])}}" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="ps-product__container"><a class="ps-product__vendor" href="{{ route('product-detail',$value->slug) }}">{{ $value->product_title }}</a>
                                            <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product-detail',$value->slug) }}">{{ $value->product_sku }}</a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="0" @if(isset($value)) {{ $value->review_rate == 'null' ? 'selected' : '' }} @endif>1</option>
                                                        <option value="1" @if(isset($value)) {{ $value->review_rate == '1' ? 'selected' : '' }} @endif>1</option>
                                                        <option value="2" @if(isset($value)) {{ $value->review_rate == '2' ? 'selected' : '' }} @endif>2</option>
                                                        <option value="3" @if(isset($value)) {{ $value->review_rate == '3' ? 'selected' : '' }} @endif>3</option>
                                                        <option value="4" @if(isset($value)) {{ $value->review_rate == '4' ? 'selected' : '' }} @endif>4</option>
                                                        <option value="5" @if(isset($value)) {{ $value->review_rate == '5' ? 'selected' : '' }} @endif>5</option>
                                                    </select><span>{{$value->total_review ? $value->total_review : '0'}} Review</span>
                                                </div>
                                                @if($value->actual_price == $value->discounted_price)
                                                    <p class="ps-product__price">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->discounted_price }}</p>
                                                @else
                                                    <p class="ps-product__price sale">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->discounted_price }}<del> {{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->actual_price }}</del></p>
                                                @endif 
                                            </div>
                                            <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('product-detail',$value->slug) }}">{!! strip_tags(Str::words($value->description, 8,'....'))  !!}</a>
                                                @if($value->actual_price == $value->discounted_price)
                                                    <p class="ps-product__price">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->discounted_price }}</p>
                                                @else
                                                    <p class="ps-product__price sale">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->discounted_price }}<del>{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->actual_price }}</del></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </aside>
                </div>
            </div>
            <div class="ps-section--default">
                <div class="ps-section__header">
                    <h3>Related products</h3>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                        @if($similarCatProd)
                            @foreach($similarCatProd as $key => $value)
                                @php $totalDisc = (($value->actual_price - $value->discounted_price) / $value->actual_price)*100; @endphp
                                <div class="ps-product">
                                    <div class="ps-product__thumbnail"><a href="{{ route('product-detail',$value->slug) }}"><img src="{{ asset(isset($value->getProductImages['0']->product_image) ? $value->getProductImages['0']->product_image : 'products/no-image-icon.png') }}" alt="" height="100px" width="100px"></a>
                                        @if($value->actual_price != $value->discounted_price)
                                            <div class="ps-product__badge">-{{ round($totalDisc) }}%</div>
                                        @endif
                                        <ul class="ps-product__actions">
                                            <li><a href="{{ route('product-detail',$value->slug) }}" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                            <li><a href="javascript:void(0);" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview" data-viewProduct="{{$value->id}}" class="viewProduct"><i class="icon-eye"></i></a></li>
                                            <li><a href="{{route('my-wishlist',$value->id)}}" data-toggle="tooltip" data-placement="top" title="Add to wishlist" class="" data-wishid=""><i class="icon-heart"></i></a></li>
                                            <li><a href="{{route('add-to-compare',['id' => $value->id])}}" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="ps-product__container"><a class="ps-product__vendor" href="{{ route('product-detail',$value->slug) }}">{{ $value->product_title }}</a>
                                        <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product-detail',$value->slug) }}">{{ $value->product_sku }}</a>
                                            <div class="ps-product__rating">
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="0" @if(isset($value)) {{ $value->review_rate == 'null' ? 'selected' : '' }} @endif>1</option>
                                                        <option value="1" @if(isset($value)) {{ $value->review_rate == '1' ? 'selected' : '' }} @endif>1</option>
                                                        <option value="2" @if(isset($value)) {{ $value->review_rate == '2' ? 'selected' : '' }} @endif>2</option>
                                                        <option value="3" @if(isset($value)) {{ $value->review_rate == '3' ? 'selected' : '' }} @endif>3</option>
                                                        <option value="4" @if(isset($value)) {{ $value->review_rate == '4' ? 'selected' : '' }} @endif>4</option>
                                                        <option value="5" @if(isset($value)) {{ $value->review_rate == '5' ? 'selected' : '' }} @endif>5</option>
                                                    </select><span>{{$value->total_review ? $value->total_review : '0'}} Review</span>
                                                </div>
                                            </div>
                                            @if($value->actual_price == $value->discounted_price)
                                                <p class="ps-product__price">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->discounted_price }}</p>
                                            @else
                                                <p class="ps-product__price sale">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->discounted_price }}<del>{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->actual_price }}</del></p>
                                            @endif
                                        </div>
                                        <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('product-detail',$value->slug) }}">{!! strip_tags(Str::words($value->description, 8,'....'))  !!}</a>
                                            @if($value->actual_price == $value->discounted_price)
                                                <p class="ps-product__price">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->discounted_price }}</p>
                                            @else
                                                <p class="ps-product__price sale">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->discounted_price }}<del>{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->actual_price }}</del></p>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-js')
    <script type="text/javascript">
        $(document).on('click','.down',function(){
            var quantity = $(".quantity").val();
            if (quantity > 1) {
                var allQuantity = quantity - 1;
                $(".quantity").val(allQuantity);
            }else{
                alert('Quantity should not be less than 1.');
            }
        });
        $(document).on('click','.up',function(){
            var quantity = $(".quantity").val();
            var allQuantity = parseInt(quantity) + parseInt(1);
            $(".quantity").val(allQuantity);
        });
    </script>
<script type="text/javascript">
    window.fbAsyncInit = function() {
          FB.init({
            appId      : {!!env('FACEBOOK_APP_ID', '598342383663026')!!},
            xfbml      : true,
            version    : 'v2.5'
          });
        };

        (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/en_US/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));

        function shareonFb(title,img){
          FB.ui(
          {
            method: 'feed',
            name: title,
            link: "{{ route('product-detail',$product->slug) }}",
            picture: appurl+'/products/'+img
          });
        }

        function googleplusbtn(url) {
          sharelink = "https://plus.google.com/share?url="+url;
          newwindow=window.open(sharelink,'name','height=400,width=600');
          if (window.focus) {newwindow.focus()}
            return false;
        }
</script>

@endsection