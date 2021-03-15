<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class selling extends Model
{
    //
    protected $fillable = ['selling_transaction_id', 'product_id', 'amount', 'price'];

    public function product()
    {
        return $this->belongsTo('App\product');
    }
}