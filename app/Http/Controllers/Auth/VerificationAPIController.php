<?php
namespace App\Http\Controllers\Auth;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

// https://medium.com/@pran.81/b531608ecb99
class VerificationApiController extends Controller
{
  use VerifiesEmails;
  public function show() {} // TODO: I don't think this needs to be here

  /**
  * Mark the authenticated user's email address as verified.
  *
  * @param \Illuminate\Http\Request $request
  * @return \Illuminate\Http\Response
  */
  public function verify(Request $request) {
    $user = User::where('id', $request->id)->get()->first();
    if (!$user) return response()->json('No such user', 404);
    $user->update([ 'email_verified_at' => Carbon::now() ]);
    return array(
      'success' => true,
      'message' => 'Your email has been verified! Please login using your user name and password.',
    );
  }

  /**
  * Resend the email verification notification.
  *
  * @param \Illuminate\Http\Request $request
  * @return \Illuminate\Http\Response
  */
  public function resend(Request $request)
  {
    if ($request->user()->hasVerifiedEmail()) {
      return response()->json('User already have verified email!', 422);
    }
    $request->user()->sendEmailVerificationNotification();
    return response()->json('The notification has been resubmitted');
  }
}
