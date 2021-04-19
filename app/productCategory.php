<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productCategory extends Model
{
    //
    public function Product()
    {
        return $this->belongsTo('App\Product');
    }
    public function Category()
    {
        return $this->belongsTo('App\Category');
    }
    public function inventory()
    {
        return $this->hasOne('App\inventory');
    }
}