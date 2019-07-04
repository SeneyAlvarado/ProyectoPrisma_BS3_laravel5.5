<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of work log
 */
class Works_log extends Model
{
    protected $fillable = ['date', 'attribute', 'value', 'work_id', 'work_id', 'user_id', 'user_id'];
    public $timestamps = false;
}
