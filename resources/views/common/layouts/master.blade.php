<!doctype html>
<html lang="en" dir="ltr">

<!-- NRTindex.html by NRT, Mon, 31 Dec 2018 06:25:12 GMT -->

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" id="csrfToken">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="msapplication-TileColor" content="#ff685c">
	<meta name="theme-color" content="#32cafe">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

	<!-- Title -->
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="{{asset('assets/fonts/fonts/font-awesome.min.css')}}">
	<!-- WYSIWYG Editor css -->
	<link href="{{asset('assets/plugins/wysiwyag/richtext.css')}}" rel="stylesheet" />
	<!-- Font Family-->
	<link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700" rel="stylesheet">

	<!-- Dashboard Css -->
	<link href="{{asset('assets/css/dashboard.css')}}" rel="stylesheet" />

	<!-- c3.js Charts Plugin -->
	<link href="{{asset('assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet" />

	<!-- Morris.js Charts Plugin -->
	<link href="{{asset('assets/plugins/morris/morris.css')}}" rel="stylesheet" />

	<!-- Custom scroll bar css-->
	<link href="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

	<!-- Sidemenu Css -->
	<link href="{{asset('assets/plugins/toggle-sidebar/sidemenu.css')}}" rel="stylesheet" />

	<link href="{{asset('assets/plugins/wysiwyag/richtext.css')}}" rel="stylesheet" />
	<!---Font icons-->
	<link href="{{asset('assets/plugins/iconfonts/plugin.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
	<script src="{{asset('assets/js/vendors/jquery-3.2.1.min.js')}}"></script>

	<script src="{{asset('assets/sweetalert.min.js')}}"></script>
	{{-- Add font Awesome --}}
	<link rel="stylesheet" href="{{asset('assets/fontAwesome/css/fontawesome.min.css')}}" />
	<link
		href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css"
		rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
	</script>
	<script src="{{asset('/js/formValidation.js')}}"></script>

	{{-- Pusher Script link --}}
	<script src="https://js.pusher.com/6.0/pusher.min.js"></script>

	<style>
		.team {
			margin-left: 0px;
		}
	</style>
	<script>
		var token = $("meta[name='csrf-token']").attr("content");
	</script>
</head>

<body class="app sidebar-mini rtl">
	<div id="app">
		<!-- <div id="global-loader" ></div> -->
		<div class="page">

			<!-- header menu -->
			<div class="page-main">
				<!-- header menu-->
				@include('common.includes.header')
				@include('common.includes.sidebar')
			</div>
			<!-- Sidebar menu-->
			<div class="app-content  my-3 my-md-5">
				@yield('content')
				<input type="hidden" value="{{Auth::user()->userType}}" id="currentUserType" />
				{{-- <input type="hidden" value="{{Auth::user()->userType}}" id="currentUserType" /> --}}
				<div class="showNotification"></div>
				<!--footer-->
				@include('common.includes.footer')
				<!-- End Footer-->
			</div>

		</div>
	</div>
	<!-- Back to top -->
	<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

	{{-- Add Font Awesome Js --}}
	<script src="{{asset('assets/fontAwesome/js/fontawesome.min.js')}}"></script>
	<script src="{{asset('js/app.js')}}"></script>

	<!-- Dashboard Core -->
	{{-- <script src="{{asset('assets/js/vendors/jquery-3.2.1.min.js')}}"></script> --}}
	<script src="{{asset('assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('assets/js/vendors/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('assets/js/vendors/selectize.min.js')}}"></script>
	<script src="{{asset('assets/js/vendors/jquery.tablesorter.min.js')}}"></script>
	<script src="{{asset('assets/js/vendors/circle-progress.min.js')}}"></script>
	<script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
	<script src="{{asset('assets/plugins/flot/jquery.flot.js')}}"></script>
	<script src="{{asset('assets/plugins/flot/jquery.flot.fillbetween.js')}}"></script>
	<script src="{{asset('assets/plugins/flot/jquery.flot.pie.js')}}"></script>


	<!-- Echarts Js-->
	{{-- <script src="{{asset('assets/plugins/echarts/echarts.js')}}"></script>
	<script src="{{asset('assets/js/index1.js')}}"></script> --}}

	<!--othercharts js-->
	<script src="{{asset('assets/js/othercharts.js')}}"></script>

	<!-- Charts Plugin -->
	<script src="{{asset('assets/plugins/chart/Chart.bundle.js')}}"></script>
	<script src="{{asset('assets/plugins/chart/utils.js')}}"></script>

	<!--Jquery.knob js-->
	<script src="{{asset('assets/plugins/othercharts/jquery.knob.js')}}"></script>

	<!--Amcharts Charts Plugin -->
	<script src="{{asset('assets/plugins/am-chart/amcharts.js')}}"></script>
	<script src="{{asset('assets/plugins/am-chart/serial.js')}}"></script>

	<!-- peitychart -->
	<script src="{{asset('assets/plugins/peitychart/jquery.peity.min.js')}}"></script>
	<script src="{{asset('assets/plugins/peitychart/peitychart.init.js')}}"></script>

	<!-- Fullside-menu Js-->
	<script src="{{asset('assets/plugins/toggle-sidebar/sidemenu.js')}}"></script>

	<!-- Custom scroll bar Js-->
	<script src="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
	@if(isset(auth()->user))
	<!-- Custom Js-->
	<script src="{{asset('assets/js/custom.js')}}"></script>
	@endif
	<!-- Data tables -->
	<script src="{{asset('assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatable/datatable.js')}}"></script>
	<!-- Swal  CDN JS -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- Swal  CDN JS -->

	<!-- WYSIWYG Editor js -->
	<script src="{{asset('assets/plugins/wysiwyag/jquery.richtext.js')}}"></script>
	<script src="{{asset('assets/plugins/wysiwyag/richText1.js')}}"></script>

	<!-- Date Time Picker  JS -->
	@section('extrajs')

	{{-- For Pusher Events --}}
	{{-- <script>
		var html = `
				<div class="modal fade show" id="notificationModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
					aria-hidden="true" style="display:block">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header bg-primary text-white">
								<h5 class="modal-title" id="exampleModalLabel">Notification</h5>
							
							</div>
							<div class="modal-body">
								<h1>${message}</h1>
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary closeModel" ${onclick="closeModal()"}  >Reject</button>
								<button type="button" class="btn btn-primary acceptPatient">Accept</button>
							</div>
						</div>
					</div>
				</div>
				`
				$('.showNotification').html(html)
	
				$(document).on('click', '.closeModel' ,function(){
					$('#notificationModel').css("display" ,"none")
				});
				
				// $(document).on('click' , '.acceptPatient' , function(){
				// 	alert('check')
				// var accept = channel.trigger('Accepted', { title: 'You Selected the Patient' });
				// 	if(accept){
				// 		alert('send')
				// 	}
				// })
			
		
		
		});
		
		
	</script> --}}
	@show


</body>

<!-- NRTindex.html by NRT, Mon, 31 Dec 2018 06:26:03 GMT -->

</html>