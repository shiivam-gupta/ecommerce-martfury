<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CouponModels;

class CouponlistModels extends Model
{
    protected $table = 'coupon_list';
	
    protected $fillable = ['coupon_code_id','coupon_code', 'is_used', 'used_by'];

    public function getCouponCode(){
    	return $this->belongsTo(CouponModels::class, 'coupon_code_id', 'id');
    }

    protected $casts = [
	    'used_by' => 'array'
	];

}
