<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_order_state extends Model
{
    protected $fillable = ['date', 'order_states_id', 'order_id', 'user_id'];
    public $timestamps = false;

}
