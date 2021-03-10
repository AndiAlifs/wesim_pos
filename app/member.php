<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    protected $table = "members";
    protected $fillable = ['name','phone','email','address','member_id','point'];
}
