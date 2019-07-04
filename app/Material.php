<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This model class has the attributes of material
 */
class Material extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'active_flag', 'description', 'branch_id', 'branch_id'];
}
