@extends('backend.layouts.master')
@section('content')

@if(Request::segment(2)==='add-faqs')
<?php
$id         = '';
$required   = 'required';
?>
@elseif(Request::segment(2)==='edit-faqs')
<?php
$id          = $faqs->id;
$required    = '';
?>
@endif

@if(Request::segment(2)==='add-faqs')
	
	<div class="row">
		<div class="col-md-12">
			<form class="card" action="{{ route('admin.faqssave') }}" enctype="multipart/form-data" method="post">
				@csrf
				<div class="card-header">
					<h3 class="mb-0 card-title">Faqs Create</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="question" class="form-label">Question</label>
								{!! Form::text('question','', array('id'=>'question','class'=> $errors->has('question') ? 'form-control is-invalid state-invalid' : 'form-control', 'autocomplete'=>'off','placeholder'=>'question')) !!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="answer" class="form-label">Answer</label>
								{!! Form::textarea('answer', '', array('id'=>'answer','class'=> $errors->has('answer') ? 'form-control is-invalid state-invalid ckeditor' : 'form-control ckeditor', 'autocomplete'=>'off','required'=>'required')) !!}
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

@elseif(Request::segment(2)==='edit-faqs')
	<div class="row">
		<div class="col-md-12">
			<form class="card" action="{{ route('admin.faqssave') }}" enctype="multipart/form-data" method="post">
				@csrf
				{!! Form::hidden('id',$id,array('class'=>'form-control')) !!}
				<div class="card-header">
					<h3 class="mb-0 card-title">Faqs Edit</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="question" class="form-label">Question</label>
								{!! Form::text('question',$faqs->question, array('id'=>'question','class'=> $errors->has('question') ? 'form-control is-invalid state-invalid' : 'form-control', 'autocomplete'=>'off','placeholder'=>'question')) !!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label for="answer" class="form-label">Answer</label>
								{!! Form::textarea('answer', $faqs->answer, array('id'=>'answer','class'=> $errors->has('answer') ? 'form-control is-invalid state-invalid ckeditor' : 'form-control ckeditor', 'autocomplete'=>'off','required'=>'required')) !!}
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
@else
<div class="row">
	<div class="col-12">
		<div class="table-responsive">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title "><b>Faqs</b></h3>
					<div class="card-options">
						<a class="btn btn-sm btn-outline-primary" href="{{route('add-faqs')}}"> <i class="fa fa-plus"></i> Add Faqs</a>
						&nbsp;&nbsp;&nbsp;<a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Question</th>                            
									<th scope="col">Answer</th>                 
									<th scope="col"width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
								@if($faqs!= '')
								<?php $i=1;?>
								@foreach($faqs as $key=>$rows)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{!! $rows->question !!}</td> 
									<td>{!! $rows->answer !!}</td> 
									<td>
										<div class="btn-group btn-group-xs">                   
											<a class="btn btn-sm btn-primary" href="{{ route('edit-faqs',array('id'=>$rows->id)) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-sm btn-danger" href="{{ route('delete-faqs',array('id'=>$rows->id)) }}" onClick="return confirm('Are you sure you want to delete this?');" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
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