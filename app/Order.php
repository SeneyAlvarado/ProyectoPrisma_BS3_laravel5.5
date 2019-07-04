<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of order
 */
class Order extends Model
{
    protected $fillable = ['entry_date', 'quotation_number', 'client_owner', 'client_contact', 
    'branch_id', 'coin_id', 'exchange_rate', 'total', 'advance_payment', 
    'last_order_state_id', 'active_flag', 'finished_percentage'];
public $timestamps = false;


}
