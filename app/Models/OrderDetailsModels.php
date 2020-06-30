<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetailsModels extends Model
{
	protected $table = 'order_details';

    protected $fillable = ['user_id','order_id','product_id','quantity','product_price', 'total_amount'];

    public function userDetails()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function productDetails()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

    public function getOrderDetails()
    {
        return $this->hasOne('App\Models\OrderModels', 'id', 'order_id');
    }
}
