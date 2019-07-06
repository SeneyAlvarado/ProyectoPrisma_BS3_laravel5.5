<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of work files
 */
class Works_file extends Model
{
    protected $fillable = ['name', 'size', 'work_id', 'active_flag'];
    public $timestamps = false;
}
