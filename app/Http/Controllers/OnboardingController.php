<?php

namespace App\Http\Controllers;

use Snowfire\Beautymail\Beautymail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\OnBoard;
use App\Mail\OnBoardEmail;
use App\Models\Account;

class OnboardingController extends Controller
{

  public function schedule_call(Request $request) {

    $request->validate([
      'company_name' => ['required'],
      'phone_number' => ['required','regex:/\+1[0-9]{10}/'],
      'time' => ['required'],
    ]);

    $user = $request->user();
    $account = Account::updateOrCreate([
      'user_id' => $user->id,
      'notification_email' => $user->email,
      'email_incoming' => false,
      'email_outgoing' => false,
    ], [
      'company_name' => $request->input('company_name'),
      'phone_number' => $request->input('phone_number'),
    ]);

    $account->touch();

    $user->update(['account_id' => $account->id]);

    $mail = app()->make(Beautymail::class);



    $mail->send('email.callrequest', [
      'first_name'=> $user->first_name,
      'last_name'=> $user->last_name,
      'company_name' => $account->company_name,
      'email'=> $user->email,
      'phone_number' => $account->phone_number,
      'time' => $request->input('time')
    ], function($message) use (&$user) {
      $message
        ->from('no-reply@relay.textwaiting.com', env('APP_NAME'))
        ->to($user->email, $user->first_name . ' ' . $user->last_name)
        ->subject('You should be hearing from us soon!');
    });

    $mail->send('email.callaccount', [
      'first_name'=> $user->first_name,
      'last_name'=> $user->last_name,
      'company_name' => $account->company_name,
      'email'=> $user->email,
      'phone_number' => $account->phone_number,
      'time' => $request->input('time')
    ], function($message) use (&$user) {
      $message
        ->from('no-reply@relay.textwaiting.com', env('APP_NAME'))
        ->to(env('ADMIN_EMAIL'))
        ->subject('New Account Request from ' . $user->first_name . ' ' . $user->last_name);
    });

    return $user->get_full_profile();
  }

}
