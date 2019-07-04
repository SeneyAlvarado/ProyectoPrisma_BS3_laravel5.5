<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of states
 */
class State extends Model
{
    protected $fillable = ['name', 'description', 'active_flag'];
    public $timestamps = false;
}
