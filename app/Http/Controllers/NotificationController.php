<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
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

    public function readNotification($notification_id, $work_id) {
        //gets the order of the work
        $work = \App\Work::where('id', $work_id)->first();
        $order_id = $work->order_id;

        //deletes the notification from database
        DatabaseNotification::where('id', $notification_id)->delete(); 

        return json_encode(["order_id"=> $order_id]);
    }
    
}
