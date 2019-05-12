<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    protected $table='TheLoai';
    // Với 1 thể loại nào đó 
    // có thể lấy được tất cả các loại tin thuộc thể loại này. 
    //? cho thể loại => hãy lấy tất cả loại tin thuộc thể loại này ! 
    public function loaitin(){
    	return $this->hasMany('App\LoaiTin','idTheLoai','id');
    }
    public function tintuc(){
    	return $this->hasManyThrough('App\TinTuc','App\LoaiTin','idTheLoai','idLoaiTin','id');
    }

}
