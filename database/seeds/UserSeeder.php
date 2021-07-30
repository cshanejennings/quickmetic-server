<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

use App\User;
use App\Models\Account;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Trial;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $plan = Plan::create([
        'name' => "Beta Test Plan",
        'rate' => 0,
        'currency' => 'CAD',
        'frequency' => 'monthly'
      ]);

        $user = User::create([
          'first_name' =>env('ADMIN_FIRST_NAME'),
          'last_name' => env('ADMIN_LAST_NAME'),
          'email' => env('ADMIN_EMAIL'),
          'email_verified_at' => new DateTime(),
          'password' => bcrypt(env('ADMIN_PASSWORD')),
          'options' => json_encode([
            'type' => 'addition',
            'width' => 5,
            'height' => 8,
            'trial_time' => 300,
            'row_digits' => 2,
            'header_digits' => 1,
            ]),
        ]);

        $account = Account::create([
          'user_id' => $user->id,
          'notification_email'=> env('ADMIN_EMAIL'),
        ]);

        $user->update(['account_id' => $account->id]);

        $subscription = Subscription::create([
          'account_id'=> $account->id,
          'plan_id' => $plan->id,
          'renewal_date' => Carbon::now()->addMonths(1),
        ]);

        function make_trial($data) {
          $trial = Trial::create([
            'user_id' => $data->user_id,
            'type' => $data->type,
            'negatives' => 0,
            'width' => "5",
            'height' => "8",
            'trial_time' => 300,
            'row_digits' => "2",
            'header_digits' => "2",
            'elapsed_time' => $data->elapsed_time,
            'correct' => $data->correct,
            'percent' => floor(($data->correct / 40) * 100),
          ]);
          DB::table('trials')->where('id', $trial->id)->update([
              'created_at' => Carbon::now()->subDays($data->days_ago),
          ]);
        }
        $trial_data = (object) [
            'user_id' => $user->id,
            'type' => 'addition',
            'elapsed_time' => 120,
            'correct' => 30,
            'days_ago' => 3,
        ];

        function mod($data, $e, $c, $d) {
            $data->elapsed_time = $e;
            $data->correct = $c;
            $data->days_ago = $d;
            return $data;
        }

        $user = User::create([
          'first_name' =>env('CHILD_1_FIRST_NAME'),
          'last_name' => env('CHILD_1_LAST_NAME'),
          'account_id' => 1,
          'email' => env('CHILD_1_EMAIL'),
          'email_verified_at' => new DateTime(),
          'password' => bcrypt(env('CHILD_1_PASSWORD')),
          'options' => json_encode([
            'type' => 'addition',
            'width' => 5,
            'height' => 8,
            'trial_time' => 300,
            'row_digits' => 2,
            'header_digits' => 1,
            ]),
        ]);

        $user = User::create([
          'first_name' =>env('CHILD_2_FIRST_NAME'),
          'last_name' => env('CHILD_2_LAST_NAME'),
          'account_id' => 1,
          'email' => env('CHILD_2_EMAIL'),
          'email_verified_at' => new DateTime(),
          'password' => bcrypt(env('CHILD_2_PASSWORD')),
          'options' => json_encode([
            'type' => 'addition',
            'width' => 5,
            'height' => 8,
            'trial_time' => 300,
            'row_digits' => 2,
            'header_digits' => 1,
            ]),
        ]);


        // make_trial(mod($trial_data, 300, 15, 8));
        // make_trial(mod($trial_data, 293, 14, 8));
        // make_trial(mod($trial_data, 289, 17, 7));
        // make_trial(mod($trial_data, 283, 21, 7));
        // make_trial(mod($trial_data, 276, 24, 7));
        // make_trial(mod($trial_data, 282, 23, 6));
        // make_trial(mod($trial_data, 269, 27, 6));
        // make_trial(mod($trial_data, 272, 27, 5));
        // make_trial(mod($trial_data, 268, 28, 5));
        // make_trial(mod($trial_data, 273, 31, 5));
        // make_trial(mod($trial_data, 267, 31, 4));
        // make_trial(mod($trial_data, 270, 35, 4));
        // make_trial(mod($trial_data, 268, 39, 3));
        // make_trial(mod($trial_data, 256, 39, 3));
        // make_trial(mod($trial_data, 259, 40, 3));
        // make_trial(mod($trial_data, 258, 40, 3));
        // make_trial(mod($trial_data, 249, 40, 2));
        // make_trial(mod($trial_data, 235, 40, 2));
        // make_trial(mod($trial_data, 229, 38, 2));
        // make_trial(mod($trial_data, 237, 39, 1));
        // make_trial(mod($trial_data, 239, 40, 1));
        // make_trial(mod($trial_data, 237, 40, 1));
        // make_trial(mod($trial_data, 243, 40, 1));
        // make_trial(mod($trial_data, 243, 39, 1));
        // make_trial(mod($trial_data, 243, 40, 0));
        // make_trial(mod($trial_data, 251, 40, 0));
        // make_trial(mod($trial_data, 238, 40, 0));
        // make_trial(mod($trial_data, 223, 40, 0));

    }
}
