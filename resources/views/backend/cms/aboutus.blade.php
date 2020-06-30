@extends('backend.layouts.master')
@section('content')
<div class="row">
	<div class="col-12">
		{{ Form::open(array('route' => 'save-aboutus', 'class'=> 'form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) }}
		@csrf
		{!! Form::hidden('old_image',$aboutus->image, array('id'=>'old_image','class'=>'form-control')) !!}
			<div class="card">
				<div class="card-header">
					<h3 class="card-title ">About Us</h3>
					<div class="card-options">
						<a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
					</div>
				</div>
				
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="title" class="form-label">Title</label>
								{!! Form::text('title',$aboutus->title, array('id'=>'title','class'=> $errors->has('title') ? 'form-control is-invalid state-invalid' : 'form-control', 'autocomplete'=>'off','placeholder'=>'Title','required'=>'required')) !!}
								@if ($errors->has('title'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('title') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="subtitle" class="form-label">Subtitle</label>
								{!! Form::text('subtitle',$aboutus->subtitle, array('id'=>'subtitle','class'=> $errors->has('subtitle') ? 'form-control is-invalid state-invalid' : 'form-control', 'autocomplete'=>'off','placeholder'=>'Subtitle')) !!}
							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="description" class="form-label">Description</label>
								{!! Form::textarea('description', $aboutus->description, array('id'=>'description','class'=> $errors->has('description') ? 'form-control is-invalid state-invalid ckeditor' : 'form-control ckeditor', 'autocomplete'=>'off','required'=>'required')) !!}
								@if ($errors->has('description'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="image" class="form-label">Upload image</label>
								{!! Form::file('image', array('id'=>'image','class'=> $errors->has('image') ? 'form-control is-invalid state-invalid' : 'form-control', 'autocomplete'=>'off', 'accept'=>'image/*')) !!}
								@if ($errors->has('image'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('image') }}</strong>
								</span>
								@endif
							</div>
						</div>
						@if(!empty($aboutus->image))
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<img src="{{ asset('frontend/img/aboutus/'. $aboutus->image) }}" class="img-responsive">
							</div>
						</div>
						@endif
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
@endsection