<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserInvite extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data) {
        $this->subject = "You have been invited to use Text Waiting";
        $this->from_email = 'no-reply@relay.textwaiting.com';
        $this->from_name = env('APP_NAME');
        $this->token = $data['token'];
        $this->name = $data['name'];
        $this->company = $data['company'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
     public function build()
     {
         return $this->from($this->from_email, $this->from_name)
         ->subject($this->subject)
         ->view('email.invite-user')
         ->with([
             'token' => $this->token,
             'name' => $this->name,
             'company' => $this->company,
         ]);
     }
}
