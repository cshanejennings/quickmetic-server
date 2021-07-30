<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
  use VerifiesEmails;

    public function register(Request $request) {

        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8']
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'type' => 'user',
            'password' => Hash::make($request->password)
        ]);
        // https://medium.com/@pran.81/b531608ecb99
        $user->sendApiEmailVerificationNotification();
        return array(
          'success' => true,
          'message' => 'Please confirm yourself by clicking on verify user button sent to you on your email.',
        );
    }
}
