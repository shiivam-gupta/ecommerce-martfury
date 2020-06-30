<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}" id="csrfToken">
    <meta name="msapplication-TileColor" content="#ff685c">
    <meta name="theme-color" content="#32cafe">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="{{ asset('frontend/img/aboutus/'. $appsetting->app_favicon) }}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/aboutus/'. $appsetting->app_favicon) }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700" rel="stylesheet">
    {!! Html::style('assets/fonts/fonts/font-awesome.min.css') !!}
    {!! Html::style('assets/css/dashboard.css') !!}
    <!-- Date Picker Plugin -->
    {!! Html::style('assets/plugins/date-picker/spectrum.css') !!}
    {!! Html::style('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css') !!}
    {!! Html::style('assets/plugins/toggle-sidebar/sidemenu.css') !!}
    {!! Html::style('assets/plugins/iconfonts/plugin.css') !!}
    {!! Html::style('assets/plugins/iconfonts/icons.css') !!}
    {!! Html::style('assets/plugins/datatable/dataTables.bootstrap4.min.css') !!}
    @yield('extra-css')
    {!! Html::style('assets/css/custom.css') !!}

    <script type="text/javascript">
       var appurl = '{{url("/")}}/';

   </script>
</head>

@if(!@auth()->user())
    <body class="login-img">
@else
    <body class="app sidebar-mini rtl">
@endif
    
    @if(@auth()->user())
        <div id="global-loader" ></div>
        <div class="page">
            <div class="page-main">
                @include('backend.includes.header')
                <!-- Sidebar menu-->
                <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
                @include('backend.includes.sidebar')
                <div class="app-content  my-3 my-md-5">
                    <div class="side-app">
                        @include('backend.includes.message')
                        @yield('content')
                    </div>
                </div>
                @include('backend.includes.footer')
            </div>
        </div>
    @else
        @yield('content')
    @endif

        <!-- JavaScripts -->
        @yield('before-scripts')
        {!! Html::script('assets/js/vendors/jquery-3.2.1.min.js') !!}
        {!! Html::script('assets/js/vendors/bootstrap.bundle.min.js') !!}
        {!! Html::script('assets/js/vendors/jquery.tablesorter.min.js') !!}
        {{-- {!! Html::script('assets/js/vendors/jquery-sortable-min.js') !!} --}}
        {!! Html::script('assets/plugins/rating/jquery.rating-stars.js') !!}
        {!! Html::script('assets/plugins/toggle-sidebar/sidemenu.js') !!}

        <!--Select2 js -->
       {!! Html::script('assets/plugins/select2/select2.full.min.js') !!}

       <!-- Timepicker js -->
        {!! Html::script('assets/plugins/time-picker/jquery.timepicker.js') !!}
        {!! Html::script('assets/plugins/time-picker/toggles.min.js') !!}

        <!-- Datepicker js -->
        {!! Html::script('assets/plugins/date-picker/spectrum.js') !!}
        {!! Html::script('assets/plugins/date-picker/jquery-ui.js') !!}
        {!! Html::script('assets/plugins/input-mask/jquery.maskedinput.js') !!}
        <!-- Inline js -->
        {!! Html::script('assets/js/select2.js') !!}
        
        {!! Html::script('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') !!}
        {!! Html::script('assets/plugins/datatable/jquery.dataTables.min.js') !!}
        {!! Html::script('assets/plugins/datatable/dataTables.bootstrap4.min.js') !!}
        {!! Html::script('assets/plugins/datatable/datatable.js') !!}
        {!! Html::script('assets/plugins/ckeditor/ckeditor.js') !!}
        {!! Html::script('assets/js/custom.js') !!}
        {!! Html::script('assets/js/main.js') !!}
        {!! Html::script('assets/js/admin.js') !!}
        <!-- Swal  CDN JS -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @yield('after-scripts')
    </body>
</html>