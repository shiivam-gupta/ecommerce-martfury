<?php

namespace App\Http\Controllers\BackEnd\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
    	if($request->ajax()){

            return DataTables::of(User::role('Customer')->orderBy('id', 'DESC')->get())
	            ->addColumn('action', function ($data) {
	            	$btn ='';
	                if ($data->status == 'inactive') {
	                    $btn = '<input data-id="' . $data->id . '" data-status="active" class="changetype btn btn-primary btn-sm" type="button" data-onstyle="success" value="Active" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-url="'.\URL::to('admin/users/status/'.$data->id).'" >';
	                } else if ($data->status == 'active') {
	                    $btn = '<input data-id="' . $data->id . '" data-status="inactive" class="changetype btn btn-primary btn-sm" type="button" data-onstyle="success" value="Inactive"   data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-url="'.\URL::to('admin/users/status/'.$data->id).'">';
	                }
	                $btn .= '&nbsp;&nbsp&nbsp';
	                $btn .= '<a href="'.route('users.edit', $data->id).'" class="btn btn-danger btn-sm fa fa-edit"></a>';
	                $btn .= '&nbsp;&nbsp&nbsp';
	                $btn .= '<a href="javascript:void(0);" class="btn btn-danger btn-sm fa fa-trash deleteData" data-url="'.\URL::to('admin/users/'.$data->id).'" data-id="' . $data->id . '"></a>';
	                $btn .= '&nbsp;&nbsp;';

	                return $btn;

	            })->addColumn('sn', function ($data) {
	            static $i = 1;
	            return $i++;
	        })->addColumn('fullname', function ($data) {
	            $fullname = $data->fullname;
	            if ($fullname) {
	                return ucfirst($fullname);
	            } else {
	                return 'NA';
	            }
	        })->addColumn('email', function ($data) {
	            $email = $data->email;
	            if ($email) {
	                return $email;
	            } else {
	                return 'NA';
	            }
	        })->addColumn('phone_no', function ($data) {
	            $phone_no = $data->phone_no;
	            if ($phone_no) {
	                return $data->phone_code.$phone_no;
	            } else {
	                return 'NA';
	            }
	        })->addColumn('status', function ($data) {
	            $status = $data->status;
	            if ($status) {
	                return ucfirst($status);
	            } else {
	                return 'NA';
	            }
	        })

            ->rawColumns(['fullname','phone_no','status', 'action'])
            ->make(true);
        }
        return view('backend.pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $Request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    	$data = [];
     	$data['customerInfo'] = user::find($id);
     	$data['country'] = Country::get();

        return view('backend.pages.users.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {	
    	$validator = Validator::make($request->all(),[

            'fullname' => 'required|min:2|max:60',
            'phone_code' => 'required',
            'phone_no' => 'required|integer|min:1000000000|max:9999999999',
            'country_id' => 'required',
            'state_id' => 'required',
            'address' => 'required|min:2|max:200',
            'email' => 'required|unique:users,email,'.$id,
            'dob' => 'required|before:today',
            'pincode' => 'required|min:5|max:6',
            'profile_pic' => 'image|mimes:jpeg,jpg,png,jfif',
        ],
        [
        	'country_id.required' => 'Please select Country',
        	'state_id.required' => 'Please select State',
        	'phone_no.max' => 'Phone No. cannot be more than 10 digits.',
        	'phone_no.min' => 'Phone No. cannot be less than 10 digits.',

    	]);

        if ($validator->fails()) {
            return redirect(route('users.edit', $id))
                        ->withErrors($validator)
                        ->withInput();
        }
        $input = $request->all();
        
        if(isset($request->profile_pic)){
	        $imageName = time().'.'.$request->profile_pic->extension();
	        $request->profile_pic->move(public_path('Images'), $imageName);
	        $input['profile_pic'] = 'Images/'.$imageName;
        }
        
        User::UpdateOrCreate(['id' => $id],$input);

        return redirect(route('users.index'))->with('success', 'Customer Data Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        if($user){
        	echo json_encode(['status' => 'success', 'code'=> 200]);
        } else {
        	echo json_encode(['status' => 'failure', 'code'=> 401]);
        }
    }

    public function changeStatus(Request $request, $id){

    	$user = User::find($request->user_id);
    	$user->update(['status' => $request->status]);
    	if($user){
        	echo json_encode(['status' => 'success', 'code'=> 200]);
        } else {
        	echo json_encode(['status' => 'failure', 'code'=> 401]);
        }
    }
}
