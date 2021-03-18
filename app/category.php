<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "Categories";
    protected $fillable = ['name', 'description'];

    public $timestamps = false;

    public function Product()
    {
        return $this->belongsToMany('App\Product', 'product_categories', 'category_id', 'product_id');
    }

    public function productCategory()
    {
        return $this->belongsToMany('App\productCategory');
    }
}