<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\QboToken;

class IntuitLoginController extends Controller
{

  public function loginUrl(Request $request) {
    return QboToken::get_login_url();
  }

  public function loginCallback(Request $request) {
    $user = $request->user();
    QboToken::get_token($user->account->id, $request->input('code'), $request->input('realmId'));
    return $request->user()->get_full_profile();
  }

  public function directLoginCallback(Request $request, $account_id) {
    QboToken::get_token($account_id, $request->input('code'), $request->input('realmId'));
    // return [
    //   'code' => $request->input('code'),
    //   'account_id' => $account_id,
    //   'realmId' => $request->input('realmId'),
    // ];
    return redirect('http://localhost:3000/');
  }
}
