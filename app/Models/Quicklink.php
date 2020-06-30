<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quicklink extends Model
{
    protected $table = 'quicklink';
	
    protected $fillable = ['quicklink_slug','title','subtitle','description','image'];
}
