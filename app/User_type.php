<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_type extends Model
{
    protected $fillable = ['name', 'description', 'active_flag'];
}
