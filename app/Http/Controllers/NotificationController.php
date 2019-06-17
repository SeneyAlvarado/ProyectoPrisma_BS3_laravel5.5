<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class NotificationController extends Controller
{
    
    public function getUserNotifications()
	{
        $unreadNotifications = auth()->user()->unreadNotifications->sortBy('created_at');
        //dd($unreadNotifications);
        //$disponibles = array();
        return json_encode(["unreadNotifications"=>$unreadNotifications]);
    }
    
}
