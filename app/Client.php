<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['id', 'type', 'name', 'address', 'active_flag', 'identification'];
}
