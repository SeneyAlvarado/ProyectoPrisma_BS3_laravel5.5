<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of works
 */
class Work extends Model
{
    protected $fillable = ['priority', 'approximate_date', 'designer_date', 'print_date', 
    'post_production_date', 'drying_hours', 'observation', 'order_id', 
    'user_id', 'product_id', 'product_name', 'active_flag', 'entry_date', 'materials'];
    public $timestamps = false;
}
