<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">

<!--seo-->
@if(@$pageinfo)
    <title>{{$pageinfo->product_title}}</title>
    <meta name="keywords" content="{{$pageinfo->product_title}}, {{$pageinfo->product_sku}}">
    <meta name="description" content="{!! \Illuminate\Support\Str::words(strip_tags($pageinfo->description), 300,'....') !!}">
    <meta name="robots" content="index,follow" />

    <meta property="og:title" content="{{$pageinfo->product_title}}" />
    <meta property="og:description" content="{!! \Illuminate\Support\Str::words(strip_tags($pageinfo->description), 35,'....') !!}" />
    <meta property="og:image" content="{{asset('products/'.@$pageinfo->getProductImages[0]->product_image)}}" />
@else
    <title>{{ $appsetting->app_name }}</title>
    <meta name="description" content="{!! \Illuminate\Support\Str::words(strip_tags($appsetting->seo_description), 300,'....') !!}">
    <meta name="robots" content="index,follow" />
    <meta property="og:title" content="{{$appsetting->seo_keyword}}" />
    <meta property="og:description" content="{!! \Illuminate\Support\Str::words(strip_tags($appsetting->seo_description), 35,'....') !!}" />
    <meta property="og:image" content="{{asset('frontend/img/aboutus/'.$appsetting->app_logo)}}" />
@endif
<meta property="og:site_name" content="{{ $appsetting->app_name }}" />
<meta property="og:type" content="Article" />

<!--seo-->

<meta name="_token" content="{{ csrf_token() }}" id="csrfToken">
<link rel="icon" href="{{ asset('frontend/img/aboutus/'. $appsetting->app_favicon) }}" type="image/x-icon"/>
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/aboutus/'. $appsetting->app_favicon) }}" />
<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
{!! Html::style('frontend/plugins/font-awesome/css/font-awesome.min.css') !!}
{!! Html::style('frontend/fonts/Linearicons/Linearicons/Font/demo-files/demo.css') !!}
{!! Html::style('frontend/plugins/bootstrap4/css/bootstrap.min.css') !!}
{!! Html::style('frontend/plugins/owl-carousel/assets/owl.carousel.css') !!}
{!! Html::style('frontend/plugins/slick/slick/slick.css') !!}
{!! Html::style('frontend/plugins/lightGallery-master/dist/css/lightgallery.min.css') !!}
{!! Html::style('frontend/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css') !!}
{!! Html::style('frontend/plugins/jquery-ui/jquery-ui.min.css') !!}
{!! Html::style('frontend/plugins/select2/dist/css/select2.min.css') !!}
{!! Html::style('frontend/css/style.css') !!}
{!! Html::style('frontend/css/market-place-1.css') !!}
{!! Html::style('frontend/css/custom.css') !!}

@if(!empty($appSetting->google_analytics))
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-158175943-1"></script>
<script type="text/javascript">
  {!! $appSetting->google_analytics !!}
</script>
@endif
<script type="text/javascript">
	var appurl = "{{url('/')}}";
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
</script>