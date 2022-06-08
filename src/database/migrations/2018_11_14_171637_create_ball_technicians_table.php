<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBallTechniciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ball_technicians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ru');
            $table->string('name_lv');
            $table->integer('number')->nullable();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('active_employee')->unsigned()->default(1);
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
        Schema::dropIfExists('ball_technicians');
    }
}
