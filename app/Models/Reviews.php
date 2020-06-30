<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = 'reviews';
	
    protected $fillable = ['user_id','order_id','review_rate','comment'];

    public function usersDetails()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function orderDetails()
    {
        return $this->hasOne('App\Models\OrderDetailsModels', 'id', 'order_id');
    }
}
