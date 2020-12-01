<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserNotification extends Notification
{
    use Queueable;

    public $message,$route,$image,$user,$androidMessage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($msg="",$route="",$image="",$user="",$anroidMessage=null)
    {
        //
        $this->user = $user;
        $this->route = $route;
        $this->message = $msg;
        $this->image = $image;
        $this->androidMessage= $anroidMessage;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
            'message' => $this->message,
            'action' => $this->route,
            'image' => $this->image,
            'user' => $this->user,
            'androidMessage' => $this->androidMessage
        ];
    }
}
