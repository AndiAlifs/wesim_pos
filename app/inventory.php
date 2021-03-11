<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('App\product');
    }
}
