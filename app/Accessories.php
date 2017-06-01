<?php

namespace App;

use const false;
use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_phukien';
    public $primaryKey =  'IDPhuKien';
    public $incrementing = false;
}
