<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    public function Category()
    {
        return $this->belongsToMany('App\category', 'product_categories', 'product_id', 'category_id');
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

    public function selling()
    {
        return $this->belongsToMany('App\selling');
    }

    public function productCategory()
    {
        return $this->belongsToMany('App\productCategory');
    }

    public function prices()
    {
        return $this->hasMany('App\Price');
    }

    /**
     * Get all of the purchase for the product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchase()
    {
        return $this->hasMany(Purchase::class, 'product_id', 'id');
    }
}