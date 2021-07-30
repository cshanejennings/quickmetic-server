<?php

namespace App\Notifications;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;

// These classes look related
// Illuminate\Auth\Notifications\VerifyEmail;
// Laravel\Ui\AuthRouteMethods;

// instead extend notification and manually create the email...
class VerifyApiEmail extends VerifyEmailBase
{

  /**
   * Build the mail representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {
      $verificationUrl = base64_encode($this->verificationUrl($notifiable));
      $client_url = env("APP_CLIENT_URL") . '/validate-email/'. $verificationUrl;

      if (static::$toMailCallback) {
          return call_user_func(static::$toMailCallback, $notifiable, $client_url);
      }

      return (new MailMessage)
          ->subject(Lang::get('Verify Email Address'))
          ->from('no-reply@relay.textwaiting.com', "Text Waiting Verfication")
          ->line(Lang::get('Please click the button below to verify your email address.'))
          ->action(Lang::get('Verify Email Address'), $client_url)
          ->line(Lang::get('If you did not create an account, no further action is required.'));
  }

  /**
  * Get the verification URL for the given notifiable.
  *
  * @param mixed $notifiable
  * @return string
  */
  protected function verificationUrl($notifiable)
  {
      $url = URL::temporarySignedRoute(
          'verificationapi.verify',
          Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
          [
              'id' => $notifiable->getKey(),
              'hash' => sha1($notifiable->getEmailForVerification()),
          ]
      );
      return $url;
  }
}
