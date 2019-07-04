<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This class has the attributes of client email model
 */
class Email extends Model
{
    protected $fillable = ['email', 'active_flag', 'client_id'];
    public $timestamps = false;
}
