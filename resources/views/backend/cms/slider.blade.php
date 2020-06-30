@extends('backend.layouts.master')
@section('content')

@if(Request::segment(2)==='add-slider')
<div class="row">
	<div class="col-12">
		{{ Form::open(array('route' => 'save-slider', 'class'=> 'form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) }}
		@csrf
			<div class="card">
				<div class="card-header">
					<h3 class="card-title ">Add Slider</h3>
					<div class="card-options">
						<a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
					</div>
				</div>
				
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="image" class="form-label">Upload image</label>
								{!! Form::file('image', array('id'=>'image','class'=> $errors->has('image') ? 'form-control is-invalid state-invalid' : 'form-control', 'autocomplete'=>'off','required'=>'required', 'accept'=>'image/*')) !!}
								@if ($errors->has('image'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('image') }}</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					{!! Form::submit('Save', array('class'=>'btn btn-primary')) !!}
					<a href="{{ url()->previous() }}"  class="btn btn-danger">Cancel</a>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@else
<div class="row">
	<div class="col-12">
		<div class="table-responsive">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title ">Manage Slider</h3>
					<div class="card-options">
                   
						<a class="btn btn-sm btn-outline-primary" href="{{route('add-slider')}}"> <i class="fa fa-plus"></i> Add Slider</a>
						&nbsp;&nbsp;&nbsp;<a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
					</div>
				</div>
				
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col">#</th>          
									<th scope="col">Slider Image</th>
									<th scope="col"width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($sliders as $key => $slider)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>
										<img src="{{ asset('frontend/img/slider/'. $slider->image) }}" class="img-responsive">
									</td> 
									<td>
										<div class="btn-group btn-group-xs">
											<a class="btn btn-sm btn-danger" href="{{ route('delete-slider',array('id'=>$slider->id)) }}" onClick="return confirm('Are you sure you want to delete this?');" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@endsection