<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['client_name', 'date', 'phone', 'email', 'details', 'visitor_id', 'visitor_id', 'recepcionist_id', 'recepcionist_id', 'active_flag'];
}
