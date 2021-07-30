<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Account;
use App\Models\QboToken;

use QuickBooksOnline\API\DataService\DataService;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware('auth:sanctum')->get('/user', 'UserAccountController@get_profile');
Route::middleware('auth:sanctum')->post('/user', 'UserAccountController@update_profile');
Route::middleware('auth:sanctum')->post('/user/password', 'UserAccountController@update_password');
Route::middleware('auth:sanctum')->post('/user/email', 'UserAccountController@update_email');

Route::middleware('auth:sanctum')->post('/account', 'UserAccountController@update_account');
Route::middleware('auth:sanctum')->post('/onboarding/schedule', 'OnboardingController@schedule_call');

Route::middleware('auth:sanctum')->get('/account/users', 'UserAccountController@get_account_users');
Route::middleware('auth:sanctum')->post('/account/invite-user', 'InvitationController@invite_user');
Route::middleware('auth:sanctum')->post('/account/resend-invite', 'InvitationController@resend_invite');
Route::middleware('auth:sanctum')->post('/account/delete-invite', 'InvitationController@delete_invite');

Route::post('/account/verify-invite', 'InvitationController@verify_invite');
Route::post('/account/accept-invite', 'InvitationController@accept_invite');

Route::post('/trial/get-all-trials', 'TrialController@get_all_trials');
Route::post('/trial/submit-trial-results', 'TrialController@submit_trial_results');

Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');
Route::get('/auth/google/url', 'Auth\GoogleLoginController@loginUrl');
Route::get('/auth/google/callback', 'Auth\GoogleLoginController@loginCallback');

Route::post('forgot-password', 'Auth\ForgotPasswordController@get_token');
Route::get('reset-password/{token}', 'Auth\ForgotPasswordController@test_token');
Route::post('reset-password/{token}', 'Auth\ForgotPasswordController@reset_password');

Route::post('/register', 'Auth\RegisterController@register');
Route::get('/email/verify/{id}', 'Auth\VerificationApiController@verify')->name('verificationapi.verify');
Route::get('/email/resend', 'Auth\VerificationApiController@resend')->name('verificationapi.resend');
