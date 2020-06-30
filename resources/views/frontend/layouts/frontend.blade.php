<!DOCTYPE html>
<html lang="en">
    <head>
        @include('frontend.includes.head')
        @yield('extra-css')
        <script type="text/javascript">
            var appurl = '{{url("/")}}/';
        </script>
    </head>
    <body>
        @include('frontend.includes.header')
        @yield('content')
        @include('frontend.includes.footer')
        @include('frontend.includes.footer-script')
        @yield('extra-js')
        <script type="text/javascript">

            $(document).ready(function(){
                $('.submitNews').click(function(e){
                    e.preventDefault();
                    $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                      }
                    });
                    $.ajax({
                      url: "{{ route('newsLetter') }}",
                      method: 'post',
                      data: {
                         news_email: $('.news_email').val(),
                      },
                        success: function(res){
                            if(res.status == 200){
                                $('.showMessage').html('We have receveied your email.');
                            }else{
                                $.each(res.errors, function(key, value){
                                    $('.showMessage').html(value);
                                });
                            }
                        }
                    });
                });
            });

            $(document).on('click','.wishList',function(){
                var id = $(this).attr('data-wishid');
                $.ajax({
                    url:"{{url('/my-wishlist/')}}" +"/"+id,
                    method:'get',
                    success: function(res){
                        if(res.status == 200){
                            $('.likeStatus').html('Your Like status has changed.');
                        }else{
                            $('.likeStatus').html('Your Like status has changed.');
                        }
                    }
                });
            })

        $(document).on('click','.closeView',function(){
            $('.modalTitleClass').text('');
            $(".imageClass").html('');
        });

        $(document).on('click','.viewProduct',function(){
            var id = $(this).attr('data-viewProduct');
            $("#quick-view-information").html('');
            $("#product-quickview").hide();
            $.ajax({
                url:"{{url('/my-product-view')}}" +"/"+id,
                method:'get',
                success: function(data){
                    $("#quick-view-information").html(data);
                    $("#product-quickview").show();
                }
            });
        })

        $(document).on('click','.removeCart',function(){
            var id = $(this).attr('data-cart');
            if(confirm("Do you want to remove this item from cart ?")) {
                $.ajax({
                    url:"{{url('/my-cart/')}}" +"/"+id,
                    method:'get',
                    success: function(res){
                        window.location.reload();
                    }
                });
            }
        });
        </script>
    </body>
</html>
