<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistModels extends Model
{
    protected $table = 'wishlist';
	
    protected $fillable = ['product_id','user_id'];

    public function userDetails()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function wishlistProduct()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
