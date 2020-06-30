<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CommonController extends Controller
{
    public function index()
    {
        return view('common.dashboard');
    }

}
