<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_state extends Model
{
    protected $fillable = ['name', 'description', 'active_flag'];
    public $timestamps = false;
}
