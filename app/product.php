<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    public function Category()
    {
        return $this->belongsToMany('App\category','product_categories','product_id','category_id');
    }
}
