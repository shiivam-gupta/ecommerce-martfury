<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faqs;

class FaqsController extends Controller
{
    public function faqs()
    {
    	$faqs = Faqs::orderBy('id','desc')->get();
		return view('backend.cms.faqs',compact('faqs'));
    }

    public function addFaqs()
	{
		return view('backend.cms.faqs');	
	}

	public function editFaqs($id)
	{
		$faqs = Faqs::where('id', $id)->first();
		return View('backend.cms.faqs',compact('faqs'));
	}

    public function faqsSave(Request $request)
    {
    	$this->validate($request, [  
			'question' => 'required',    
			'answer' => 'required',    
		]);

		if($request->id != ''){
			$faqs = Faqs::find($request->id);
		 	$faqs->question = $request->question;
		 	$faqs->answer = $request->answer;
		 	$faqs->save();
		 	return redirect(route('admin.faqs'))->with('success', 'Faqs Updated successfully.');
		} else {
		 	$faqs = New Faqs;
		 	$faqs->question = $request->question;
		 	$faqs->answer = $request->answer;
		 	$faqs->save();
		 	return redirect(route('admin.faqs'))->with('success', 'Faqs Created successfully.');
		}
    }

    public function deleteFaqs($id)
	{
		$deleteFaqs = Faqs::where('id', $id)->delete();
		return redirect()->route('admin.faqs')->with('delete','Question deleted successfully');
	}

}
