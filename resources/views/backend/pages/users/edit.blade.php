@extends('backend.layouts.master')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<form class="card" action="{{ route('users.update', $customerInfo->id) }}" enctype="multipart/form-data" method="post">
				@method('PATCH')
				@csrf
				<div class="card-header ">
		            <h3 class="card-title ">Users Management</h3>
		         </div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Enter Name</label>
								<input type="text" name="fullname" class="form-control" placeholder="Name" value="{{ old('fullname') ? old('fullname') : $customerInfo->fullname }}">
								@if ($errors->has('fullname'))
                                    <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                @endif
							</div>
							<input type="hidden" id="getCountryId" value="{{ $customerInfo->country_id }}">
							<input type="hidden" id="getStateId" value="{{ $customerInfo->state_id }}">
							<input type="hidden" id="getCityId" value="{{ $customerInfo->city_id }}">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="form-label">Phone Code</label>
										<select class="form-control select2-show-search" name="phone_code" data-placeholder="Choose one (with searchbox)">
											@foreach($country as $key => $value)
												<option value="{{ $value->phonecode }}" {{ $value->phonecode == old('phone_code') ? 'selected' : ''}} >+{{ $value->phonecode }}</option>
											@endforeach
										</select>
										@if ($errors->has('phone_code'))
                                            <span class="text-danger">{{ $errors->first('phone_code') }}</span>
                                        @endif
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label class="form-label">Phone</label>
										<input type="text" class="form-control" name="phone_no" placeholder="Phone" value="{{ old('phone_no') ? old('phone_no') : $customerInfo->phone_no }}">
										@if ($errors->has('phone_no'))
                                            <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                        @endif
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="form-label">Country</label>
										<select id="country_id" class="form-control select2-show-search" onchange="getState(this)" name="country_id" data-placeholder="Choose one (with searchbox)">
											@foreach($country as $key => $value)
												<option value="{{ $value->id }}" {{ $value->id == $customerInfo->country_id ? 'selected' : ''}} >{{ $value->name }}</option>
											@endforeach
										</select>
										@if ($errors->has('country_id'))
                                            <span class="text-danger">{{ $errors->first('country_id') }}</span>
                                        @endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="form-label">State</label>
										<select class="form-control select2-show-search state-box" onchange="getCity(this)" name="state_id" data-placeholder="Choose one (with searchbox)">
											
										</select>
										@if ($errors->has('state_id'))
                                            <span class="text-danger">{{ $errors->first('state_id') }}</span>
                                        @endif
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label class="form-label">City</label>
										<select class="form-control select2-show-search city-box" name="city_id" data-placeholder="Choose one (with searchbox)">
											
										</select>
										@if ($errors->has('city_id'))
                                            <span class="text-danger">{{ $errors->first('city_id') }}</span>
                                        @endif
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="form-label">Pincode</label>
								<input type="text" name="pincode" class="form-control" placeholder="Pincode" value="{{ old('pincode') ? old('pincode') : $customerInfo->pincode }}">
								@if ($errors->has('pincode'))
                                    <span class="text-danger">{{ $errors->first('pincode') }}</span>
                                @endif
							</div>
							<div class="form-group">
								<label class="form-label">Address</label>
								<textarea class="form-control" name="address" >{{ old('address') ? old('address') : $customerInfo->address }}</textarea>
								
								@if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
							</div>
							
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Email</label>
								<input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') ? old('email') : $customerInfo->email }}" >
								@if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
							</div>
							<div class="form-group">
								<label class="form-label">Date Of Birth</label>
								<div class="wd-200 mg-b-30">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
											</div>
										</div><input class="form-control fc-datepicker" name="dob" placeholder="MM/DD/YYYY" type="text" readonly="" value="{{ old('dob') ? old('dob') : $customerInfo->dob }}">
									</div>
								</div>
								@if ($errors->has('dob'))
                                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                                @endif
							</div>
							<div class="form-group">
								<label class="form-label">Upload Pic</label>
								<input type="file" name="profile_pic" class="form-control" placeholder="Name" value="">
								@if ($errors->has('profile_pic'))
                                    <span class="text-danger">{{ $errors->first('profile_pic') }}</span>
                                @endif
							</div>
							<div class="form-group">
								
								<img height="100px" width="100px" src="{{ asset($customerInfo->profile_pic) }}" alt="{{ $customerInfo->fullname }}">
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					<a href="{{ route('users.index') }}"  class="btn btn-primary">Cancel</a>
					<button type="submit" class="btn btn-primary">Update Profile</button>
				</div>
			</form>
		</div>
	</div>

@endsection

@section('after-scripts')

<script type="text/javascript">
	$(document).ready(function() {
		getState('');
		getCity('');
	});

	function getState(e){
		var country_id = e ? e.value : $('#getCountryId').val();
		var state_id = $('#getStateId').val();
		$.ajax({
			type: "GET",
			dataType: "json",
			url: "{{route('admin.getstate')}}",
			data: {'country_id': country_id, 'state_id': state_id},
			success: function(data){
				$('.state-box').html(data.html);
				if(e){
					$('.city-box').html('');
				}
			}
		});
	}
	
	function getCity(e){
		var state_id =  e ? e.value : $('#getStateId').val();
		var city_id = $('#getCityId').val();
		$.ajax({
			type: "GET",
			dataType: "json",
			url: "{{route('admin.getcity')}}",
			data: {'state_id': state_id, 'city_id': city_id},
			success: function(data){
				 $('.city-box').html(data.html);
			}
		});
	}
</script>
@endsection