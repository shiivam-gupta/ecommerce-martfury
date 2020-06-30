<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubCategory extends Model
{
    use Notifiable;
    use SoftDeletes;

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','slug','category_id','status'];

    

    public function parentCategory(){
    	return $this->hasOne('App\Models\Category','id','category_id');
    }

    public function getActiveChildCategory(){
        return $this->hasMany('App\Models\ChildCategory','subcategory_id','id')->where('status',1);
    }
}
