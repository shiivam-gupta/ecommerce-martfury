<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModels extends Model
{
    protected $table = 'orders';
	
    protected $fillable = ['user_id','first_name','last_name','email','phone','country','state','city','address','additional_note','currency_id', 'coupon_code','payby','transaction_id', 'payment_status','subtotal','total_discount','total_tax', 'total', 'status'];

    public function userDetails()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function ordersDetails()
    {
        return $this->hasMany('App\Models\OrderDetailsModels', 'order_id', 'id');
    }
}
