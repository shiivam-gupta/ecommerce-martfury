@extends('backend.layouts.master')
@section('content')

@if(Request::segment(2)==='add-coupon')
<?php
$id         = '';
$required   = 'required';
?>
@elseif(Request::segment(2)==='edit-coupon')
<?php
$id          = $data->id;
$required    = '';
?>
@endif

@if(Request::segment(2)==='add-coupon')
	
	<div class="row">
		<div class="col-md-12">
			<form class="card" action="{{ route('admin.couponsave') }}" enctype="multipart/form-data" method="post">
				@csrf
				<div class="card-header">
					<h3 class="mb-0 card-title">Coupon Create</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Coupon Title</label>
								<input type="text" name="title" class="form-control" placeholder="Coupon title" value="{{ old('title') ? old('title') : '' }}">
								@if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">No of Coupon</label>
								<input type="text" name="coupon_number" class="form-control" placeholder="No of Coupon" value="{{ old('coupon_number') ? old('coupon_number') : '' }}">
								@if ($errors->has('coupon_number'))
                                    <span class="text-danger">{{ $errors->first('coupon_number') }}</span>
                                @endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Coupon Type</label>
								<select name="type" id="select-countries" class="form-control custom-select">
									<option value="">--select here--</option>
									<option value="{{ PERCENTAGE }}" {{ old('type') == PERCENTAGE ? 'selected' : ''}}>Percentage</option>
									<option value="{{ FIXED }}" {{ old('type') == FIXED ? 'selected' : ''}}>Fixed</option>
								</select>
								@if ($errors->has('type'))
                                    <span class="text-danger">{{ $errors->first('type') }}</span>
                                @endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Percentage Amount</label>
								<input type="text" name="percentage_amount" class="form-control" placeholder="Percentage Amount" value="{{ old('percentage_amount') ? old('percentage_amount') : '' }}">
								@if ($errors->has('percentage_amount'))
                                    <span class="text-danger">{{ $errors->first('percentage_amount') }}</span>
                                @endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Coupon Option</label>
								<select name="coupon_option" id="select-countries" class="form-control custom-select">
									<option value="">--select here--</option>
									<option value="{{ ONE_TIME }}" {{ old('coupon_option') == ONE_TIME ? 'selected' : ''}}>One Time</option>
									<option value="{{ MULTIPLE_TIME }}" {{ old('coupon_option') == MULTIPLE_TIME ? 'selected' : ''}}>Multiple Time</option>
								</select>
								@if ($errors->has('coupon_option'))
                                    <span class="text-danger">{{ $errors->first('coupon_option') }}</span>
                                @endif
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					{{-- <a href="{{ route('category.index') }}"  class="btn btn-primary">Cancel</a> --}}
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>

@elseif(Request::segment(2)==='edit-coupon')
	<div class="row">
		<div class="col-md-12">
			<form class="card" action="{{ route('admin.couponsave') }}" enctype="multipart/form-data" method="post">
				@csrf
				{!! Form::hidden('id',$id,array('class'=>'form-control')) !!}
				<div class="card-header">
					<h3 class="mb-0 card-title">Coupon Edit</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Coupon Title</label>
								<input type="text" name="title" class="form-control" placeholder="Coupon title" value="{{ $data->getCouponCode->title }}" readonly>
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Coupon Code</label>
								<input type="text" name="coupon_code" class="form-control" placeholder="No of Coupon" value="{{ old('coupon_code') ? old('coupon_code') : ($data->coupon_code ? $data->coupon_code : '') }}">
								@if ($errors->has('coupon_code'))
                                    <span class="text-danger">{{ $errors->first('coupon_code') }}</span>
                                @endif
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					{{-- <a href="{{ route('category.index') }}"  class="btn btn-primary">Cancel</a> --}}
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
@else
<div class="row">
	<div class="col-12">
		<div class="table-responsive">

			<div class="card">
				<div class="card-header">
					<h3 class="card-title "><b>Manage Coupon</b></h3>
					<div class="card-options">
                   
						<a class="btn btn-sm btn-outline-primary" href="{{route('add-coupon')}}"> <i class="fa fa-plus"></i> Add Coupon</a>
						&nbsp;&nbsp;&nbsp;<a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
					</div>
				</div>
				
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered">
							<thead>
								<tr>
									
									<th scope="col">#</th>
									<th scope="col">Coupon Title</th>            
									<th scope="col">Coupon Code</th>                 
									<th scope="col"width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
								@if($couponList!= '')
								<?php $i=1;?>
								@foreach($couponList as $key=>$rows)
								<tr>
									
									<td>{{ $i++ }}</td>
									<td>{!! $rows->getCouponCode->title!!}</td>
									<td>{!! $rows->coupon_code !!}</td> 
									
									<td>
										<div class="btn-group btn-group-xs">                   
											<a class="btn btn-sm btn-primary" href="{{ route('edit-coupon',array('id'=>$rows->id)) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-sm btn-danger" href="{{ route('delete-coupon',array('id'=>$rows->id)) }}" onClick="return confirm('Are you sure you want to delete this?');" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>

										</div>
									</td>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>
					</div>
					

				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@endif
@endsection

@section('after-scripts')

@endsection