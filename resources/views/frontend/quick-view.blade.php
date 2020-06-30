<article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
    <div class="ps-product__header">
        <div class="ps-product__thumbnail" data-vertical="false">
            <div class="ps-product__images" data-arrow="true">
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
        <div class="ps-product__info">
            <h1>{{ $product->product_title }}</h1>
            <div class="ps-product__meta">
                <p>Brand:<a href="javascript:void(0);">{{ $product->getBrand->name }}</a></p>
            </div>
            <h4 class="ps-product__price">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $product->discounted_price }}<del> {{env('PRICE_SYMBOL', 'Rs ')}}{{ $product->actual_price }}</del></h4>
            <p>{!! $product->description !!}</p>
            <hr>
            <div class="ps-product__shopping">
                <form method="post" action="{{route('add-to-cart',['id' => $product->id])}}">
                    @csrf
                    <input type="hidden" name="allQuantity" value="1" class="quantity">
                    <button class="ps-btn ps-btn--black" type="submit" name="buy_now" value="Add to cart">Add to cart</button>
                    @if(auth()->user())
                    <button class="ps-btn" name="buy_now" value="Buy Now" type="submit">Buy Now</button>
                    @endif
                </form>
                <div class="ps-product__actions">
                    <a href="{{route('my-wishlist',$product->id)}}" class="wishList" data-wishid="{{$product->id}}"><i class="icon-heart"></i></a>
                    <a href="{{route('add-to-compare',['id' => $product->id])}}"><i class="icon-chart-bars"></i></a>
                </div>
            </div>
        </div>
    </div>
</article>
{!! Html::script('frontend/plugins/jquery-1.12.4.min.js') !!}
{!! Html::script('frontend/plugins/slick/slick/slick.min.js') !!}
<script type="text/javascript">
    $(function() {
    $('.ps-product--quickview .ps-product__images').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            dots: false,
            arrows: true,
            infinite: false,
            prevArrow: "<a href='#'><i class='fa fa-angle-left'></i></a>",
            nextArrow: "<a href='#'><i class='fa fa-angle-right'></i></a>",
        });
    });
</script>