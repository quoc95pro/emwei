<?php

namespace App;

use const false;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps =false;
    protected $table = 'tbl_admin';
}
