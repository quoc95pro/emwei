<?php

namespace App;

use const false;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    public $primaryKey =  'Email';
    protected $table = 'tbl_khachhang';
    public $incrementing = false;
}
