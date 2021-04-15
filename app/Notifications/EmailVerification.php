<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class EmailVerification extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            ->greeting('Hi ' . $notifiable->name . ',')
            ->line(Lang::get(' Thank you for creating an account. Please click the button below to verify your email address and activate your account. Use your email address to log in.'))
            ->action(
                Lang::get('Verify Email Address'),
                $this->verificationUrl($notifiable)
            );
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Date::now()->addHours(24),
            ['user' => $notifiable->getKey()]
        );
    }
}
