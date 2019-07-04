<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of order states
 */
class Order_state extends Model
{
    protected $fillable = ['name', 'description', 'active_flag'];
    public $timestamps = false;
}
