<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
          $table->id();

          $table->foreignId('user_id'); // account owner
          $table->string('phone_number')->nullable();
          $table->string('notification_email')->unique();
          $table->string('company_name')->nullable();

          $table->timestamps(0);
          $table->softDeletes('deleted_at', 0);
        });

        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('rate', 8, 2);
            $table->enum('currency', ['CAD', 'USD']);
            $table->enum('frequency', ['monthly', 'annual']);
            $table->timestamps();
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id');
            $table->foreignId('plan_id');
            $table->timestamp('renewal_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('plans');
        Schema::dropIfExists('subscriptions');
    }
}
