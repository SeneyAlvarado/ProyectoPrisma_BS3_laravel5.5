<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of user type
 */
class User_type extends Model
{
    protected $fillable = ['name', 'description', 'active_flag'];
    public $timestamps = false;
}
