@extends('backend.layouts.master')
@section('content')

<div class="side-app" style="margin-top: -30px;">
	<div class="page-header">
		<h4 class="page-title">Contact Us</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Contact Us</a></li>
			<li class="breadcrumb-item active" aria-current="page">Contact Us Reply</li>
		</ol>

	</div>
	<div class="row">
		<div class="col-md-12">
			<form class="card" action="{{ route('admin.contactus-reply', $contactEdit->id) }}" enctype="multipart/form-data" method="post">
				@csrf
				<div class="card-header">
					<h3 class="mb-0 card-title">Contact Us Reply</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Name</label>
								<input type="text" name="fullname" class="form-control" placeholder="Name" value="{{ old('name') ? old('name') : $contactEdit->name }}">
								@if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Email</label>
								<input type="text" name="email" class="form-control" placeholder="email" value="{{ old('email') ? old('email') : $contactEdit->email }}" readonly="">
								@if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Mobile</label>
								<input type="text" name="mobile" class="form-control" placeholder="mobile" value="{{ old('mobile') ? old('mobile') : $contactEdit->mobile }}">
								@if ($errors->has('mobile'))
                                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                @endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Ip Address</label>
								<input type="text" name="ip_address" class="form-control" placeholder="Ip Address" value="{{ old('ip_address') ? old('ip_address') : $contactEdit->ip_address }}">
								@if ($errors->has('ip_address'))
                                    <span class="text-danger">{{ $errors->first('ip_address') }}</span>
                                @endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Address</label>
								<textarea type="text" name="address" class="form-control" placeholder="Address">{{$contactEdit->address }}</textarea>
								@if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Message</label>
								<textarea type="text" name="message" class="form-control" placeholder="message">{{$contactEdit->message }}</textarea>
								@if ($errors->has('message'))
                                    <span class="text-danger">{{ $errors->first('message') }}</span>
                                @endif
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-label">Reply</label>
								<textarea type="text" name="reply" class="form-control" placeholder="reply">{{$contactEdit->reply }}</textarea>
								@if ($errors->has('reply'))
                                    <span class="text-danger">{{ $errors->first('reply') }}</span>
                                @endif
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					<a href="{{ route('admin.contactus') }}"  class="btn btn-primary">Cancel</a>
					<button type="submit" class="btn btn-primary">Update Reply</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('after-scripts')

<script type="text/javascript">

</script>
@endsection