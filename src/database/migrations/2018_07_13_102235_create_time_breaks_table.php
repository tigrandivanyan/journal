<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeBreaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_breaks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('operator_id')->nullable();
            $table->integer('chef_id')->nullable();
            $table->string('studio')->nullable();
            $table->timestamp('started')->nullable();
            $table->timestamp('ended')->nullable();
            $table->string('type')->default('operator_break');
            $table->unsignedInteger('operator_id')->nullable()->change();
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
        Schema::dropIfExists('time_breaks');
    }
}
