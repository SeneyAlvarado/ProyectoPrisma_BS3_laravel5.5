<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'active_flag', 'descripcion', 'branch_id', 'branch_id'];
}
