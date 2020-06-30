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
					<h3 class="card-title ">Brands</h3>
					<div class="card-options">
                   
						<a class="btn btn-sm btn-outline-primary" href="{{route('brand.create')}}"> <i class="fa fa-plus"></i> Add Brand</a>
						&nbsp;&nbsp;&nbsp;<a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="usersDetails" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="5%">S.No</th>
									<th>Name</th>
									<th width="10%">Status</th>
									<th width="20%">Action</th>
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
				url: '{{ URL::to('admin/brand') }}',
			},
			"columns": [

			{data: 'sn', name: 'sn'},
			{data: 'name', name: 'name'},
			{data: 'status', name: 'status'},
			{data: 'action', name: 'action',className:'noPrint', orderable: false},

			]
		});
	});
	
</script>
@endsection