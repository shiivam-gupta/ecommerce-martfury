@extends('backend.layouts.master')
@section('content')

	@if ($message = Session::get('success'))
	<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<p>{{ $message }}</p>
	</div>
	@endif
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title ">Contact US</h3>
					<div class="card-options">
						<a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="usersDetails" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Name</th>
									<th>Email Id</th>
									<th>Mobile</th>
									<th>Address</th>
									<th>Message</th>
									<!-- <th>Action</th> -->
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('after-scripts')

<script type="text/javascript">
	$(document).ready(function() {
		oTable = $('#usersDetails').DataTable({
			"processing": true,
			"serverSide": true,
			ajax: {
				url: '{{ route('admin.contactus-list') }}',
			},
			"columns": [

			{data: 'sn', name: 'sn'},
			{data: 'name', name: 'name'},
			{data: 'email', name: 'email'},
			{data: 'mobile', name: 'mobile'},
			{data: 'address', name: 'address'},
			{data: 'message', name: 'message'},
			// {data: 'action', name: 'action',className:'noPrint', orderable: false},

			]
		});
	});
	
</script>
@endsection