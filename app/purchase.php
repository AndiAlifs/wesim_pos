<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['purchase_transaction_id', 'product_id', 'amount', 'price'];
    //
    public function product()
    {
        return $this->belongsTo('App\product');
    }
}