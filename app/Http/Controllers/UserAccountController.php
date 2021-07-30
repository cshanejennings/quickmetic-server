<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Account;

class UserAccountController extends Controller
{
  public function get_profile(Request $request) {
    return $request->user()->get_full_profile();
  }

  public function update_profile(Request $request) {
    $request->user()->update([
      'first_name' => $request->input('first_name'),
      'last_name' => $request->input('last_name'),
    ]);
    return $request->user()->get_full_profile();
  }

  public function update_account(Request $request) {
    $request->user()->account->update([
      'company_name' => $request->input('company_name'),
      'email_incoming' => $request->input('email_incoming'),
      'email_outgoing' => $request->input('email_outgoing'),
    ]);
    return $request->user()->get_full_profile();
  }

  public function get_account_users(Request $request) {
      return $request->user()->account->get_member_list();
  }

  public function update_email(Request $request) {
    return $request->user()->get_full_profile();
  }

  public function item_lookup_info(Request $request) {
    return $request->user()->account->item_lookup_info();
  }

  public function update_password(Request $request) {
    return $request->user()->get_full_profile();
  }
}
