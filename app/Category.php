<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes; //tanpa tanda kurung

    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
}
