<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of product
 */
class Product extends Model
{
    protected $fillable = ['name', 'description', 'active_flag', 'branch_id', 'branch_id'];
    public $timestamps = false;
}

