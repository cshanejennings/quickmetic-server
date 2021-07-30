<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->enum('type', ['addition', 'subtraction', 'multiplication', 'division']);
            $table->boolean('negatives')->nullable()->default(0);
            $table->enum('width', [3, 4, 5])->default(5);
            $table->enum('height', [3, 4, 5, 6, 7, 8])->default(8);
            $table->enum('row_digits', [1, 2, 3]);
            $table->enum('header_digits', [1, 2]);
            $table->smallInteger('trial_time')->unsigned()->default(300);
            $table->smallInteger('elapsed_time')->unsigned();
            $table->tinyInteger('correct')->unsigned();
            $table->tinyInteger('percent')->unsigned();
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
        Schema::dropIfExists('trials');
    }
}
