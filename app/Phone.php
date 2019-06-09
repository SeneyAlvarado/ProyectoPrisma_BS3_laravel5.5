<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = ['number', 'active_flag', 'client_id', 'client_id'];

    public $timestamps = false;
}
