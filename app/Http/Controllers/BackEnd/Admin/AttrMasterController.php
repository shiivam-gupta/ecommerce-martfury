<?php

namespace App\Http\Controllers\BackEnd\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeMaster;
use DataTables;

class AttrMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
    	if($request->ajax()){

            return DataTables::of(AttributeMaster::orderBy('id', 'DESC')->get())
	            ->addColumn('action', function ($data) {
	            	$btn ='';
	                if ($data->status == 'inactive') {
	                    $btn = '<input data-id="' . $data->id . '" data-status="active" class="changetype btn btn-primary btn-sm" type="button" data-onstyle="success" value="Active" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-url="'.\URL::to('admin/attr-master/status/'.$data->id).'" >';
	                } else if ($data->status == 'active') {
	                    $btn = '<input data-id="' . $data->id . '" data-status="inactive" class="changetype btn btn-primary btn-sm" type="button" data-onstyle="success" value="Inactive"   data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-url="'.\URL::to('admin/attr-master/status/'.$data->id).'">';
	                }
	                $btn .= '&nbsp;&nbsp&nbsp';
	                $btn .= '<a href="'.route('attr-master.edit', $data->id).'" class="btn btn-danger btn-sm fa fa-edit"></a>';
	                $btn .= '&nbsp;&nbsp&nbsp';
	                $btn .= '<a href="javascript:void(0);" class="btn btn-danger btn-sm fa fa-trash deleteData" data-url="'.\URL::to('admin/attr-master/'.$data->id).'" data-id="' . $data->id . '"></a>';
	                $btn .= '&nbsp;&nbsp;';
	                //$btn .= '<a style="margin:10px;" href="' . route('usersProfile', $data->id) . '" class="btn btn-warning fa fa-eye btn-sm"></a>';
	                return $btn;

	            })->addColumn('sn', function ($data) {
	            static $i = 1;
	            return $i++;
	        })->addColumn('name', function ($data) {
	            $name = $data->name;
	            if ($name) {
	                return ucfirst($name);
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

            ->rawColumns(['name','status', 'action'])
            ->make(true);
        }
        return view('backend.pages.attr-master.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.pages.attr-master.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:2|max:60|unique:attribute_master,name'
        ]);

        if ($validator->fails()) {
            return redirect(route('attr-master.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $input = $request->all();
        $id = '';
        AttributeMaster::UpdateOrCreate(['id' => $id],$input);

        return redirect(route('attr-master.index'))->with('success', 'Attribute Created successfully.');
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
     	$data['attrInfo'] = AttributeMaster::find($id);

        return view('backend.pages.attr-master.edit')->with($data);
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
            'name' => 'required|min:2|max:60|unique:attribute_master,name,'.$id
        ]);

        if ($validator->fails()) {
            return redirect(route('attr-master.edit', $id))
                        ->withErrors($validator)
                        ->withInput();
        }

        $input = $request->all();
        AttributeMaster::UpdateOrCreate(['id' => $id],$input);

        return redirect(route('attr-master.index'))->with('success', 'Attribute Data Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = AttributeMaster::find($id);
        $user->delete();
        if($user){
        	echo json_encode(['status' => 'success', 'code'=> 200]);
        } else {
        	echo json_encode(['status' => 'failure', 'code'=> 401]);
        }
    }

    public function changeStatus(Request $request, $id){

    	$user = AttributeMaster::find($id);
    	$user->update(['status' => $request->status]);
    	if($user){
        	echo json_encode(['status' => 'success', 'code'=> 200]);
        } else {
        	echo json_encode(['status' => 'failure', 'code'=> 401]);
        }
    }
}
