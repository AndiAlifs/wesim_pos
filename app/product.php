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

    /**
     * Get the inventory associated with the product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inventory()
    {
        return $this->hasOne('App\inventory');
    }
}
