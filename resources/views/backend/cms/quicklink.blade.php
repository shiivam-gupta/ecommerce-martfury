@extends('backend.layouts.master')
@section('content')

@if(Request::segment(2)==='add-quicklink')
<?php
$id         = '';
$required   = 'required';
?>
@elseif(Request::segment(2)==='edit-quicklink')
<?php
$id          = $quicklink->id;
$required    = '';
?>
@endif

@if(Request::segment(2)==='add-quicklink')
	
	<div class="row">
		<div class="col-md-12">
			<form class="card" action="{{ route('admin.quicklinksave') }}" enctype="multipart/form-data" method="post">
				@csrf
				<div class="card-header">
					<h3 class="mb-0 card-title">Quick Link Create</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="form-label">Quick Links Type</label>
								{!! Form::select('quicklink_slug', array('' => '--select here--','policy' => 'policy', 'termcondition' => 'termcondition','shipping' => 'shipping', 'return' => 'return'), 'S',['class' => 'form-control']); !!}
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label for="title" class="form-label">Title</label>
								{!! Form::text('title','', array('id'=>'title','class'=> $errors->has('title') ? 'form-control is-invalid state-invalid' : 'form-control', 'autocomplete'=>'off','placeholder'=>'Title',)) !!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="subtitle" class="form-label">Subtitle</label>
								{!! Form::text('subtitle','', array('id'=>'subtitle','class'=> $errors->has('subtitle') ? 'form-control is-invalid state-invalid' : 'form-control', 'autocomplete'=>'off','placeholder'=>'Subtitle')) !!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="description" class="form-label">Description</label>
								{!! Form::textarea('description', '', array('id'=>'description','class'=> $errors->has('description') ? 'form-control is-invalid state-invalid ckeditor' : 'form-control ckeditor', 'autocomplete'=>'off','required'=>'required')) !!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="image" class="form-label">Upload image</label>
								{!! Form::file('image', array('id'=>'image','class'=> $errors->has('image') ? 'form-control is-invalid state-invalid' : 'form-control', 'autocomplete'=>'off', 'accept'=>'image/*')) !!}
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>

@elseif(Request::segment(2)==='edit-quicklink')
	<div class="row">
		<div class="col-md-12">
			<form class="card" action="{{ route('admin.quicklinksave') }}" enctype="multipart/form-data" method="post">
				@csrf
				{!! Form::hidden('id',$id,array('class'=>'form-control')) !!}
				<div class="card-header">
					<h3 class="mb-0 card-title">Quicklink Edit</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="form-label">QuickLink Type</label>
								{!! Form::select('quicklink_slug', array('' => '--select here--','policy' => 'policy', 'termcondition' => 'termcondition','shipping' => 'shipping', 'return' => 'return'), $quicklink->quicklink_slug,['class' => 'form-control','disabled' => true]); !!}
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label for="title" class="form-label">Title</label>
								{!! Form::text('title',$quicklink->title, array('id'=>'title','class'=> $errors->has('title') ? 'form-control is-invalid state-invalid' : 'form-control', 'autocomplete'=>'off','placeholder'=>'Title','required'=>'required')) !!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="subtitle" class="form-label">Subtitle</label>
								{!! Form::text('subtitle',$quicklink->subtitle, array('id'=>'subtitle','class'=> $errors->has('subtitle') ? 'form-control is-invalid state-invalid' : 'form-control', 'autocomplete'=>'off','placeholder'=>'Subtitle')) !!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="description" class="form-label">Description</label>
								{!! Form::textarea('description', $quicklink->description, array('id'=>'description','class'=> $errors->has('description') ? 'form-control is-invalid state-invalid ckeditor' : 'form-control ckeditor', 'autocomplete'=>'off','required'=>'required')) !!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="image" class="form-label">Upload image</label>
								{!! Form::file('image', array('id'=>'image','class'=> $errors->has('image') ? 'form-control is-invalid state-invalid' : 'form-control', 'autocomplete'=>'off', 'accept'=>'image/*')) !!}
							</div>
							{!! Form::hidden('old_image',$quicklink->image, array('id'=>'old_image','class'=>'form-control')) !!}
						</div>
						@if(!empty($quicklink->image))
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<img width="200" height="150" src="{{ asset('frontend/img/quicklink/'. $quicklink->image) }}" class="img-responsive">
							</div>
						</div>
						@endif
					</div>
				</div>
				<div class="card-footer text-right">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
@else
<div class="row">
	<div class="col-12">
		<div class="table-responsive">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title "><b>Footer Quick Links</b></h3>
					<div class="card-options">
						<a class="btn btn-sm btn-outline-primary" href="{{route('add-quicklink')}}"> <i class="fa fa-plus"></i> Add Quick Links</a>
						&nbsp;&nbsp;&nbsp;<a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Slug</th>            
									<th scope="col">Title</th>            
									<th scope="col">Sub Title</th>                 
									<th scope="col">Description</th>                 
									<th scope="col"width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
								@if($quicklink!= '')
								<?php $i=1;?>
								@foreach($quicklink as $key=>$rows)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{!! $rows->quicklink_slug!!}</td>
									<td>{!! $rows->title !!}</td> 
									<td>{!! $rows->subtitle !!}</td> 
									<td>{!! $rows->description !!}</td> 
									<td>
										<div class="btn-group btn-group-xs">                   
											<a class="btn btn-sm btn-primary" href="{{ route('edit-quicklink',array('id'=>$rows->id)) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-sm btn-danger" href="{{ route('delete-quicklink',array('id'=>$rows->id)) }}" onClick="return confirm('Are you sure you want to delete this?');" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
										</div>
									</td>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@endif
@endsection

@section('after-scripts')

@endsection