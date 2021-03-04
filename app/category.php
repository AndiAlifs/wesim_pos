<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public $timestamps = false;

    public function Product()
    {
        return $this->belongsToMany('App\Product','product_categories','category_id','product_id');
    }

}
