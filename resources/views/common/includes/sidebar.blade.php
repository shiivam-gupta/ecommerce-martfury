<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
	<div class="app-sidebar__user">
		<div class="dropdown user-pro-body">
			<div>
				<img src="{{asset('Images/'.Auth::user()->profile_pic)}}" alt="user-img"
					class="avatar avatar-xl brround mCS_img_loaded">
				@if(Auth::user()->userType == 2 || Auth::user()->userType == 3 )
				<a href="{{url('/edit-profile')}}" class="profile-img">
					<span class="fa fa-pencil" aria-hidden="true"></span>
				</a>
				@endif
			</div>

			<div class="user-info mb-2">
				<h4 class="font-weight-semibold text-dark mb-1">{{Auth::user()->name}}</h4>
			</div>
			<a href="#" title="settings" class="user-button"><i class="fa fa-cog"></i></a>
			<a href="#" title="Comments" class="user-button"><i class="fa fa-comments"></i></a>
			<a href="#" title="logout" class="user-button"><i class="fa fa-power-off"></i></a>
		</div>
	</div>
	<ul class="side-menu">
		<li class="slide">
			<a class="side-menu__item" href="#"><i class="side-menu__icon fa fa-desktop"></i><span
					class="side-menu__label">Home</span></a>
		</li>
		@if(Auth::user()->userType == 3)
		<li class="slide">
			<a class="side-menu__item" href="{{route('patient.reports')}}"><i
					class="side-menu__icon fa fa-desktop"></i><span class="side-menu__label">Reports</span></a>
		</li>
		@endif
		@if(Auth::user()->userType == 2)
		<li class="slide">
			<a class="side-menu__item" href="{{route('doctor.reports')}}"><i
					class="side-menu__icon fa fa-desktop"></i><span class="side-menu__label">Reports</span></a>
		</li>
		@endif
		@if(Auth::user()->userType == 1)
		<li class="slide">
			<a class="side-menu__item" href="{{route('admin')}}"><i class="side-menu__icon fa fa-desktop"></i><span
					class="side-menu__label">Users Management</span></a>
		</li>
		<li class="slide">
			<a class="side-menu__item" href="{{route('reports')}}"><i class="side-menu__icon fa fa-desktop"></i><span
					class="side-menu__label">Reports</span></a>
		</li>
		<li class="slide">
			<a class="side-menu__item" href="{{route('sendNotification')}}"><i
					class="side-menu__icon fa fa-desktop"></i><span class="side-menu__label">Send
					Notification</span></a>
		</li>
		@endif
	</ul>
</aside>