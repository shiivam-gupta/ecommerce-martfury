<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\State;
use App\Models\City;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\OrderModels;
use App\Models\Product;
use App\Models\WishlistModels;
use App\Models\Reviews;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $orderCount = OrderModels::count();
        $pendingOrder = OrderModels::where('status','pending')->count();
        $deliveredOrder = OrderModels::where('status','delivered')->count();
        $confirmedOrder = OrderModels::where('status','confirmed')->count();
        $cancelledOrder = OrderModels::where('status','cancelled')->count();
        $cancelledOrder = OrderModels::where('status','cancelled')->count();
        $productCount = Product::count();
        $productActive = Product::where('status',1)->count();
        $productInActive = Product::where('status',0)->count();
        $wishCount = WishlistModels::count();
        $reviewCount = Reviews::count();
        
        return view('backend.pages.dashboard.dashboard',compact('orderCount','pendingOrder','deliveredOrder','confirmedOrder','cancelledOrder','productCount','productActive','productInActive','wishCount','reviewCount'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
        ? new Response('', 204)
        : redirect('/');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected function loggedOut(Request $request)
    {
        return redirect('/admin');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function showUsersDetaisl(Request $request)
    {
        return DataTables::of(User::with('userRoleDetails')->orderBy('id', 'DESC')->where('userType', '!=', 1)->get())
            ->addColumn('action', function ($data) {
                if ($data->blocked == 'yes') {
                    $btn = '<input data-id="' . $data->id . '" data-status="no" class="changeblocktype btn btn-primary btn-sm" type="button" data-onstyle="success" value="UnBlock" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" >';
                } else if ($data->blocked == 'no') {
                    $btn = '<input data-id="' . $data->id . '" data-status="yes" class="changeblocktype btn btn-primary btn-sm" type="button" data-onstyle="success" value="Block"   data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" >';
                }
                $btn .= '&nbsp;&nbsp&nbsp';
                $btn .= '<a href="javascript:void(0);" class="btn btn-danger btn-sm fa fa-trash deleteUsers" data-id="' . $data->id . '"></a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<a style="margin:10px;" href="' . route('usersProfile', $data->id) . '" class="btn btn-warning fa fa-eye btn-sm"></a>';
                if ($data->userType == 2) {
                    $btn .= '<a style="margin:10px;" href="javascript:void(0);" class="btn btn-sm btn-success changeRate" data-id="' . $data->id . '" data-charge="' . $data->consultation_charge . '">Change rates</a>';
                }
                return $btn;

            })->addColumn('sn', function ($data) {
            static $i = 1;
            return $i++;
        })->addColumn('userType', function ($data) {
            $usersType = $data->userRoleDetails->role;
            return $usersType;
        })->addColumn('consultation_charge', function ($data) {
            $charge = $data->consultation_charge;
            if ($charge) {
                return $charge;
            } else {
                return 'NA';
            }
        })->addColumn('profile_pic', function ($data) {
            if ($data->profile_pic) {
                $image = '<img src="' . asset("images/$data->profile_pic") . '" border="0" width="50" class="img-rounded" align="center" />';
                return $image;
            } else {
                return "N/A";
            }
        })
            ->rawColumns(['profile_pic', 'action'])
            ->make(true);
    }

    public function getState(Request $request){

        $data['state'] = State::where('country_id',$request->country_id)->get();
        $html = '';
        foreach ($data['state'] as $key => $value) {
            $html .= '<option value="'.$value->id.'" ';
            if($value->id == $request->state_id){
                $html .= 'selected'; 
            }
            $html .='>'.$value->name.'</option>';
        }

        echo json_encode(['html' => $html,'code' => 200]);

    }

    public function getCity(Request $request){
        $data['city'] = City::where('state_id',$request->state_id)->get();
        $html = '';
        foreach ($data['city'] as $key => $value) {
            $html .= '<option value="'.$value->id.'" ';
            if($value->id == $request->city_id){
                $html .= 'selected'; 
            }
            $html .='>'.$value->name.'</option>';
        }

        echo json_encode(['html' => $html,'code' => 200]);
    }

    public function getSubcat(Request $request){

        $data['subcat'] = SubCategory::where('category_id',$request->category_id)->get();
        $html = '<option value="">--Select--</option>';
        foreach ($data['subcat'] as $key => $value) {
            $html .= '<option value="'.$value->id.'" ';
            if($value->id == $request->subcat_id){
                $html .= 'selected'; 
            }
            $html .='>'.$value->name.'</option>';
        }

        echo json_encode(['html' => $html,'code' => 200]);

    }

    public function getChildcat(Request $request){
        $data['child'] = ChildCategory::where('subcategory_id',$request->subcat_id)->get();
        $html = '<option value="">--Select--</option>';
        foreach ($data['child'] as $key => $value) {
            $html .= '<option value="'.$value->id.'" ';
            if($value->id == $request->childcat_id){
                $html .= 'selected'; 
            }
            $html .='>'.$value->name.'</option>';
        }

        echo json_encode(['html' => $html,'code' => 200]);
    }

    public function usersProfile($id)
    {
        $usersDetails = User::where('id', $id)->first();
        return view('backEnd.usersprofile', compact('usersDetails'));
    }

    public function usersDelete($id)
    {
        $Users = User::find($id);
        $Users->delete($id);
    }

}
