<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This class has the attributes of clients
 */
class Client extends Model
{
    protected $fillable = ['type', 'name', 'lastname', 'second_lastname', 'address', 'active_flag', 'identification', 'phones', 'email', 'client_table_id'];
    public $timestamps = false;

    public function phones()
    {
        return $this->hasMany('App\Phone');
    }

    public function emails()
    {
        return $this->hasMany('App\Email');
    }
}


