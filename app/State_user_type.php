<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of state user type
 */
class State_user_type extends Model
{
    protected $fillable = ['states_id', 'user_types_id', 'state_notification', 
    'active_flag', 'state_name', 'user_type_name', 'view_state', 'edit_state' ];

    public $timestamps = false;
}
