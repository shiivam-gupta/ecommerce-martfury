<header class="header header--1" data-sticky="true">
    <div class="header__top">
        <div class="ps-container">
            <div class="header__left">
                <div class="menu--product-categories">
                    <div class="menu__toggle"><i class="icon-menu"></i><span> Shop by Categories</span></div>
                    <div class="menu__content">
                        <ul class="menu--dropdown">
                            @if($getAllCat)
                                @foreach($getAllCat as $key => $value)
                                    <li class="current-menu-item @if($value->getActiveSubcategory) menu-item-has-children has-mega-menu @endif"><a href="{{ asset('search-product?searchCategory='.$value->slug) }}"><i class="icon-laundry"></i> {{ $value->name }}</a>
                                        @if($value->getActiveSubcategory)
                                            <div class="mega-menu">
                                                @foreach($value->getActiveSubcategory as $keySub => $valueSub)
                                                    <div class="mega-menu__column">
                                                        <a href="{{ asset('search-product?searchCategory='.$value->slug.'_'.$valueSub->slug) }}"><h4>{{ $valueSub->name }}<span class="sub-toggle"></span></h4></a>

                                                        @if($valueSub->getActiveChildCategory)
                                                            <ul class="mega-menu__list">
                                                                @foreach($valueSub->getActiveChildCategory as $keyChild => $valueChild)
                                                                    <li class="current-menu-item "><a href="{{ asset('search-product?searchCategory='.$value->slug.'_'.$valueSub->slug.'_'.$valueChild->slug) }}">{{ $valueChild->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div><a class="ps-logo" href="{{ route('index') }}"><img src="{{ asset('frontend/img/aboutus/'. $appsetting->app_logo) }}" alt="{{$appsetting->app_name}}" style="height: 41px;"></a>
            </div>
            <div class="header__center">
                
                <form class="ps-form--quick-search" action="{{ route('search-product') }}" method="get">
                    <div class="form-group--icon"><i class="icon-chevron-down"></i>
                        <select class="form-control catclass" name="searchCategory">
                            <option value="" selected="selected">All</option>
                            @if($getAllCat)
                                @foreach($getAllCat as $key => $value)
                                    <option class="level-0" value="{{ $value->slug }}">{{ $value->name }}</option>
                                    @if($value->getActiveSubcategory)
                                        @foreach($value->getActiveSubcategory as $keySub => $valueSub)
                                            <option class="level-1" value="{{ $value->slug }}_{{ $valueSub->slug }}">   {{ $valueSub->name }}</option>
                                            @if($valueSub->getActiveChildCategory)
                                                @foreach($valueSub->getActiveChildCategory as $keyChild => $valueChild)
                                                    <option class="level-2" value="{{ $value->slug }}_{{ $valueSub->slug }}_{{ $valueChild->slug }}">      {{ $valueChild->name }}</option>
                                                    
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <input class="form-control" name="searchtext" type="text" placeholder="I'm shopping for...">
                    <button type="submit">Search</button>
                </form>
                <span class="errorMessgae"></span>
            </div>
            <div class="header__right">
                <div class="header__actions">
                    <a class="header__extra" href="{{route('compare-item')}}"><i class="icon-chart-bars"></i><span><i>{{ session('compare') ? count(session('compare')) : '0'}}</i></span></a>
                    <a class="header__extra" href="{{route('my-wishlist-product')}}"><i class="icon-heart"></i><span><i>{{$wishCount}}</i></span></a>
                    <!-- Cart start -->
                    <div class="ps-cart--mini">
                        <a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>{{ session('cart') ? count(session('cart')) : '0'}}</i></span></a>
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
                            </div>
                            <?php $total = 0 ?>
                            @foreach((array) session('cart') as $key => $value)
                                <?php $total += $value['productprice'] * $value['quantity'] ?>
                            @endforeach
                            <div class="ps-cart__footer">
                                <h3>Sub Total:<strong>{{env('PRICE_SYMBOL', 'Rs ')}}{{$total}}</strong></h3>
                                <figure>
                                    <a class="ps-btn" href="{{route('shopping-cart')}}">View Cart</a>
                                    @if($total>0)<a class="ps-btn" href="{{route('checkout')}}">Checkout</a>@endif
                                </figure>
                            </div>
                        </div>
                    </div>
                    <!-- Cart end -->
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
        </div>
    </div>
    <nav class="navigation">
        <div class="ps-container">
            <div class="navigation__left">
                <div class="menu--product-categories">
                    <div class="menu__toggle"><i class="icon-menu"></i><span> Shop by Categories</span></div>
                    <div class="menu__content">
                        <ul class="menu--dropdown">
                            @if($getAllCat)
                                @foreach($getAllCat as $key => $value)
                                    <li class="current-menu-item @if($value->getActiveSubcategory) menu-item-has-children has-mega-menu @endif"><a href="{{ asset('search-product?searchCategory='.$value->slug) }}"><i class="icon-laundry"></i> {{ $value->name }}</a>
                                        @if($value->getActiveSubcategory)
                                        @if($value->getActiveSubcategory->count()>0)
                                            <div class="mega-menu">
                                                @foreach($value->getActiveSubcategory as $keySub => $valueSub)
                                                    <div class="mega-menu__column">
                                                        <a href="{{ asset('search-product?searchCategory='.$value->slug.'_'.$valueSub->slug) }}"><h4>{{ $valueSub->name }}<span class="sub-toggle"></span></h4></a>

                                                        @if($valueSub->getActiveChildCategory)
                                                            <ul class="mega-menu__list">
                                                                @foreach($valueSub->getActiveChildCategory as $keyChild => $valueChild)
                                                                    <li class="current-menu-item "><a href="{{ asset('search-product?searchCategory='.$value->slug.'_'.$valueSub->slug.'_'.$valueChild->slug) }}">{{ $valueChild->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navigation__right">
                <ul class="menu">
                    <li class=""><a href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="current-menu-item menu-item-has-children"><a href="javascript:;">Brands</a><span class="sub-toggle"></span>
                            <ul class="sub-menu">
                                @foreach($brandlists as $allbrandName)
                                <li><a href="{{ asset('search-product?serchbrand='.$allbrandName->name) }}">{{ $allbrandName->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    <li class=""><a href="{{ route('about-us') }}">About Us</a>
                    </li>
                    <li class=""><a href="{{route('contact-us')}}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<header class="header header--mobile" data-sticky="true">
    <div class="header__top">
        <div class="header__left">
            <p>Welcome to {{$appsetting->app_name}} Online Shopping Store !</p>
        </div>
    </div>
    <div class="navigation--mobile">
        <div class="navigation__left"><a class="ps-logo" href="{{ route('index') }}"><img src="{{ asset('frontend/img/aboutus/'. $appsetting->app_logo) }}" alt="{{$appsetting->app_name}}"></a></div>
    </div>
    <div class="ps-search--mobile">
        <form class="ps-form--search-mobile" action="http://nouthemes.net/html/martfury/index.html" method="get">
            <div class="form-group--nest">
                <input class="form-control" type="text" placeholder="Search something...">
                <button><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
</header>


<div class="ps-panel--sidebar" id="cart-mobile">
    <div class="ps-panel__header">
        <h3>Shopping Cart</h3>
    </div>
    <div class="navigation__content">
        <div class="ps-cart--mobile">
            <div class="ps-cart__content">
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
            </div>
            <div class="ps-cart__footer">
                <h3>Sub Total:<strong>{{env('PRICE_SYMBOL', 'Rs ')}}{{$total}}</strong></h3>
                <figure>
                    <a class="ps-btn" href="{{route('shopping-cart')}}">View Cart</a>
                    @if($total>0)<a class="ps-btn" href="javascript:void(0);">Checkout</a>@endif
                </figure>
            </div>
        </div>
    </div>
</div>

<div class="ps-panel--sidebar" id="navigation-mobile">
    <div class="ps-panel__header">
        <h3>Categories</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--mobile">
            @foreach($getAllCat as $key => $value)
            <li class="current-menu-item @if($value->getActiveSubcategory) menu-item-has-children has-mega-menu @endif">
                <a href="{{ asset('search-product?searchCategory='.$value->slug) }}">Consumer {{ $value->name }}</a><span class="sub-toggle"></span>

                @if($value->getActiveSubcategory)
                    @if($value->getActiveSubcategory->count()>0)
                    <div class="mega-menu">
                        @foreach($value->getActiveSubcategory as $keySub => $valueSub)
                        <div class="mega-menu__column">
                            <h4>
                                <a href="{{ asset('search-product?searchCategory='.$value->slug.'_'.$valueSub->slug) }}">{{ $valueSub->name }}
                                </a>
                                <span class="sub-toggle"></span></h4>
                            @if($valueSub->getActiveChildCategory)
                            <ul class="mega-menu__list">
                                @foreach($valueSub->getActiveChildCategory as $keyChild => $valueChild)
                                <li class="current-menu-item ">
                                    <a href="{{ asset('search-product?searchCategory='.$value->slug.'_'.$valueSub->slug.'_'.$valueChild->slug) }}">{{ $valueChild->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="navigation--list">
    <div class="navigation__content">
        <a class="navigation__item ps-toggle--sidebar" href="#menu-mobile"><i class="icon-menu"></i><span> Menu</span></a>
        <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile"><i class="icon-list4"></i><span> Categories</span></a>
        <a class="navigation__item ps-toggle--sidebar" href="#search-sidebar"><i class="icon-magnifier"></i><span> Search</span></a>
        <a class="navigation__item ps-toggle--sidebar" href="#cart-mobile"><i class="icon-bag2"></i><span> Cart</span></a>

        @if(auth()->user())
            <a class="navigation__item ps-toggle--sidebar" href="#user-info"><i class="icon-user"></i><span> Profile</span></a>
        @else
            <a class="navigation__item ps-toggle--sidebar" href="#user-info"><i class="icon-user"></i><span> Login</span></a>
        @endif

        
    </div>
</div>

<div class="ps-panel--sidebar" id="search-sidebar">
    <div class="ps-panel__header">
        <form class="ps-form--search-mobile" action="{{ route('search-product') }}" method="get">
            <div class="form-group--nest">
                <input class="form-control" name="searchtext" type="text" placeholder="Search something...">
                <button><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
    <div class="navigation__content"></div>
</div>

<div class="ps-panel--sidebar" id="menu-mobile">
    <div class="ps-panel__header">
        <h3>Menu</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--mobile">
            <li class="current-menu-item"><a href="{{ route('index') }}">Home</a>
            </li>
            <li class="current-menu-item menu-item-has-children"><a href="javascript:;">Brands</a><span class="sub-toggle"></span>
                    <ul class="sub-menu">
                        @foreach($brandlists as $allbrandName)
                        <li><a href="{{ asset('search-product?serchbrand='.$allbrandName->name) }}">{{ $allbrandName->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
            <li class="current-menu-item"><a href="{{ route('about-us') }}">About Us</a>
            </li>
            <li class="current-menu-item"><a href="{{route('contact-us')}}">Contact</a>
            </li>
            @if(auth()->user())
                <li class="current-menu-item "><a href="{{ route('my-profile') }}">My Profile</a></li>
            @else
                <li class="current-menu-item "><a href="{{ route('account.login') }}">Login</a></li>
                <li class="current-menu-item "><a href="{{ route('account.register') }}">Register</a></li>
            @endif
        </ul>
    </div>
</div>

<div class="ps-panel--sidebar" id="user-info">
    <div class="ps-panel__header">
        <h3>Account</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--mobile">
            @if(auth()->user())
                <li class="current-menu-item menu-item-has-children"><a href="{{route('my-profile')}}">Profile</a>
                </li>
                <li class="current-menu-item menu-item-has-children"><a href="{{route('my-orders')}}">Your Orders</a>
                </li>
                <li class="current-menu-item menu-item-has-children"><a href="{{route('my-reviews')}}">Reviews</a>
                </li>
                <li class="current-menu-item menu-item-has-children"><a href="{{route('my-resetpass')}}">Reset Password</a>
                </li>
                <li class="current-menu-item "><a href="{{ URL::to('logout') }}">Logout</a></li>
            @else
                <li class="current-menu-item "><a href="{{ route('account.login') }}">Login</a></li>
                <li class="current-menu-item "><a href="{{ route('account.register') }}">Register</a></li>
            @endif
        </ul>
    </div>
</div>