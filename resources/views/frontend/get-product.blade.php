<strong><p class="likeStatus"></strong>

<div class="ps-section__content">
    <div class="ps-carousel--nav owl-slider all-product" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
        @if($products)
            @foreach($products as $key => $value)
                @php $totalDisc = (($value->actual_price - $value->discounted_price) / $value->actual_price)*100; @endphp
                <div class="ps-product">
                    <div class="ps-product__thumbnail">
                        <a href="{{ route('product-detail',$value->slug) }}">
                            <img src="{{ asset(isset($value->getProductImages['0']->product_image) ? $value->getProductImages['0']->product_image : 'products/no-image-icon.png') }}" alt="{{ $value->product_title }}" height="100px" width="100px"></a>
                        @if(!empty($totalDisc))
                            <div class="ps-product__badge">-{{ round($totalDisc) }}%</div>
                        @endif
                        <ul class="ps-product__actions">
                            <li>
                                <a href="{{ route('product-detail',$value->slug) }}" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a>
                            </li>

                            <li>
                                <a href="javascript:void(0)" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview" data-viewProduct="{{$value->id}}" class="viewProduct"><i class="icon-eye"></i></a>
                            </li>

                            <li>
                               
                                <a href="{{route('my-wishlist',$value->id)}}" data-toggle="tooltip" class="" data-wishid="" data-placement="top" title="Add to wishlist"><i class="icon-heart"></i>
                                </a>
                                
                            </li>

                            <li>
                                <a href="{{route('add-to-compare',['id' => $value->id])}}" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="ps-product__container"><a class="ps-product__vendor" href="{{ route('product-detail',$value->slug) }}">{{ $value->product_title }}</a>
                        <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product-detail',$value->slug) }}">{{ $value->product_sku }}</a>
                            <div class="ps-product__rating">
                                <div class="br-wrapper br-theme-fontawesome-stars">
                                    <select class="ps-rating" data-read-only="true" style="display: none;">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <div class="br-widget br-readonly">
                                        @if(isset($value->review_rate))
                                            @for ($i = 0; $i < $value->review_rate; $i++)
                                                <a href="#" data-rating-value="1" data-rating-text="1" class="br-selected br-current"></a>
                                            @endfor
                                        @else
                                            @for ($i = 0; $i < 5; $i++)
                                            <a href="#" data-rating-value="1" data-rating-text="1"></a>
                                            @endfor
                                        @endif
                                    </div>
                                </div>
                            </div>
                             <p class="ps-product__price sale">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->discounted_price }}<del> {{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->actual_price }}</del></p>
                        </div>
                        <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('product-detail',$value->slug) }}">
                            {!! strip_tags(Str::words($value->description, 8,'....'))  !!}
                        </a>
                            <p class="ps-product__price sale">{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->discounted_price }}<del>{{env('PRICE_SYMBOL', 'Rs ')}}{{ $value->actual_price }}</del></p>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        
    </div>
</div>
<script type="text/javascript">
    //$(document).ready(function(){
        //$(".owl-slider").data('owlCarousel').destroy();

        $('.ps-tab-list  li > a ').on('click', function(e) {
            e.preventDefault();
            var target = $(this).attr('href');
            $(this).closest('li').siblings('li').removeClass('active');
            $(this).closest('li').addClass('active');
            $(target).addClass('active');
            $(target).siblings('.ps-tab').removeClass('active');
        });
        $('.ps-tab-list.owl-slider .owl-item a').on('click', function(e) {
            e.preventDefault();
            var target = $(this).attr('href');
            $(this).closest('.owl-item').siblings('.owl-item').removeClass('active');
            $(this).closest('.owl-item').addClass('active');
            $(target).addClass('active');
            $(target).siblings('.ps-tab').removeClass('active');
        });

        var target = $('.all-product');
        if (target.length > 0) {
            target.each(function() {
                var el = $(this),
                    dataAuto = el.data('owl-auto'),
                    dataLoop = el.data('owl-loop'),
                    dataSpeed = el.data('owl-speed'),
                    dataGap = el.data('owl-gap'),
                    dataNav = el.data('owl-nav'),
                    dataDots = el.data('owl-dots'),
                    dataAnimateIn = (el.data('owl-animate-in')) ? el.data('owl-animate-in') : '',
                    dataAnimateOut = (el.data('owl-animate-out')) ? el.data('owl-animate-out') : '',
                    dataDefaultItem = el.data('owl-item'),
                    dataItemXS = el.data('owl-item-xs'),
                    dataItemSM = el.data('owl-item-sm'),
                    dataItemMD = el.data('owl-item-md'),
                    dataItemLG = el.data('owl-item-lg'),
                    dataItemXL = el.data('owl-item-xl'),
                    dataNavLeft = (el.data('owl-nav-left')) ? el.data('owl-nav-left') : "<i class='icon-chevron-left'></i>",
                    dataNavRight = (el.data('owl-nav-right')) ? el.data('owl-nav-right') : "<i class='icon-chevron-right'></i>",
                    duration = el.data('owl-duration'),
                    datamouseDrag = (el.data('owl-mousedrag') == 'on') ? true : false;
                if (target.children('div, span, a, img, h1, h2, h3, h4, h5, h5').length >= 2) {
                    el.owlCarousel({
                        animateIn: dataAnimateIn,
                        animateOut: dataAnimateOut,
                        margin: dataGap,
                        autoplay: dataAuto,
                        autoplayTimeout: dataSpeed,
                        autoplayHoverPause: true,
                        loop: dataLoop,
                        nav: dataNav,
                        mouseDrag: datamouseDrag,
                        touchDrag: true,
                        autoplaySpeed: duration,
                        navSpeed: duration,
                        dotsSpeed: duration,
                        dragEndSpeed: duration,
                        navText: [dataNavLeft, dataNavRight],
                        dots: dataDots,
                        items: dataDefaultItem,
                        responsive: {
                            0: {
                                items: dataItemXS
                            },
                            480: {
                                items: dataItemSM
                            },
                            768: {
                                items: dataItemMD
                            },
                            992: {
                                items: dataItemLG
                            },
                            1200: {
                                items: dataItemXL
                            },
                            1680: {
                                items: dataDefaultItem
                            }
                        }
                    });
                }

            });
        }

        
    //})
</script>