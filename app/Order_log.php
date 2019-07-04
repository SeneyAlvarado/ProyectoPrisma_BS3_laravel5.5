<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of order log
 */
class Order_log extends Model
{
    public $timestamps = false;
    protected $fillable = ['date', 'attribute', 'value', 'order_id', 'order_id', 'user_id', 'user_id'];
}
