<footer class="ps-footer">
    <div class="ps-container">
        <div class="ps-footer__widgets">
            <aside class="widget widget_footer widget_contact-us">
                <h4 class="widget-title">{{$appsetting->contact_title}}</h4>
                <div class="widget_content">
                    <h3>{{$appsetting->contact_phone}}</h3>
                    <p>{!!$appsetting->contact_address!!}
                        <a href="mailto:{!!$appsetting->email!!}"><span class="__cf_email__" data-cfemail="{!!$appsetting->email!!}"></span></a></p>
                    <ul class="ps-list--social">
                        @include('frontend.includes.social')
                    </ul>
                </div>
            </aside>
            <aside class="widget widget_footer">
                <h4 class="widget-title">Quick links</h4>
                <ul class="ps-list--link">
                    <li><a href="{{route('policy')}}">Policy</a></li>
                    <li><a href="{{route('term-ondition')}}">Term & Condition</a></li>
                    <li><a href="{{route('shipping')}}">Shipping</a></li>
                    <li><a href="{{route('return')}}">Return</a></li>
                    <li><a href="{{route('faqs')}}">FAQs</a></li>
                </ul>
            </aside>
            <aside class="widget widget_footer">
                <h4 class="widget-title">Company</h4>
                <ul class="ps-list--link">
                    <li><a href="{{route('about-us')}}">About Us</a></li>
                    <li><a href="#">Affilate</a></li>
                    <li><a href="#">Career</a></li>
                    <li><a href="{{route('contact-us')}}">Contact</a></li>
                </ul>
            </aside>
            <aside class="widget widget_footer">
                <h4 class="widget-title">Bussiness</h4>
                <ul class="ps-list--link">
                    <li><a href="#">Our Press</a></li>
                    <li><a href="#">Checkout</a></li>
                    <li><a href="#">My account</a></li>
                    <li><a href="#">Shop</a></li>
                </ul>
            </aside>
        </div>
        <div class="ps-footer__copyright">
            <p>{{$appsetting->copyright}}</p>
            <p><span>{{$appsetting->safe_payment}}:</span>
                <a href="javascript:;"><img src="{{ asset('frontend/img/payment-method/1.jpg') }}" alt=""></a>
                <a href="javascript:;"><img src="{{ asset('frontend/img/payment-method/2.jpg') }}" alt=""></a>
                <a href="javascript:;"><img src="{{ asset('frontend/img/payment-method/3.jpg') }}" alt=""></a>
                <a href="javascript:;"><img src="{{ asset('frontend/img/payment-method/4.jpg') }}" alt=""></a>
                <a href="javascript:;"><img src="{{ asset('frontend/img/payment-method/5.jpg') }}" alt=""></a>
            </p>
        </div>
    </div>
</footer>
{{-- <div class="ps-popup" id="subscribe" data-time="500">
    <div class="ps-popup__content bg--cover" data-background="{{ asset('frontend/frontend/img/bg/subscribe.jpg') }}"><a class="ps-popup__close" href="#"><i class="icon-cross"></i></a>
        <form class="ps-form--subscribe-popup" action="#" method="get">
            <div class="ps-form__content">
                <h4>Get <strong>25%</strong> Discount</h4>
                <p>Subscribe to the Martfury mailing list <br /> to receive updates on new arrivals, special offers <br /> and our promotions.</p>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Email Address" required>
                        <button class="ps-btn">Subscribe</button>
                    </div>
                    <div class="ps-checkbox">
                        <input class="form-control" type="checkbox" id="not-show" name="not-show">
                        <label for="not-show">Don't show this popup again</label>
                    </div>
            </div>
        </form>
    </div>
</div> --}}
<div id="back2top"><i class="pe-7s-angle-up"></i></div>
<div class="ps-site-overlay"></div>
<div id="loader-wrapper">
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
    <div class="ps-search__content">
        <form class="ps-form--primary-search" action="#" method="post">
            <input class="form-control" type="text" placeholder="Search for...">
            <button><i class="aroma-magnifying-glass"></i></button>
        </form>
    </div>
</div>
<div class="modal fade" id="product-quickview" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2 closeView"></i></span>
            <div id="quick-view-information"></div>
        </div>
    </div>
</div>

