<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * This model class has the attributes of users
 */
class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = ['name', 'lastname', 'second_lastname', 'username', 'password', 'email', 'branch_id', 'branch_id', 'type_id', 'type_id', 'active_flag'];
    public $timestamps = false;

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
