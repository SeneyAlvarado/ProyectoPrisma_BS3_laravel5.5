<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of the table between order and states.
 */
class Order_order_state extends Model
{
    protected $fillable = ['date', 'order_states_id', 'order_id', 'user_id'];
    public $timestamps = false;

}
