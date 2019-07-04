<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of phone
 */
class Phone extends Model
{
    protected $fillable = ['number', 'active_flag', 'client_id', 'client_id'];

    public $timestamps = false;
}
