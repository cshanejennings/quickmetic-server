<?php

use Illuminate\Database\Seeder;

use App\Models\Doctor;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
     public function run()
     {
          // if(env('SEED_ENVIRONMENT') === 'dev') {
          $this->call(UserSeeder::class);
          // $this->call(JaneTreatmentSeeder::class);
          // $this->call(JaneTreatmentLookupSeeder::class);
          // $this->call(JaneTreatmentCodeSeeder::class);
          //
          // function update_doctor_code($name, $code) {
          //      Doctor::where('name', $name)->get()->first()->update([
          //           'code' => $code,
          //      ]);
          // }
          //
          // update_doctor_code('Fiona McCulloch', 'FM');
          // update_doctor_code('Kelly Clinning', 'KC');
          // update_doctor_code('Samina Mitha', 'SM');
          // update_doctor_code('Erica Nikiforuk', 'EN');
          // }
     }
}
