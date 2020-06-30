<div class="app-header header py-1 d-flex">
	<div class="container-fluid">
		<div class="d-flex">
			<a class="header-brand" href="{{url('/admin/dashboard')}}">
			<img src="{{ asset('frontend/img/aboutus/'. $appsetting->app_logo) }}" class="" alt="{{$appsetting->app_name}}" style="height: 50px;">
			</a>
			<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
			<div class="d-flex order-lg-2 ml-auto">
				<div class="dropdown d-none d-md-flex " >
					<a  class="nav-link icon full-screen-link">
					<i class="mdi mdi-arrow-expand-all"  id="fullscreen-button"></i>
					</a>
				</div>
				<div class="dropdown">
					<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
					<span class="avatar avatar-md brround"><img src="{{ asset('frontend/img/aboutus/'. $appsetting->app_logo) }}" alt="{{Auth::user()->fullname}}" class="avatar avatar-md brround"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
						<div class="text-center">
							<a href="#" class="dropdown-item text-center font-weight-sembold user">{{Auth::user()->fullname}}</a>
							<div class="dropdown-divider"></div>
						</div>
						<a class="dropdown-item @if(Request::segment(2)==='app-setting') active @endif" href="{{ route('app-setting') }}">
						<i class="dropdown-icon mdi mdi-settings"></i> 
						App Setting
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{route('admin.logout')}}" >
						<i class="dropdown-icon mdi  mdi-logout-variant"></i>
						{{ __('Sign out') }}
						</a>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>