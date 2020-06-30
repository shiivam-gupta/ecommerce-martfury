@extends('backend.layouts.master')
@section('content')
@if(Request::segment(2)==='edit-product' || Request::segment(2)==='add-product')
	@if(Request::segment(2)==='add-product')
		<?php
		$id         = '';
		$product_title    	= '';
		$category_id    	= '';
		$subcategory_id    	= '';
		$childcategory_id    	= '';
		$product_sku    	= '';
		$description    	= '';
		$product_tax    	= '';
		$actual_price    	= '';
		$discounted_price    	= '';
		$brand_id    	= '';
		$quantity    	= '';
		$category_list    	 = $categoryList;
		$brand_list   	= $brandList;
		$product_images   	= [];
		$required   = 'required';
		?>
	@else
		<?php
		$id          = $data->id;
		$product_title    	 = $data->product_title;
		$category_id    	 = $data->category_id;
		$subcategory_id    	 = $data->subcategory_id;
		$childcategory_id    	 = $data->childcategory_id;
		$product_sku    	 = $data->product_sku;
		$description    	= $data->description;
		$product_tax    	= $data->product_tax;
		$actual_price    	= $data->actual_price;
		$discounted_price    	= $data->discounted_price;
		$quantity    		= $data->quantity;
		$brand_id    		= $data->brand_id;
		$category_list    	 = $categoryList;
		$brand_list   		= $brandList;
		$product_images   	= $data->getProductImages;
		$required    = '';
		?>
	@endif
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">
						@if(Request::segment(2)==='add-product')
						Add
						@else
						Edit
						@endif
						Product
					</h3>
					<div class="card-options">

					</div>
				</div>
				<div class="card-body">
					{{ Form::open(array('route' => 'save-product', 'class'=> 'form-horizontal','enctype'=>'multipart/form-data','files'=>true)) }}
					{!! Form::hidden('id',$id,array('class'=>'form-control')) !!}

					@csrf
					<div class="row">
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Product Name</label>
								{!! Form::text('product_title',$product_title,array('id'=>'product_title','class'=> $errors->has('product_title') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Product  Title', 'autocomplete'=>'off', $required)) !!}
								@if ($errors->has('product_title'))
                                    <span class="text-danger">{{ $errors->first('product_title') }}</span>
                                @endif
							</div>
							{!! Form::hidden('categoryName',$category_id,array('id'=>'categoryName','class'=>'form-control')) !!}
							{!! Form::hidden('subcategoryName',$subcategory_id,array('id'=>'subcategoryName','class'=>'form-control')) !!}
							{!! Form::hidden('childcategoryName',$childcategory_id,array('id'=>'childcategoryName','class'=>'form-control')) !!}
							
							
							<div class="form-group">
								<label class="form-label">Product SKU</label>
								{!! Form::text('product_sku',$product_sku,array('id'=>'product_sku','class'=> $errors->has('product_sku') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Product SKU', 'autocomplete'=>'off', $required)) !!}
							
								@if ($errors->has('product_sku'))
                                    <span class="text-danger">{{ $errors->first('product_sku') }}</span>
                                @endif
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="form-label">Category</label>
										{!!Form::select('category_id', $category_list, $category_id, ['class' => 'form-control category_id', 'onchange'=>'getSubCategory(this)'])!!}

										
										@if ($errors->has('category_id'))
                                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                        @endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="form-label">Sub Category</label>
										{{-- <select class="form-control select2-show-search state-box" onchange="getCity(this)" name="state_id" data-placeholder="Choose one (with searchbox)"> --}}
										{!!Form::select('subcategory_id', [], $subcategory_id, ['class' => 'form-control subcat-box', 'onchange'=>'getChildCategory(this)'])!!}
										
										@if ($errors->has('subcategory_id'))
                                            <span class="text-danger">{{ $errors->first('subcategory_id') }}</span>
                                        @endif
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label class="form-label">Child Category</label>
										{{-- <select class="form-control select2-show-search city-box" name="city_id" data-placeholder="Choose one (with searchbox)">
											
										</select> --}}
										{!!Form::select('childcategory_id', [], $childcategory_id, ['class' => 'form-control childcat-box'])!!}
										@if ($errors->has('childcategory_id'))
                                            <span class="text-danger">{{ $errors->first('childcategory_id') }}</span>
                                        @endif
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="form-label">Product Tax</label>
								{!! Form::text('product_tax',$product_tax,array('id'=>'product_tax','class'=> $errors->has('product_tax') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Product Tax', 'autocomplete'=>'off', $required)) !!}
							
								@if ($errors->has('product_tax'))
                                    <span class="text-danger">{{ $errors->first('product_tax') }}</span>
                                @endif
							</div>
							
							<div class="form-group">
								<label class="form-label">Product Description</label>
								{!! Form::textarea('description',$description,array('id'=>'description','class'=> $errors->has('description') ? 'form-control is-invalid state-invalid ckeditor' : 'form-control ckeditor', 'placeholder'=>'Product SKU', 'autocomplete'=>'off', $required)) !!}
							
								@if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
							</div>
							
						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label class="form-label">Quantity</label>
								{!! Form::number('quantity',$quantity,array('id'=>'quantity','class'=> $errors->has('quantity') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Quantity', 'autocomplete'=>'off', $required)) !!}
								
								@if ($errors->has('quantity'))
                                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                @endif
							</div>

							<div class="form-group">
								<label class="form-label">Price</label>
								{!! Form::text('actual_price',$actual_price,array('id'=>'actual_price','class'=> $errors->has('actual_price') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Price', 'autocomplete'=>'off', $required)) !!}
								
								@if ($errors->has('actual_price'))
                                    <span class="text-danger">{{ $errors->first('actual_price') }}</span>
                                @endif
							</div>

							<div class="form-group">
								<label class="form-label">Discounted Price</label>
								{!! Form::text('discounted_price',$discounted_price,array('id'=>'discounted_price','class'=> $errors->has('discounted_price') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Discounted Price', 'autocomplete'=>'off', $required)) !!}
								
								@if ($errors->has('discounted_price'))
                                    <span class="text-danger">{{ $errors->first('discounted_price') }}</span>
                                @endif
							</div>

							<div class="form-group">
								<label class="form-label">Brands</label>
									{!!Form::select('brand_id', $brand_list, $brand_id, ['class' => 'form-control'])!!}
								@if ($errors->has('brand_id'))
                                    <span class="text-danger">{{ $errors->first('brand_id') }}</span>
                                @endif
							</div>
							@if(count($product_images) > 0)
								<div class="form-group">
									<label class="form-label"></label>
									@foreach($product_images as $key => $val)
									<div class="all-img">
										<input type="hidden" name="oldImages[]" value="{{ asset($val->product_image) }}">
										<img src="{{ asset($val->product_image) }}" alt="{{ $product_title.$key }}" class="previewImg" height="100px" width="100px">
										<a href="javascript:void(0)" class="removeImg" data-url="{{ route('delete-product-image',array('id'=>$val->id)) }}" data-id="{{ $val->id }}">Remove</a>
									</div>
									@endforeach
								</div>
							@endif
							<div class="row">
								<div class="col-md-8 product-image">
									<label class="form-label">Product Image</label>
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<input type="file" class="allImage" name="images[]" accept="image/*" maxlength="50" accept=".png, .jpg, .jpeg" >
												@if ($errors->has('images'))
				                                    <span class="text-danger">{{ $errors->first('images') }}</span>
				                                @endif
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<a href="javascript:void(0)" class="btn btn-primary add-more btn-block">Add More Images</a>
									</div>
								</div>
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
	{{-- </div> --}}
@else
	<div class="row">
		<div class="col-12">
			<div class="table-responsive">

				<div class="card">
					<div class="card-header">
						<h3 class="card-title "><b>Manage Product</b></h3>
						<div class="card-options">
	                   
							<a class="btn btn-sm btn-outline-primary" href="{{route('add-product')}}"> <i class="fa fa-plus"></i> Add Product</a>
							&nbsp;&nbsp;&nbsp;<a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
						</div>
					</div>
					{{ Form::open(array('route' => 'product-action', 'class'=> 'form-horizontal', 'autocomplete'=>'off')) }}
					@csrf
					<div class="card-body">
						<div class="table-responsive">
							<table id="usersDetails" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th scope="col"></th>
										<th scope="col">Sn</th>
										<th scope="col">Product</th>                  
										<th scope="col">Quantity</th>                    
										<th scope="col">Brands</th>                    
										<th scope="col">Category</th>                   
										<th scope="col">Price</th>                    
										<th scope="col">Discounted Price</th>                    
										<th scope="col">Status</th>                    
										<th scope="col"width="10%">Action</th>
									</tr>
								</thead>
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
<script type="text/javascript">
	$(document).ready(function() {
		oTable = $('#usersDetails').DataTable({
			"processing": true,
			"serverSide": true,
			ajax: {
				url: '{{ URL::to('admin/product-list') }}',
			},
			"columns": [

				{data: '#', name: '#'},
				{data: 'sn', name: 'sn'},
				{data: 'product_title', name: 'product_title'},
				{data: 'quantity', name: 'quantity'},
				{data: 'brand', name: 'brand'},
				{data: 'category', name: 'category'},
				{data: 'price', name: 'price'},
				{data: 'd_price', name: 'd_price'},
				{data: 'status', name: 'status'},
				{data: 'action', name: 'action',className:'noPrint', orderable: false},

			]
		});

		var e = [];
		e['value'] = $('.category_id').val();
		getSubCategory(e);

	});

	function getSubCategory(e){
		var category_id = e ? e.value : $('#categoryName').val();
		var oldSubcat = "{{ old('subcategory_id') }}";
		var subcat_id = oldSubcat ? oldSubcat : $('#subcategoryName').val();
		$.ajax({
			type: "GET",
			dataType: "json",
			url: "{{route('admin.getsubcat')}}",
			data: {'category_id': category_id, 'subcat_id': subcat_id},
			success: function(data){
				$('.subcat-box').html(data.html);
				var subcat = [];
				subcat['value'] = $('.subcat-box').val();
				getChildCategory(subcat);
				if(e){
					$('.childcat-box').html('');
				}
			}
		});
	}
	
	function getChildCategory(e){
		var subcat_id =  e ? e.value : $('#subcategoryName').val();
		var oldChildcat = "{{ old('childcategory_id') }}";
		var childcat_id = oldChildcat ? oldChildcat : $('#childcategoryName').val();
		$.ajax({
			type: "GET",
			dataType: "json",
			url: "{{route('admin.getchildcat')}}",
			data: {'subcat_id': subcat_id, 'childcat_id': childcat_id},
			success: function(data){
				 $('.childcat-box').html(data.html);
			}
		});
	}


</script>
@endsection