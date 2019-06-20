<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State_user_type extends Model
{
    protected $fillable = ['states_id', 'user_types_id', 'state_notification', 
    'active_flag', 'state_name', 'user_type_name'];

    public $timestamps = false;
}
