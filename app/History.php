<?php

namespace App;

use const false;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $timestamps = false;
    public $primaryKey =  'MaDonHang';
    protected $table = 'tbl_donhang';
    public $incrementing = false;
}
