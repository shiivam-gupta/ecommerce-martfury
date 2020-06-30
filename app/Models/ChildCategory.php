<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Category;
use App\Models\SubCategory;
class ChildCategory extends Model
{
    use Notifiable;
    use SoftDeletes;
   
    protected $fillable = ['name','slug','category_id','subcategory_id','status'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCategory(){
         return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }

}
