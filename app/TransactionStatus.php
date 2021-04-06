<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
    public function puerchaseTransaction()
    {
        return $this->hasMany('App\puerchaseTransaction');
    }
}