<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of physical client
 */
class Physical_client extends Model
{
    protected $fillable = ['lastname', 'second_lastname', 'client_id', 'client_id'];
    public $timestamps = false;
}
