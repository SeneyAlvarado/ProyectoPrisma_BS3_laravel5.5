<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{


    protected $fillable = ['name', 'lastname', 'second_lastname', 'username', 'email', 'branch_id', 'branch_id', 'type_id', 'type_id', 'active_flag'];

    public function user_types()
    {
        return $this->hasMany('App\User_type');
    }
}
