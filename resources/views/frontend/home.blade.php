@extends('frontend.layouts.frontend')
@section('content')
<div id="homepage-1">
    <div class="ps-home-banner ps-home-banner--1">
        <div class="ps-container">
            <div class="ps-section__left">
                <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
                    @if($banner)
                        @foreach($banner as $key => $value)
                            @if($value->pages == 'home')
                                <div class="ps-banner"><a href="#"><img src="{{ asset($value->banner_image) }}" alt="" height="425px" width="1230px"></a></div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="ps-section__right">
                @if($firstRightImage)
                    <a class="ps-collection" href="#"><img src="{{ asset($firstRightImage->banner_image) }}" alt="" height="200px" width="390px">
                    </a>
                @endif
                @if($secondRightImage)
                    <a class="ps-collection" href="#"><img src="{{ asset($secondRightImage->banner_image) }}" alt="" height="200px" width="390px">
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="ps-site-features">
        <div class="ps-container">
            <div class="ps-block--site-features ps-block--site-features-2">
                @if($belowBanner)
                    @foreach($belowBanner as $keyitem => $itemvalue)
                        <div class="ps-block__item">
                            <div class="ps-block__left"><i class="icon-rocket"></i></div>
                            <div class="ps-block__right">
                                <h4>{{ $itemvalue->title }}</h4>
                                <p>{{ $itemvalue->content }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
                {{-- <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-sync"></i></div>
                    <div class="ps-block__right">
                        <h4>90 Days Return</h4>
                        <p>If goods have problems</p>
                    </div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-credit-card"></i></div>
                    <div class="ps-block__right">
                        <h4>Secure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-bubbles"></i></div>
                    <div class="ps-block__right">
                        <h4>24/7 Support</h4>
                        <p>Dedicated support</p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="ps-home-ads">
        <div class="ps-container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img src="{{ asset('frontend/img/ads/1.jpg') }}" alt=""></a>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img src="{{ asset('frontend/img/ads/2.jpg') }}" alt=""></a>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img src="{{ asset('frontend/img/ads/3.jpg') }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-top-categories">
        <div class="ps-container">
            <h3>Top categories of the month</h3>
            <div class="row">
                @if($topCategory)
                    @foreach($topCategory as $key => $value)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 ">
                            <div class="ps-block--category"><a class="ps-block__overlay" href="{{ asset('search-product?searchCategory='.$value->slug) }}"></a><img src="{{ asset($value->category_image) }}" alt="" height="100px" width="100px">
                                <p>{{ $value->name }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="ps-product-list ps-clothings">
        <div class="ps-container">
            <div class="ps-section__header">
                <h3>Products</h3>
                <ul class="ps-section__links">
                </ul>
            </div>
            <br>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong></strong> {{ $message }}
                </div>
            @endif
            <div class="all-event"></div>
        </div>
    </div>
    @include('frontend/includes/news-letter')
</div>
@endsection
@section('extra-js')
<script type="text/javascript">
    $(document).ready(function(){
        //var type = 
        getProducts('');
    });

    $(document).on('click','.productType',function(){
        var type = $(this).attr('data-type');
        getProducts(type);
    })

    function getProducts(type){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrfToken').attr('content')
            }
        });
        $.ajax({
            url:"{{ route('get-products') }}",
            method:'POST',
            data:{
                type:type
            },
            success: function(data){
                //console.log(data.html)
                $('.all-event').html(data);
                // setTimeout(function(){
                //     tabs();
                //     owlCarouselConfig();
                // }, 5000);
                
            }
        });
    }

    function tabs() {
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
    }

    function owlCarouselConfig() {
        var target = $('.owl-slider');
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
    }
</script>
@endsection
