@extends('backend.layouts.master')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header ">
            <h3 class="card-title ">Users Management</h3>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table id="usersDetails" class="table table-striped table-bordered">
                  <thead>
                     <tr>
						<th>S.No</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone Number</th>
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

@endsection

@section('after-scripts')

<script type="text/javascript">
	$(document).ready(function() {
		oTable = $('#usersDetails').DataTable({
			"processing": true,
			"serverSide": true,
			ajax: {
				url: '{{ URL::to('admin/users') }}',
			},
			"columns": [

			{data: 'sn', name: 'sn'},
			{data: 'fullname', name: 'fullname'},
			{data: 'email', name: 'email'},
			{data: 'phone_no', name: 'phone_no'},
			{data: 'status', name: 'status'},
			{data: 'action', name: 'action',className:'noPrint', orderable: false},

			]
		});
	});
	
</script>
@endsection