<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\User;
use App\Models\Account;
use App\Models\Invitation;
use App\Mail\UserInvite;

class InvitationController extends Controller
{

  public function invite_user(Request $request) {
    $request->validate([
        'email' => ['required', 'email', 'unique:users', 'unique:invitations'],
    ]);
    $user = $request->user();
    $token = Str::random(60);
    Mail::to($request->input('email'))->send(new UserInvite([
        "token" => $token,
        "name" => $user->first_name . ' ' . $user->last_name,
        "company" => $user->account()->company_name
    ]));
    $invitation = Invitation::create([
      'account_id' => $request->user()->account_id,
      'email' => $request->input('email'),
      'token' => hash('sha256', $token),
    ]);
    return $request->user()->account->get_member_list();
  }

  public function resend_invite(Request $request) {
    $request->validate([
        'email' => ['required', 'email', 'unique:users', 'exists:invitations'],
    ]);
    $token = Str::random(60);
    Mail::to($request->input('email'))->send(new UserInvite([
        "token" => $token,
        "name" => $user->first_name . ' ' . $user->last_name,
        "company" => $user->account()->company_name
    ]));
    $invitation = Invitation::where('email', $request->input('email'))
      ->where('account_id', $request->user()->account_id)->get()->first();
    $invitation->update(['token' => hash('sha256', $token)]);
    return $request->user()->account->get_member_list();
  }

  public function delete_invite(Request $request) {
    $request->validate([
        'email' => ['required', 'email', 'exists:invitations'],
    ]);
    Invitation::where('email', $request->input('email'))->forceDelete();
    return $request->user()->account->get_member_list();
  }

  public function verify_invite(Request $request) {
    $request->validate([ 'token' => ['required'] ]);
    $invitation = Invitation::verify($request->input('token'));
    return $invitation;
  }

  public function accept_invite(Request $request) {
    $request->validate([
      'token' => ['required'],
      'first_name' => ['required'],
      'last_name' => ['required'],
      'password' => ['required'],
    ]);
    $invitation = Invitation::verify($request->input('token'));

    $user = User::create([
      'account_id' => $invitation->account_id,
      'first_name' => $request->input('first_name'),
      'last_name' => $request->input('last_name'),
      'email' => $invitation->email,
      'type' => 'user',
      'email_verified_at' => Carbon::now(),
      'password' => Hash::make($request->input('password'))
    ]);
    $invitation->delete();

    Auth::login($user);
    return $user->get_full_profile();
  }

}
