<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name', 'description', 'active_flag'];
    public $timestamps = false;
}
