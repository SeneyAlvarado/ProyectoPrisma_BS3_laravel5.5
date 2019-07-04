<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of work files
 */
class Works_file extends Model
{
    protected $fillable = ['name', 'size', 'extension', 'order_id', 'order_id', 'work_id', 'work_id', 'active_flag'];
    public $timestamps = false;
}
