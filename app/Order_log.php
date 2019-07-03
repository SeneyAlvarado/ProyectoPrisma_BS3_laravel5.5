<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_log extends Model
{
    public $timestamps = false;
    protected $fillable = ['date', 'attribute', 'value', 'order_id', 'order_id', 'user_id', 'user_id'];
}
