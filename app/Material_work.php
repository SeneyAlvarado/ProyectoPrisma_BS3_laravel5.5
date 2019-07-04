<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of materials used in works
 */
class Material_work extends Model
{
    public $timestamps = false;
    protected $fillable = ['material_id', 'work_id'];
}
