<div class="app-header header py-1 d-flex">
	{{-- {{dd(Auth::user()->profile_pic)}} --}}
	<div class="container-fluid">
		<div class="d-flex">
			<a class="header-brand" href="index.html">
				<img src="{{asset('assets/images/brand/logo.png')}}" class="header-brand-img" alt="NRT logo">
			</a>
			<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
			<div class="d-none d-lg-block horizontal">
				<ul class="nav">
					{{-- <li class="">
						<div class="dropdown d-none d-md-flex">
							<a href="#" class="d-flex nav-link pr-0 mt-3 country-flag1" data-toggle="dropdown">
								<span><img src="{{asset('assets/images/us_flag.jpg')}}" alt="img"
					class="avatar country-Flag mr-2 align-self-center"></span>
					<div>
						<strong class="text-dark mr-3 mt-0">English</strong>
					</div>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
						<a href="#" class="dropdown-item d-flex pb-3">
							<span class=" mr-3 align-self-center"><img src="{{asset('assets/images/french_flag.jpg')}}"
									alt="img" class="avatar Flag"></span>
							<div>
								<strong>French</strong>
							</div>
						</a>
						<a href="#" class="dropdown-item d-flex pb-3">
							<span class="mr-3 align-self-center"><img src="{{asset('assets/images/germany_flag.jpg')}}"
									alt="img" class="avatar Flag"></span>
							<div>
								<strong>Germany</strong>
							</div>
						</a>
						<a href="#" class="dropdown-item d-flex pb-3">
							<span class="mr-3 align-self-center"><img src="{{asset('assets/images/italy_flag.jpg')}}"
									alt="img" class="avatar Flag"></span>
							<div>
								<strong>Italy</strong>
							</div>
						</a>
						<a href="#" class="dropdown-item d-flex pb-3">
							<span class="mr-3 align-self-center"><img src="{{asset('assets/images/russia_flag.jpg')}}"
									alt="img" class="avatar Flag"></span>
							<div>
								<strong>Russia</strong>
							</div>
						</a>
						<a href="#" class="dropdown-item d-flex pb-3">
							<span class="mr-3 align-self-center"><img src="{{asset('assets/images/spain_flag.jpg')}}"
									alt="img" class="avatar Flag"></span>
							<div>
								<strong>NRT</strong>
							</div>
						</a>
					</div>
			</div>
			</li> --}}

			{{-- <li class="">
				<div class="dropdown d-none d-md-flex border-right">
					<a class="nav-link icon" data-toggle="dropdown" aria-expanded="false">
						<i class="fe fe-mail floating"></i>
						<span class=" nav-unread badge badge-warning  badge-pill">2</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
						<a href="#" class="dropdown-item text-center">2 New Messages</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item d-flex pb-3">
							<span class="avatar brround mr-3 align-self-center"><img
									src="{{asset('assets/images/faces/male/41.jpg')}}" class="avatar brround "
			alt="user-img"></span>
			<div>
				<strong>Madeleine</strong> Hey! there I' am available....
				<div class="small text-muted">3 hours ago</div>
			</div>
			</a>
			<a href="#" class="dropdown-item d-flex pb-3">
				<span class="avatar brround mr-3 align-self-center"><img
						src="{{asset('assets/images/faces/female/1.jpg')}}" class="avatar brround "
						alt="user-img"></span>
				<div>
					<strong>Anthony</strong> New product Launching...
					<div class="small text-muted">5 hour ago</div>
				</div>
			</a>
			<a href="#" class="dropdown-item d-flex pb-3">
				<span class="avatar brround mr-3 align-self-center"><img
						src="{{asset('assets/images/faces/female/18.jpg')}}" class="avatar brround "
						alt="user-img"></span>
				<div>
					<strong>Olivia</strong> New Schedule Realease......
					<div class="small text-muted">45 mintues ago</div>
				</div>
			</a>
			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item text-center">See all Messages</a>
		</div>
	</div>
	</li> --}}
	</ul>
</div>

<div class="d-flex order-lg-2 ml-auto">
	<div class="mt-2">
		@if(Auth::user()->userType == 3)
		<div class="searching  ml-2 mr-3">
			<a href="{{url('/session-form')}}" class="btn btn-primary">
				Consult a Clinician
			</a>
			{{-- <input type="button" class="btn btn-primary" value="" /> --}}
			{{-- <div class="search-inline">
				<form>
					<input type="text" class="form-control" placeholder="Search here">
					<button type="submit">
						<i class="fa fa-search"></i>
					</button>
					<a href="javascript:void(0)" class="search-close">
						<i class="fa fa-times"></i>
					</a>
				</form>
			</div> --}}
		</div>
		@endif
	</div>
	<div class="dropdown d-none d-md-flex ">
		<a class="nav-link icon full-screen-link">
			<i class="mdi mdi-arrow-expand-all" id="fullscreen-button"></i>
		</a>
	</div>
	<div class="dropdown d-none d-md-flex">
		<a class="nav-link icon" data-toggle="dropdown">
			<i class="mdi mdi-bell-outline "></i>
			<span class="nav-unread bg-success"></span>
		</a>
		<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
			<a href="#" class="dropdown-item d-flex pb-3">
				<div class="notifyimg">
					<i class="fa fa-thumbs-o-up"></i>
				</div>
				<div>
					<strong>Someone likes our posts.</strong>
					<div class="small text-muted">3 hours ago</div>
				</div>
			</a>
			<a href="#" class="dropdown-item d-flex pb-3">
				<div class="notifyimg">
					<i class="fa fa-commenting-o"></i>
				</div>
				<div>
					<strong> 3 New Comments</strong>
					<div class="small text-muted">5 hour ago</div>
				</div>
			</a>

			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item text-center">View all Notification</a>
		</div>
	</div>
	<div class="dropdown d-none d-md-flex">
		<a class="nav-link icon" data-toggle="dropdown">
			<i class="fe fe-grid floating"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-0">
			<ul class="drop-icon-wrap p-0 m-0">
				<li>
					<a href="email.html" class="drop-icon-item">
						<i class="fe fe-mail"></i>
						<span class="block"> E-mail</span>
					</a>
				</li>
				<li>
					<a href="calendar2.html" class="drop-icon-item">
						<i class="fe fe-calendar"></i>
						<span class="block">calendar</span>
					</a>
				</li>
				<li>
					<a href="maps.html" class="drop-icon-item">
						<i class="fe fe-map-pin"></i>
						<span class="block">map</span>
					</a>
				</li>
				<li>
					<a href="cart.html" class="drop-icon-item">
						<i class="fe fe-shopping-cart"></i>
						<span class="block">Cart</span>
					</a>
				</li>
				<li>
					<a href="chat.html" class="drop-icon-item">
						<i class="fe fe-message-square"></i>
						<span class="block">chat</span>
					</a>
				</li>
				<li>
					<a href="profile.html" class="drop-icon-item">
						<i class="fe fe-phone-outgoing"></i>
						<span class="block">contact</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="dropdown">
		<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
			<span class="avatar avatar-md brround"><img src="{{asset('Images/'.Auth::user()->profile_pic)}}"
					alt="Profile-img" class="avatar avatar-md brround"></span>
		</a>
		<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
			<div class="text-center">
				<a href="#" class="dropdown-item text-center font-weight-sembold user">{{Auth::user()->name}}</a>

				<div class="dropdown-divider"></div>
			</div>
			@if(Auth::user()->userType == 2 || Auth::user()->userType == 3 )
			<a class="dropdown-item" href="{{url('/edit-profile')}}">
				<i class="dropdown-icon mdi mdi-account-outline "></i> Profile
			</a>
			@endif
			<a class="dropdown-item" href="#">
				<i class="dropdown-icon  mdi mdi-settings"></i> Settings
			</a>
			<a class="dropdown-item" href="#">
				<span class="float-right"><span class="badge badge-primary">6</span></span>
				<i class="dropdown-icon mdi  mdi-message-outline"></i> Inbox
			</a>
			<a class="dropdown-item" href="#">
				<i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message
			</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">
				<i class="dropdown-icon mdi mdi-compass-outline"></i> Need help?
			</a>
			<a class="dropdown-item" href="">

			</a>
			<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
						                                                     document.getElementById('logout-form').submit();">
				<i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
			</a>

			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
		</div>
	</div>
</div>
</div>
</div>
</div>