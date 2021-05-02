<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellingTransaction extends Model
{
    protected $table = "selling_Transactions";
    protected $fillable = ['transaction_number', 'status_id', 'user_id', 'member_id'];


    public function member()
    {
        return $this->belongsTo('App\member');
    }
    public function transactionStatus()
    {
        return $this->belongsTo('App\TransactionStatus');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function sellings()
    {
        return $this->hasMany(Selling::class,'selling_transaction_id');
    }
}