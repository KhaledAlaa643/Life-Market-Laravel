<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Otp;

class resetPasswordNotification extends Notification
{
    use Queueable;

    public $message;
    public $subject;
    public $fromEmail;
    public $mailer;
    private $otp;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->message = 'Use the below code for reset your password';
        $this->subject = 'password resetting';
        $this->fromEmail = "test@gmail.com";
        $this->mailer = 'smtp';
        $this->otp = new Otp();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    /**
 * Get the mail representation of the notification.
 */
public function toMail($notifiable)
{
    $otpToken = mt_rand(100000, 999999);

    // Save the OTP and email in the database
    $this->otp->identifier = $notifiable->email;
    $this->otp->token = $otpToken;
    $this->otp->save();

    return (new MailMessage)
        ->subject($this->subject)
        ->greeting('Hello ' . $notifiable->first_name)
        ->line($this->message)
        ->line('code: ' . $this->otp->token);
}


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}
