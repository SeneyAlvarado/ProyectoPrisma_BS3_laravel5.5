<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'active_flag', 'branch_id', 'branch_id'];
    public $timestamps = false;
}

