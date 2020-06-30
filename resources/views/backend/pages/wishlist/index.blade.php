@extends('backend.layouts.master')
@section('content')
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title ">Wishlist</h3>
					<div class="card-options">
						<a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="usersDetails" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="5%">S.No</th>
									<th>Name</th>
									<th>Product</th>
									{{-- <th>Action</th> --}}
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
				url: '{{ route('admin.wishlist.list') }}',
			},
			"columns": [

			{data: 'sn', name: 'sn'},
			{data: 'user_id', name: 'user_id'},
			{data: 'product_id', name: 'product_id'},
			//{data: 'action', name: 'action',className:'noPrint', orderable: false},

			]
		});
	});
	
</script>
@endsection