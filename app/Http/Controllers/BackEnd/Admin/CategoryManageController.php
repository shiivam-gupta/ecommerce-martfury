<?php

namespace App\Http\Controllers\BackEnd\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Support\Str;
class CategoryManageController extends Controller
{
   	public function category()
	{
		
		$categoryList = Category::orderBy('id','desc')->get();
		return view('backend.pages.category.category',compact('categoryList'));
	}

	public function addCategory()
	{
		return view('backend.pages.category.category');	
	}


	public function editCategory($id)
	{
		$data = Category::where('id', $id)->first();
		return View('backend.pages.category.category',compact('data'));
	}


	public function saveCategory(Request $request)
	{  
		
		if($request->id != '')
		{  
			$rules['name'] = 'required|unique:categories,name,'.$request->id;
		} else {
			$rules['name'] = 'required|unique:categories,name';
            $rules['category_image'] = 'required|image|mimes:jpeg,jpg,png,jfif';
		}

		$validator = Validator::make($request->all(),$rules,
        [
            'category_image.required' => 'Please select Image',
    	]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		if(!empty($request->id)) {
			$category = Category::find($request->id);
		}
		else {
			$category  = new Category;
		}

		if(isset($request->category_image))
        {
            $imageName = '';
            $imageName = \Str::Random('6').time().'.'.$request->category_image->extension();
            $request->category_image->move(public_path('categories'), $imageName);
            $category_image = 'categories/'.$imageName;
			$category->category_image  = $category_image;      
        }

		$category->name  = $request->name;      
		$category->slug   = Str::slug($request->name); 
		$category->save();
		if(empty($request->id)) {
			return redirect()->route('category')->with('success','Category added successfully');
		}
		elseif(!empty($request->id)) {
			return redirect()->route('category')->with('success','Category updated successfully');
		}
	}

	public function deleteCategory($id)
	{
		$delCategory = Category::where('id', $id)->delete();
		return redirect()->route('category')->with('delete','Category deleted successfully');
	}

	public function categoryAction(Request $request)
    {
      	$data  = $request->all();
      	foreach($request->input('boxchecked') as $action)
      	{
          	if($request->input('cmbaction')=='Active')
          	{
              	Category::where('id', $action)->update(array('status' => '1'));
          	}
          	else
          	{
              	Category::where('id', $action)->update(array('status' => '0'));
          	}
      	}
      	return \Redirect()->back()->with('success', 'Action successfully done.');;
  	}

  	//====================subcategory=====================//

  	public function subCategory()
	{
		
		$subcategoryList = SubCategory::orderBy('id','desc')->get();
		return view('backend.pages.subcategory.subcategory',compact('subcategoryList'));
	}

	public function addSubCategory()
	{
		$allCategory = Category::where('status','1')->pluck('name','id')->all();
		return view('backend.pages.subcategory.subcategory',compact('allCategory'));	

	}
	public function editSubCategory($id)
	{
		$allCategory = Category::where('status','1')->pluck('name','id')->all();
		$data = SubCategory::where('id', $id)->first();
		return View('backend.pages.subcategory.subcategory',compact('data','allCategory'));
	}


	public function saveSubCategory(Request $request)
	{  
		
		if($request->id=='')
		{  
			$this->validate($request, [
				'category_id'  => 'required',   
				'name'  => 'required|unique:sub_categories',   
			]);

		}
		if(!empty($request->id)) {
			$subcategory = SubCategory::find($request->id);
		}
		else {
			$subcategory  = new SubCategory;
		}
		$subcategory->category_id  = $request->category_id;      
		$subcategory->name  = $request->name;      
		$subcategory->slug   = Str::slug($request->name); 
		$subcategory->save();
		if(empty($request->id)) {
			return redirect()->route('subcategory')->with('success','Sub Category added successfully');
		}
		elseif(!empty($request->id)) {
			return redirect()->route('subcategory')->with('success','Sub Category updated successfully');
		}
	}

	public function deleteSubCategory($id)
	{
		$delSubCategory = SubCategory::where('id', $id)->delete();
		return redirect()->route('subcategory')->with('delete','Sub Category deleted successfully');
	}

	public function subCategoryAction(Request $request)
    {
      	$data  = $request->all();
      	foreach($request->input('boxchecked') as $action)
      	{
          	if($request->input('cmbaction')=='Active')
          	{
              	SubCategory::where('id', $action)->update(array('status' => '1'));
          	}
          	else
          	{
              	SubCategory::where('id', $action)->update(array('status' => '0'));
          	}
      	}
      	return \Redirect()->back()->with('success', 'Action successfully done.');;
  	}
  	//================== Child Category========================//


  	public function childCategory()
	{
		
		$childcategorylist = ChildCategory::orderBy('id','desc')->get();
		return view('backend.pages.childcategory.childcategory',compact('childcategorylist'));
	}

	public function addChildCategory()
	{
		$allCategory = Category::where('status','1')->pluck('name','id')->all();
		$allSubCategory = SubCategory::where('status','1')->pluck('name','id')->all();
		return view('backend.pages.childcategory.childcategory',compact('allCategory','allSubCategory'));	

	}
	public function editChildCategory($id)
	{
		$allCategory = Category::where('status','1')->pluck('name','id')->all();
		$allSubCategory = SubCategory::where('status','1')->get();
		$data = ChildCategory::where('id', $id)->first();
		return View('backend.pages.childcategory.childcategory',compact('data','allCategory','allSubCategory'));
	}


	public function savechildCategory(Request $request)
	{  
		
		if($request->id=='')
		{  
			$this->validate($request, [
				'category_id'  => 'required',   
				'subcategory_id'  => 'required',   
				'name'  => 'required|unique:child_categories',   
			]);

		}
		if(!empty($request->id)) {
			$childcategory = ChildCategory::find($request->id);
		}
		else {
			$childcategory  = new ChildCategory;
		}
		$childcategory->category_id  = $request->category_id;      
		$childcategory->subcategory_id  = $request->subcategory_id;      
		$childcategory->name  = $request->name;      
		$childcategory->slug   = Str::slug($request->name); 
		$childcategory->save();
		if(empty($request->id)) {
			return redirect()->route('childcategory')->with('success','child Category added successfully');
		}
		elseif(!empty($request->id)) {
			return redirect()->route('childcategory')->with('success','child Category updated successfully');
		}
	}

	public function deleteChildCategory($id)
	{
		$delchildCategory = ChildCategory::where('id', $id)->delete();
		return redirect()->route('childcategory')->with('delete','child Category deleted successfully');
	}

	public function childCategoryAction(Request $request)
    {
      	$data  = $request->all();
      	foreach($request->input('boxchecked') as $action)
      	{
          	if($request->input('cmbaction')=='Active')
          	{
              	ChildCategory::where('id', $action)->update(array('status' => '1'));
          	}
          	else
          	{
              	ChildCategory::where('id', $action)->update(array('status' => '0'));
          	}
      	}
      	return \Redirect()->back()->with('success', 'Action successfully done.');;
  	}
  	public function getSubcategory(Request $request)
	{
		$getdata   = Subcategory::where('status','1')->where("category_id",$request->id)->pluck("name","id")->all();

        return response()->json($getdata);
	}
}
