<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    protected $table='TinTuc';
    function comment(){
    	return $this->hasMany('App\Comment','idTinTuc','id');
    }
}
