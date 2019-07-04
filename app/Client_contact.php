<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This class has the attributes of contact client model
 */
class Client_contact extends Model
{
    protected $fillable = ['client_id', 'client_id', 'contact_id', 'contact_id', 'active_flag'];
    public $timestamps = false;
}
