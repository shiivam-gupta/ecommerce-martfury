<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CouponlistModels;
class CouponModels extends Model
{
    protected $table = 'coupon_code';
	
    protected $fillable = ['title','coupon_number','type','percentage_amount','coupon_option'];

    public function couponlistModels(){
    	return $this->hasMany(CouponlistModels::class, 'coupon_code_id', 'id');
    }
}
