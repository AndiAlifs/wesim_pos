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
}