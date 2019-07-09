<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class WorkAvailableNotification extends Notification
{
    use Queueable;

    protected $work_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($work_id)
    {
        $this->work_id = $work_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        //dd($notifiable);
        return [
            "notificationHour" => Carbon::now(new \DateTimeZone(('America/Costa_Rica')))->format('d/m/y H:i'),
            "message" => "El trabajo #" . $this->work_id . ' debe ser atendido',
        ];
    }
}
