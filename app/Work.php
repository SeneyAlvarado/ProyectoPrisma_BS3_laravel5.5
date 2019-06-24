<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['priority', 'approximate_date', 'designer_date', 'print_date', 'post_production_date', 'drying_hours', 'observation', 'order_id', 
    'user_id', 'product_id', 'active_flag', 'entry_date'];
    public $timestamps = false;
}
