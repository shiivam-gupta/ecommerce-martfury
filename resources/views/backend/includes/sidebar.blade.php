<aside class="app-sidebar">
	<div class="app-sidebar__user">
		<div class="dropdown user-pro-body">
			<div>
				<img src="{{ asset('frontend/img/aboutus/'. $appsetting->app_logo) }}" alt="user-img" class="avatar avatar-xl brround mCS_img_loaded">
				<!-- <a href="editprofile.html" class="profile-img">
					<span class="fa fa-pencil" aria-hidden="true"></span>
				</a> -->
			</div>
			<div class="user-info mb-2">
				<h4 class="font-weight-semibold text-dark mb-1">{{$appsetting->app_name}}</h4>
				{{-- <span class="mb-0 text-muted">Ui Designer</span> --}}
			</div>
			{{-- <a href="#" title="settings" class="user-button"><i class="fa fa-cog"></i></a>
			<a href="#" title="Comments" class="user-button"><i class="fa fa-comments"></i></a>
			<a href="#" title="logout" class="user-button"><i class="fa fa-power-off"></i></a> --}}
		</div>
	</div>
	<ul class="side-menu">
		<li>
			<a class="side-menu__item" href="{{route('admin.dashboard')}}"><i class="side-menu__icon fa fa-desktop"></i><span class="side-menu__label">Dashboard</span></a>
		</li>
		<li class="slide">
			<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-desktop"></i><span class="side-menu__label">Users</span><i class="angle fa fa-angle-right"></i></a>
			<ul class="slide-menu">
				<li><a class="slide-item" href="{{ URL::to('admin/users') }}">User Management</a></li>
			</ul>
		</li>
		<li class="slide">
			<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-image"></i><span class="side-menu__label">Banners & Content</span><i class="angle fa fa-angle-right"></i></a>
			<ul class="slide-menu">
				<li><a class="slide-item" href="{{ route('banner') }}">Banner</a></li>
				<li><a class="slide-item" href="{{ route('belowbanner') }}">Below Banner Content</a></li>
			</ul>
		</li>
		<li class="slide">
			<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-list"></i><span class="side-menu__label">Category Management</span><i class="angle fa fa-angle-right"></i></a>
			<ul class="slide-menu">
				<li><a class="slide-item" href="{{ route('category') }}">Category </a></li>
				<li><a class="slide-item" href="{{ route('subcategory') }}">Sub Category </a></li>
				<li><a class="slide-item" href="{{ route('childcategory') }}">Child Category </a></li>
			</ul>
		</li>
		<li class="slide">
			<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-list"></i><span class="side-menu__label">Product management</span><i class="angle fa fa-angle-right"></i></a>
			<ul class="slide-menu">
				<li><a class="slide-item" href="{{ URL::to('admin/brand') }}">Brands</a></li>
				<!-- <li><a class="slide-item" href="{{ URL::to('admin/attr-master') }}">Attribute Management</a></li> -->
				<li><a class="slide-item" href="{{ URL::to('admin/product') }}">Products</a></li>
			</ul>
		</li>

		<li>
			<a class="side-menu__item" href="{{route('admin.coupon')}}"><i class="side-menu__icon fa fa-magic"></i><span class="side-menu__label">Coupon management</span></a>
		</li>

		<li class="slide">
			<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-list"></i><span class="side-menu__label">Orders Management</span><i class="angle fa fa-angle-right"></i></a>
			<ul class="slide-menu">
				<li><a class="slide-item" href="{{ route('admin.orders') }}">Orders</a></li>
				<li><a class="slide-item" href="{{ route('admin.reviews') }}">Reviews</a></li>
			</ul>
		</li>
		<li>
			<a class="side-menu__item" href="{{route('admin.wishlist')}}"><i class="side-menu__icon fa fa-heart-o"></i><span class="side-menu__label">Wishlist</span></a>
		</li>

		<li>
			<a class="side-menu__item" href="{{route('admin.contactus')}}"><i class="side-menu__icon fa fa-phone"></i><span class="side-menu__label">Contact Us</span></a>
		</li>

		<li class="slide">
			<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-desktop"></i><span class="side-menu__label">CMS</span><i class="angle fa fa-angle-right"></i></a>
			<ul class="slide-menu">
				<li><a class="slide-item" href="{{ route('sliders') }}">Slider</a></li>
				<li><a class="slide-item" href="{{ route('aboutus') }}">About Us</a></li>
				<li><a class="slide-item" href="{{ route('admin.quicklink') }}">Footer Quicklink</a></li>
				<li><a class="slide-item" href="{{ route('admin.faqs') }}">Faqs</a></li>
			</ul>
		</li>
	</ul>
</aside>