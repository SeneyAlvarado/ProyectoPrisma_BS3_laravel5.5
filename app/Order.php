<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['entry_date', 'approximate_date', 'quotation_number', 'client_owner', 'client_owner', 'client_contact', 'client_contact', '
state_id', '
state_id', 'branch_id', 'branch_id', 'active_flag'];
public $timestamps = false;
}
