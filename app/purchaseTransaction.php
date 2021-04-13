<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseTransaction extends Model
{
    public function transactionStatus()
    {
        return $this->belongsTo('App\TransactionStatus');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class,'purchase_transaction_id');
    }
}