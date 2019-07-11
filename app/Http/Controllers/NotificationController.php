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

        DB::beginTransaction();
        
        //deletes the notification from database
        DatabaseNotification::where('id', $notification_id)->delete(); 
        
        DB::commit();

        return json_encode(["order_id"=> $order_id]);
    }

    public function deleteNotifications($idArray) {
        $decoded_id_array = json_decode($idArray);

        DB::beginTransaction();
        foreach ($decoded_id_array as $notification_id) {//deletes the notifications from database
            DatabaseNotification::where('id', $notification_id)->delete(); 
        }
        DB::commit();
        return json_encode(["success"=> "¡Éxito eliminando todas las notificaciones!"]);
    }
    
}
