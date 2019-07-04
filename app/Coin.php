<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This class has the attributes of coin model
 */
class Coin extends Model
{
    protected $fillable = ['name', 'active_flag'];
}
