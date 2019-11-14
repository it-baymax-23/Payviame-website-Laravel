<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserInviteNotify extends Notification
{
    use Queueable;
    public $invited_user, $owner;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $invited_user, User $owner)
    {
        //
        $this->invited_user = $invited_user;
        $this->owner = $owner;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $invited_user = $this->invited_user;
        $owner = $this->owner;
        $password = 'payviame12345';

        return (new MailMessage)
            ->subject("New User Invite")
            ->greeting("Hello, " . $invited_user->name . "!")
            ->line("You invited to " . $owner->name)
            ->line("Your password : " . $password )
            ->line("Oops, Maybe your credentials are not safe. Change Your Password.")
            ->action('Login', route('login'))
            ->line('Thank you for using our website! If you face any problem feel free to contact us anytime.');
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
        ];
    }
}
