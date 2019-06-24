<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State_work extends Model
{
    protected $table = 'state_work';
    protected $fillable = ['date', 'states_id', 'work_id', 'user_id'];
    public $timestamps = false;
}
