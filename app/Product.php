<?php

namespace App;

use const false;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_sanpham';
    public $primaryKey =  'IDSanPham';

    public function photo()
    {
       return $this->hasMany('App\Photo','MaSanPham');
    }
    public $incrementing = false;
}
