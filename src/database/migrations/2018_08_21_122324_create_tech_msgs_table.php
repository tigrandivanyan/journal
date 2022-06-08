<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechMsgsTable extends Migration
{

    public function up()
    {
        Schema::create('tech_msgs', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('order')->nullable();
            $table->integer('studio_id')->nullable();
            $table->string('tech_msg_name_ru')->nullable();
            $table->string('tech_msg_name_eng')->nullable();
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
        Schema::dropIfExists('tech_msgs');
    }
}
