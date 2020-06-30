<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;
    use SoftDeletes;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','slug','category_image','status'];

    public function getSubcategory(){
    	return $this->hasMany('App\Models\SubCategory');
    }

    public function getActiveSubcategory(){
        return $this->hasMany('App\Models\SubCategory')->where('status',1);
    }
}
