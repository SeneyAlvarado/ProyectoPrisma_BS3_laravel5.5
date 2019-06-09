<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['priority', 'advance_payment', 'approximate_date', 'designer_date', 'print_date', 'post_production_date', 'drying_hours', 'observation', 'order_id', 'order_id', 'user_id', 'user_id', 'active_flag'];
    public $timestamps = false;
}
