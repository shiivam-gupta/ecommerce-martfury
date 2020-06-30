<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModels;
use DataTables;

class OrdersController extends Controller
{
    public function index()
    {
    	return view('backend.pages.orders.orders');
    }

    public function ordersList(Request $request)
    {
        $orders = OrderModels::with('userDetails')->orderBy('id', 'DESC')->get();
    
        return DataTables::of($orders)
            ->addColumn('action', function ($data) {
        		$btn = '';
                $btn .= '<a style="margin:10px;" href="' . route('admin.ordersDetails',$data->id) . '" class="btn btn-warning fa fa-eye btn-sm"></a>';
                $btn .= '&nbsp;&nbsp;';
                // $btn .= '<a href="javascript:void(0);" class="btn btn-danger btn-sm fa fa-trash delete" data-id="' . $data->id . '"></a>';
                return $btn;

            })->addColumn('sn', function ($data) {
                static $i = 1;
                return $i++;
            })->addColumn('user_id', function ($data) {
                $name = $data->userDetails->fullname;
                return $name;

            })->rawColumns(['action','sn'])->make(true);
    }

    public function ordersDetails(Request $request,$id)
    {
    	$orders = OrderModels::with('userDetails','ordersDetails')->where('id',$id)->first();
    	return view('backend.pages.orders.ordersdetails',compact('orders'));
    }

    public function ordersAction(Request $request)
    {
        $orders = OrderModels::find($request->id);
        $orders->status = $request->submit;
        $orders->save();
        return redirect(route('admin.ordersDetails',$request->id))->with('success','Order Status Updated successfully');
    }

    
}
