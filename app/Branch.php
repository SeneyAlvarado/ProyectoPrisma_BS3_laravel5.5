<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This class has the attributes of branch model
 */
class Branch extends Model
{
    protected $fillable = ['name', 'active_flag'];
    public $timestamps = false;
}
