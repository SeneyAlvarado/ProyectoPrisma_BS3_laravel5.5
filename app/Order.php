<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['entry_date', 'quotation_number', 'client_owner', 'client_contact', 
    'state_id', 'branch_id', 'coin_id', 'exchange_rate', 'total', 'advance_payment', 'active_flag'];
public $timestamps = false;


}
