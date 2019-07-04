<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of product used in works
 */
class Product_work extends Model
{
    protected $fillable = ['product_id', 'product_id', 'work_id', 'work_id', 'active_flag'];
    public $timestamps = false;
}

