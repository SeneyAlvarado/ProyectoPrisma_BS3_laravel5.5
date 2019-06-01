<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['type', 'name', 'address', 'active_flag', 'identification'];
}
