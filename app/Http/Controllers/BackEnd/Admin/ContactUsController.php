<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contactus;
use DataTables;

class ContactUsController extends Controller
{
    public function contactus()
    {
    	return view('backend.pages.contactus.contactus');
    }

    public function contactusList(Request $request)
    {
        $contactus = Contactus::orderBy('id', 'DESC')->get();

        return DataTables::of($contactus)
        	// ->addColumn('action', function ($data) {
        	// 	$btn = '';
         //        $btn .= '<a style="margin:10px;" href="' . route('admin.contactus-edit',$data->id) . '" class="btn btn-warning fa fa-pencil btn-sm"></a>';
         //        $btn .= '&nbsp;&nbsp;';
         //        return $btn;
         //    })
            ->addColumn('sn', function ($data) {
                static $i = 1;
                return $i++;
            })->rawColumns(['action','sn'])->make(true);
    }

  //   public function contactusEdit($id)
  //   {
  //   	$contactEdit = Contactus::where('id',$id)->first();
  //   	return view('backend.pages.contactus.contactusedit',compact('contactEdit'));
  //   }

  //   public function contactusReply(Request $request,$id)
  //   {
  //   	$this->validate($request, [  
		// 	'fullname'   		=> 'required|min:2|max:60',    
		// 	'email'   => 'required|integer',    
		// 	'mobile'   => 'required',    
		// 	'ip_address'   => 'required',    
		// 	'address'   => 'required',    
		// 	'message'   => 'required',    
		// 	'reply'   => 'required',    
		// ]);

		// $contact = new Contactus;
	 // 	$contact->name = $request->fullname;
	 // 	$contact->email = $request->email;
	 // 	$contact->mobile = $request->mobile;
	 // 	$contact->ip_address = $request->ip_address;
	 // 	$contact->address = $request->address;
	 // 	$contact->message = $request->message;
	 // 	$contact->reply = $request->reply;
	 // 	$contact->save();

	 // 	if ($coupon->save()) {
	 		
	 // 	}
  //   }
}
