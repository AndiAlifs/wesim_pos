<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseTransaction extends Model
{
    protected $table = "purchase_Transactions";
    protected $fillable = ['transaction_number', 'status_id', 'user_id', 'supplier_id', 'pay_cost', 'total_price', 'transaction_date'];


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