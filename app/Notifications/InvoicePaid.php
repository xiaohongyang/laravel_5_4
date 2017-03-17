<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $notifiable->prefers_sms ? ['nexmo'] : ['mail', 'database'];
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
                    ->subject("测试主题")
                    ->greeting("你好!")
                    ->error()
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', \URL::to('notification'))
                    ->line('Thank you for using our application!')
                    ;

//        return (new MailMessage())->view('email.notification', ['title' => 'hello this\'s just a test!']);
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
            'user' => 'JackXiao' ,
            'content' => 'Hello Test'
        ];
    }

    public function toDatabase($notifiable){
        return [
            'user' => 'JackXiao' ,
            'content' => 'Hello Test For Database'
        ];
    }

    public function toBroadcast($notifiable){
        return new BroadcastMessage([
            'user' => 'JackXiao',
            'content' => 'Hello, Are you here?'
        ]);
    }

}
