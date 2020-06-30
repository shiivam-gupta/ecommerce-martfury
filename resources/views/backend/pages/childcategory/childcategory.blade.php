@extends('backend.layouts.master')
@section('content')
@if(Request::segment(2)==='edit-childcategory' || Request::segment(2)==='add-childcategory')
@if(Request::segment(2)==='add-childcategory')
<?php
$id         = '';
$category_id    	= '';
$subcategory_id    	= '';
$name    	= '';
$required   = 'required';
?>
@else
<?php
$id          = $data->id;
$category_id    	 = $data->category_id;
$subcategory_id    	 = $data->subcategory_id;
$name    	 = $data->name;
$required    = '';
?>
@endif
<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">
						@if(Request::segment(2)==='add-childcategory')
						Add
						@else
						Edit
						@endif
						Child Category
					</h3>
					<div class="card-options">

					</div>
				</div>
				<div class="card-body">
					{{ Form::open(array('route' => 'save-childcategory', 'class'=> 'form-horizontal','enctype'=>'multipart/form-data','files'=>true)) }}
					{!! Form::hidden('id',$id,array('class'=>'form-control')) !!}

					@csrf
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label for="category" class="form-label"> Category</label>
								  {!! Form::select('category_id',$allCategory,$category_id, array('class' => 'form-control','placeholder'=>'--select category--', $required,'id'=>'category_id')) !!}
								@if ($errors->has('category_id'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('category_id') }}</strong>
								</span>
								@endif
							</div>
						</div>
					
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="form-label">SubCategory</label>
								 <select name="subcategory_id" id ="subcategory_id" class="form-control" required="required">
								 	@if(Request::segment(2)==='add-childcategory')
									<option value="" >--Select Subcategory--</option>
									 @else
									 @foreach($allSubCategory as $subcat)
										<option value="{{ $subcat->id }}" @if($subcat->id == $subcategory_id) selected @endif >{{ $subcat->name }}
										</option>
									 @endforeach
									 @endif
								</select>
								@if ($errors->has('subcategory_id'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('subcategory_id') }}</strong>
								</span>
								@endif
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label for="category" class="form-label">child Category</label>
								{!! Form::text('name',$name,array('id'=>'name','class'=> $errors->has('name') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>' name', 'autocomplete'=>'off', $required)) !!}
								@if ($errors->has('name'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
						</div>
						</div>

					<div class="col-xs-4 col-sm-4 col-md-4 text-centre">
						<div class="form-group">
							{!! Form::submit('Save', array('class'=>'btn btn-primary btn-block')) !!}

						</div>

					</div>
					{{ Form::close() }}
				</div>
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
					<h3 class="card-title ">Manage Child Category</h3>
					<div class="card-options">
                   
						<a class="btn btn-sm btn-outline-primary" href="{{route('add-childcategory')}}"> <i class="fa fa-plus"></i> Add Child Category</a>
						&nbsp;&nbsp;&nbsp;<a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
					</div>
				</div>
				{{ Form::open(array('route' => 'childcategory-action', 'class'=> 'form-horizontal', 'autocomplete'=>'off')) }}
				@csrf
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"></th>
									<th scope="col">#</th>
									<th scope="col">Category</th>            
									<th scope="col">Sub Category</th>            
									<th scope="col">child Category</th>            
									<th scope="col">Slug</th>                    
									<th scope="col">Status</th>                    
									<th scope="col"width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
								@if($childcategorylist!= '')
								<?php $i=1;?>
								@foreach($childcategorylist as $key=>$rows)
								<tr>
									<td>
		                                <label class="custom-control custom-checkbox">
		                                    {{ Form::checkbox('boxchecked[]', $rows->id,'', array('class' => 'colorinput-input custom-control-input', 'id'=>'')) }}
		                                    <span class="custom-control-label"></span>
		                                </label>
                        			</td>
									<td>{{ $i++ }}</td>
									<td>{!! $rows->category->name!!}</td>
									<td>{!! $rows->subCategory->name!!}</td>
									<td>{!! $rows->name!!}</td>
									<td>{!! $rows->slug !!}</td> 
									<td class="text-center">
		                                <div class="btn-group btn-group-xs ">
		                                    @if($rows->status=='0') 
		                                    <span class="text-danger">Inactive</span>
		                                    @else 
		                                    <span class="text-success">Active</span>
		                                    @endif
		                                </div>
		                            </td>
									<td>
										<div class="btn-group btn-group-xs">                   
											<a class="btn btn-sm btn-primary" href="{{ route('edit-childcategory',array('id'=>$rows->id)) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-sm btn-danger" href="{{ route('delete-childcategory',array('id'=>$rows->id)) }}" onClick="return confirm('Are you sure you want to delete this?');" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>

										</div>
									</td>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>
					</div>
					<div class="row div-margin">
	                <div class="col-md-3 col-sm-6 col-xs-6">
	                    <div class="input-group"> 
	                        <span class="input-group-addon">
	                            <i class="fa fa-hand-o-right"></i> </span> 
	                            {{ Form::select('cmbaction', array(
	                            ''              => 'Action', 
	                            'Active'        => 'Active',
	                            'Inactive'  => 'Inactive'), 
	                            '', array('class'=>'form-control','id'=>'cmbaction'))}} 
	                        </div>
	                    </div>
	                    <div class="col-md-8 col-sm-6 col-xs-6">
	                        <div class="input-group">
	                            <button type="submit" class="btn btn-danger pull-right" name="Action" onClick="return delrec(document.getElementById('cmbaction').value);">Apply</button>
	                        </div>
	                    </div>
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