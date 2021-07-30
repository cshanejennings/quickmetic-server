<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrialController extends Controller
{
  public function get_all_trials(Request $request) {
    return $request->user()->trials;
  }

  public function submit_trial_results(Request $request) {
    $user = $request->user();
    $trial_data = $request->input('trial');
    return $user->add_trial($trial_data);
  }
}
