<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reviews;
use DataTables;

class ReviewsController extends Controller
{
    public function reviews()
    {
    	return view('backend.pages.reviews.reviews');
    }

    public function reviewsList(Request $request)
    {
        $reviews = Reviews::with('usersDetails','orderDetails')->orderBy('id', 'DESC')->get();
        return DataTables::of($reviews)
            ->addColumn('sn', function ($data) {
                static $i = 1;
                return $i++;
            })->addColumn('user_id', function ($data) {
                $userDetails = $data->usersDetails->fullname;
                return $userDetails;
            })->addColumn('order_id', function ($data) {
                $orderDetails = $data->orderDetails->productDetails->product_title;
                return $orderDetails;
            })->rawColumns(['sn'])->make(true);
    }
}
