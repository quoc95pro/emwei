<?php

namespace App;

use const false;
use Illuminate\Database\Eloquent\Model;

class Bill_Product extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_donhang_sanpham';
}
