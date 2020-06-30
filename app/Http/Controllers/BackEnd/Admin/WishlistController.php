<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\WishlistModels;

class WishlistController extends Controller
{
    public function index()
    {
    	return view('backend.pages.wishlist.index');
    }

    public function wishList(Request $request)
    {
        $orders = WishlistModels::with('userDetails')->orderBy('id', 'DESC')->get();
    
        return DataTables::of($orders)
            ->addColumn('sn', function ($data) {
                static $i = 1;
                return $i++;
            })->addColumn('user_id', function ($data) {
                $name = $data->userDetails->fullname;
                return $name;
            })->addColumn('product_id', function ($data) {
                $product = $data->wishlistProduct->product_title;
                return $product;
            })->rawColumns(['sn'])->make(true);
    }
}
