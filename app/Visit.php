<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of visits
 */
class Visit extends Model
{
    protected $fillable = ['client_name', 'date', 'phone', 'email', 'details', 'visitor_id', 'recepcionist_id', 'active_flag'];
    public $timestamps = false;
}
