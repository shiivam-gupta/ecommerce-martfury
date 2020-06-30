<?php

namespace App\Http\Controllers\BackEnd\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use DataTables;

class ProductManageController extends Controller
{
   	public function product()
	{
		return view('backend.product');
	}

	public function productList()
	{
		return DataTables::of(Product::with('getBrand','getCategory')->orderBy('id', 'DESC')->get())
			->addColumn('#', function ($data) {
				$btn ='';
				$btn = '<td><label class="custom-control custom-checkbox"><input class="colorinput-input custom-control-input" id="" name="boxchecked[]" type="checkbox" value="'.$data->id.'"><span class="custom-control-label"></span></label></td>';
				return $btn;
    		})->addColumn('action', function ($data) {
            	$btn ='';

                $btn .= '<a href="'.route('edit-product', $data->id).'" class="btn btn-danger btn-sm fa fa-edit"></a>';
                $btn .= '&nbsp;&nbsp&nbsp';
                $btn .= '<a class="btn btn-sm btn-danger" href="'.route('delete-product',array('id'=>$data->id)).'" onClick="return confirm(\'Are you sure you want to delete this?\');" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>';
                $btn .= '&nbsp;&nbsp;';
                return $btn;

            })->addColumn('sn', function ($data) {
            static $i = 1;
            return $i++;
        })->addColumn('product_title', function ($data) {
            $product_title = $data->product_title;
            if ($product_title) {
                return ucfirst($product_title);
            } else {
                return 'NA';
            }
        })->addColumn('quantity', function ($data) {
            $quantity = $data->quantity;
            if ($quantity) {
                return $quantity;
            } else {
                return 'NA';
            }
        })->addColumn('category', function ($data) {
            $category = $data->getCategory->name;
            if ($category) {
                return $category;
            } else {
                return 'NA';
            }
        })->addColumn('price', function ($data) {
            $price = $data->price;
            if ($price) {
                return $price;
            } else {
                return '0.00';
            }
        })->addColumn('d_price', function ($data) {
            $d_price = $data->d_price;
            if ($d_price) {
                return $d_price;
            } else {
                return '0.00';
            }
        })->addColumn('brand', function ($data) {
            $brand = $data->getBrand->name;
            if ($brand) {
                return $brand;
            } else {
                return 'NA';
            }
        })
        ->addColumn('status', function ($data) {
            $status = $data->status;

            $btn = '<div class="btn-group btn-group-xs ">';
                if($data->status == '0') 
            $btn .='<span class="text-danger">Inactive</span>';
                else 
            $btn .='<span class="text-success">Active</span>';

            $btn .='</div>';
            return $btn;
        })

        ->rawColumns(['product_title','quantity','category','price','d_price','brand','#','status', 'action'])
        ->make(true);
	}

	public function addProduct()
	{
		$data = [];
		$brandList = Brand::where('status',ACTIVE)->pluck('name', 'id');
		$brandList->prepend('--Select--', '');
		$categoryList = Category::where('status','1')->pluck('name', 'id');
		$categoryList->prepend('--Select--', '');
		return view('backend.product',compact('brandList','categoryList'));	
	}


	public function editProduct($id)
	{
		$data = [];
		$data = Product::where('id', $id)->first();
		$brandList = Brand::where('status',ACTIVE)->pluck('name', 'id');
		$categoryList = Category::where('status','1')->pluck('name', 'id');
		return View('backend.product',compact('data','brandList','categoryList'));
	}


	public function saveProduct(Request $request)
	{  
		$rules = [
            'product_title' => 'required|min:2|max:60',
            'category_id' => 'required',
            'description' => 'required|min:2',
            'product_tax' => 'numeric|min:0|max:100',
            'quantity' => 'required|integer|min:1|max:1000',
            'actual_price' => 'required|numeric|min:0|gt:discounted_price',
            'discounted_price' => 'required|numeric|min:0',
            'brand_id' => 'required'
        ];

		if($request->id != '')
		{  
			$rules['product_sku'] = 'required|unique:products,product_sku,'.$request->id;
		} else {
			$rules['product_sku'] = 'required|unique:products,product_sku';
            $rules['images'] = 'required';
		}

		$validator = Validator::make($request->all(),$rules,
        [
        	'category_id.required' => 'Please select Category',
            'images.required' => 'Please select Image',
    	]);

        $validator->after(function($validator) use($request) {
            if($request->id != ''){
                if(!isset($request->oldImages) && !isset($request->images)){
                    $validator->errors()->add('images', 'Please select Image.');
                }
            }

        });

        if ($validator->fails()) {
            return redirect($request->id ? route('edit-product', $request->id) : route('add-product'))
                ->withErrors($validator)
                ->withInput();
        }

		if(!empty($request->id)) {
			$product = Product::find($request->id);
		} else {
			$product  = new Product;
		}
		$product->product_title  = $request->product_title;      
		$product->product_sku  = $request->product_sku;      
		$product->category_id  = $request->category_id;      
		$product->subcategory_id  = $request->subcategory_id;      
		$product->childcategory_id  = $request->childcategory_id;      
		$product->description  = $request->description;      
        $product->product_tax  = $request->product_tax;      
		$product->quantity  = $request->quantity;      
		$product->actual_price   = $request->actual_price; 
		$product->discounted_price   = $request->discounted_price; 
		$product->brand_id   = $request->brand_id; 
        $product->slug   = Str::slug($request->product_title); 
		$product->save();

        if(isset($request->images))
        {
            foreach ($request->images as $key => $value) {
                $imageName = '';
                $imageName = \Str::Random('6').time().'.'.$value->extension();
                $value->move(public_path('products'), $imageName);
                $product_image = 'products/'.$imageName;
                $newProd = new ProductImage();
                $newProd->product_id   = $product->id; 
                $newProd->product_image   = $product_image; 
                $newProd->save();
            }
        }

		if(empty($request->id)) {
			return redirect()->route('product')->with('success','Product added successfully');
		} elseif(!empty($request->id)) {
			return redirect()->route('product')->with('success','Product updated successfully');
		}
	}

	public function deleteProduct($id)
	{
		$delCategory = Product::where('id', $id)->delete();
		return redirect()->route('product')->with('delete','Product deleted successfully');
	}

	public function productAction(Request $request)
    {
      	$data  = $request->all();
      	foreach($request->input('boxchecked') as $action)
      	{
          	if($request->input('cmbaction') == 'Active')
          	{
              	Product::where('id', $action)->update(array('status' => '1'));
          	}
          	else
          	{
              	Product::where('id', $action)->update(array('status' => '0'));
          	}
      	}
      	return \Redirect()->back()->with('success', 'Action successfully done.');;
  	}

    public function deleteProductImage($id)
    {
        $image = ProductImage::find($id);
        if(basename($image->product_image)!= 'default.jpg')
        {
            unlink($image->product_image);
        }
        $delCategory = ProductImage::where('id', $id)->delete();
        echo json_encode(['status' => 200, 'message' => 'success']);
    }

}
