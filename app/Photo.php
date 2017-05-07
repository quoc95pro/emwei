<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'tbl_anh';
    public $timestamps = false;
    public function relatedGallery()
    {
        $this->belongsTo('App\Product');
    }
}
