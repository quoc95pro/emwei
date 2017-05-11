<?php

namespace App;

use const false;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_lichsugiaodich';
}
