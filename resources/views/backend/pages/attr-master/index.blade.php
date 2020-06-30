@extends('backend.layouts.master')
@section('content')

<div class="side-app">
	<div class="page-header">
		<h4 class="page-title">Attribute Management</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Attribute</a></li>
			<li class="breadcrumb-item active" aria-current="page">Attribute List</li>
		</ol>
	</div>
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
					<div class="container" style="font-weight:bold;"></div>
					<div class="text-right">
						<a href="{{ route('attr-master.create') }}"  class="btn btn-primary">Create Attribute</a>
					</div>
					<!-- <a style="float:right; width: 150px;" class="btn btn-primary" href=""></a> -->
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="usersDetails" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Name</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
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
				url: '{{ URL::to('admin/attr-master') }}',
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