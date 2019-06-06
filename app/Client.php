<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['type', 'name', 'lastname', 'second_lastname', 'address', 'active_flag', 'identification', 'phones', 'email', 'client_table_id'];


    public function phones()
    {
        return $this->hasMany('App\Phone');
    }

    public function emails()
    {
        return $this->hasMany('App\Email');
    }
}


