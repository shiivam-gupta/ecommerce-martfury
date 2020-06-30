<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BelowBannerContent extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'below_banner_content';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','content','image_icon','status'];

}
