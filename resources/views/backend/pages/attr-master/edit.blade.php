@extends('backend.layouts.master')
@section('content')

<div class="side-app">
	<div class="page-header">
		<h4 class="page-title">Attribute</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Attribute</a></li>
			<li class="breadcrumb-item active" aria-current="page">Attribute Edit</li>
		</ol>

	</div>
	<div class="row">
		<div class="col-md-12">
			<form class="card" action="{{ route('attr-master.update', $attrInfo->id) }}" enctype="multipart/form-data" method="post">
				@method('PATCH')
				@csrf
				<div class="card-header">
					<h3 class="mb-0 card-title">Attribute Edit</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Attribute Name</label>
								<input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') ? old('name') : $attrInfo->name }}">
								@if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
							</div>
						</div>
						<div class="col-md-6">
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					<a href="{{ route('attr-master.index') }}"  class="btn btn-primary">Cancel</a>
					<button type="submit" class="btn btn-primary">Update Attribute</button>
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