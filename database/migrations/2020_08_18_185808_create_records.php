<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('exercise_id');
            $table->unsignedBigInteger('exercise_weight_class_id');
            $table->string('weight');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('exercise_id')->references('id')->on('exercises');
            $table->foreign('exercise_weight_class_id')->references('id')->on('exercise_weight_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
