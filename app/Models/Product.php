<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_sku','product_title','description','quantity','actual_price','discounted_price','category_id','subcategory_id','childcategory_id','brand_id', 'product_tax','status','slug','review_rate','total_review'];

    public function getBrand(){
    	return $this->hasOne('App\Models\Brand','id','brand_id');
    }

    public function getCategory(){
    	return $this->hasOne('App\Models\Category','id','category_id');
    }

    public function getSubCategory(){
        return $this->hasOne('App\Models\SubCategory','id','subcategory_id');
    }

    public function getChildCategory(){
        return $this->hasOne('App\Models\ChildCategory','id','childcategory_id');
    }

    public function getProductImages(){
        return $this->hasMany('App\Models\ProductImage','product_id','id');
    }

    public function getReviews(){
        return $this->hasOne('App\Models\Reviews','product_id','id');
    }
}
