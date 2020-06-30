@extends('backend.layouts.master')

@section('content')
<div class="row row-cards">
		<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3 ">
			<div class="card card-img-holder">
				<div class="card-body">
					<p class="card-text text-muted font-weight-semibold mb-1">Total Products</p>
					<div class="clearfix">
						<div class="float-left  mt-2">
							<h1>{{$productCount}}</h1>
						</div>
						<div class="float-right text-right">
							<span class="pie" data-peity='{ "fill": ["#ff685c", "#f2f2f2"]}'></span>
						</div>
					</div>
					<div class="progress progress-md mt-1 h-2">
						<div class="progress-bar  bg-gradient-primary w-70"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
			<div class="card card-img-holder">
				<div class="card-body">
					<p class="card-text text-muted font-weight-semibold mb-1">Total Active Products</p>
					<div class="clearfix">
						<div class="float-left  mt-2">
							<h1>{{$productActive}}</h1>
						</div>
						<div class="float-right text-right">
							<span class="pie" data-peity='{ "fill": ["#32cafe", "#f2f2f2"]}'></span>
						</div>
					</div>
					<div class="progress progress-md mt-1 h-2">
						<div class="progress-bar  bg-gradient-secondary w-50"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
			<div class="card card-img-holder">
				<div class="card-body">
					<p class="card-text text-muted font-weight-semibold mb-1">Total Inactive Products</p>
					<div class="clearfix">
						<div class="float-left  mt-2">
							<h1>{{$productInActive}}</h1>
						</div>
						<div class="float-right text-right">
							<span class="pie" data-peity='{ "fill": ["#32cafe", "#f2f2f2"]}'></span>
						</div>
					</div>
					<div class="progress progress-md mt-1 h-2">
						<div class="progress-bar  bg-gradient-secondary w-50"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
			<div class="card card-img-holder">
				<div class="card-body">
					<p class="card-text text-muted font-weight-semibold mb-1">Total Orders</p>
					<div class="clearfix">
						<div class="float-left  mt-2">
							<h1>{{$orderCount}}</h1>
						</div>
						<div class="float-right text-right">
							<span class="pie" data-peity='{ "fill": ["#32cafe", "#f2f2f2"]}'></span>
						</div>
					</div>
					<div class="progress progress-md mt-1 h-2">
						<div class="progress-bar  bg-gradient-secondary w-50"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
			<div class="card card-img-holder">
				<div class="card-body">
					<p class="card-text text-muted font-weight-semibold mb-1">Total Delivered Orders</p>
					<div class="clearfix">
						<div class="float-left  mt-2">
							<h1>{{$deliveredOrder}}</h1>
						</div>
						<div class="float-right text-right">
							<span class="pie" data-peity='{ "fill": ["#32cafe", "#f2f2f2"]}'></span>
						</div>
					</div>
					<div class="progress progress-md mt-1 h-2">
						<div class="progress-bar  bg-gradient-secondary w-50"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
			<div class="card card-img-holder">
				<div class="card-body">
					<p class="card-text text-muted font-weight-semibold mb-1">Total Confirmed Orders</p>
					<div class="clearfix">
						<div class="float-left  mt-2">
							<h1>{{$confirmedOrder}}</h1>
						</div>
						<div class="float-right text-right">
							<span class="pie" data-peity='{ "fill": ["#32cafe", "#f2f2f2"]}'></span>
						</div>
					</div>
					<div class="progress progress-md mt-1 h-2">
						<div class="progress-bar  bg-gradient-secondary w-50"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
			<div class="card card-img-holder">
				<div class="card-body">
					<p class="card-text text-muted font-weight-semibold mb-1">Total Pending Orders</p>
					<div class="clearfix">
						<div class="float-left  mt-2">
							<h1>{{$pendingOrder}}</h1>
						</div>
						<div class="float-right text-right">
							<span class="pie" data-peity='{ "fill": ["#5ed84f", "#f2f2f2"]}'></span>
						</div>
					</div>
					<div class="progress progress-md mt-1 h-2">
						<div class="progress-bar  bg-gradient-success w-50"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
			<div class="card card-img-holder">
				<div class="card-body">
					<p class="card-text text-muted font-weight-semibold mb-1">Canceled Orders</p>
					<div class="clearfix">
						<div class="float-left  mt-2">
							<h1>{{$cancelledOrder}}</h1>
						</div>
						<div class="float-right text-right">
							<span class="pie" data-peity='{ "fill": ["#fdb901", "#f2f2f2"]}'></span>
						</div>
					</div>
					<div class="progress progress-md mt-1 h-2">
						<div class="progress-bar  progress-bar-animated bg-warning w-55"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
			<div class="card card-img-holder">
				<div class="card-body">
					<p class="card-text text-muted font-weight-semibold mb-1">Total Wishlist</p>
					<div class="clearfix">
						<div class="float-left  mt-2">
							<h1>{{$wishCount}}</h1>
						</div>
						<div class="float-right text-right">
							<span class="pie" data-peity='{ "fill": ["#fdb901", "#f2f2f2"]}'></span>
						</div>
					</div>
					<div class="progress progress-md mt-1 h-2">
						<div class="progress-bar  progress-bar-animated bg-warning w-55"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
			<div class="card card-img-holder">
				<div class="card-body">
					<p class="card-text text-muted font-weight-semibold mb-1">Total Reviews</p>
					<div class="clearfix">
						<div class="float-left  mt-2">
							<h1>{{$reviewCount}}</h1>
						</div>
						<div class="float-right text-right">
							<span class="pie" data-peity='{ "fill": ["#fdb901", "#f2f2f2"]}'></span>
						</div>
					</div>
					<div class="progress progress-md mt-1 h-2">
						<div class="progress-bar  progress-bar-animated bg-warning w-55"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
		
@endsection